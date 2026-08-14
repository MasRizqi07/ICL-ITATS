<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAssessmentRequest;
use App\Models\Assessment;
use App\Models\AssessmentAttempt;
use App\Models\AssessmentResult;
use App\Models\Career;
use App\Services\ReassessmentService;
use App\Traits\ResolvesCareer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Validation\ValidationException;

class AssessmentController extends Controller
{
    use ResolvesCareer;

    public function __construct(protected ReassessmentService $reassessmentService)
    {
    }

    public function show(Request $request)
    {
        $career = $this->getCurrentCareer($request);
        $assessment = Assessment::where('career_id', $career->id)->with('items.competency')->firstOrFail();
        return view('pages.assessment.take', compact('career', 'assessment'));
    }

    public function store(StoreAssessmentRequest $request)
    {
        $user = Auth::user();
        $career = $this->getCurrentCareer($request);
        $assessment = Assessment::where('career_id', $career->id)->with('items')->firstOrFail();

        $answers = $request->validated()['scores'];
        $itemsByCompetency = $assessment->items->keyBy('competency_id');
        $validCompetencyIds = $itemsByCompetency->keys()->toArray();
        $submittedCompIds = array_keys($answers);

        // Reject if there are foreign competency IDs
        $invalidCompIds = array_diff($submittedCompIds, $validCompetencyIds);
        if (! empty($invalidCompIds)) {
            throw ValidationException::withMessages([
                'scores' => 'Terdapat butir penilaian yang tidak termasuk dalam instrumen asesmen aktif.',
            ]);
        }

        // Reject if any assessment item is left unanswered
        $missingCompIds = array_diff($validCompetencyIds, $submittedCompIds);
        if (! empty($missingCompIds)) {
            throw ValidationException::withMessages([
                'scores' => 'Harap lengkapi seluruh butir asesmen kompetensi yang tersedia.',
            ]);
        }

        // Guard against duplicate submission within 3 seconds
        $recentAttempt = AssessmentAttempt::where('user_id', $user->id)
            ->where('assessment_id', $assessment->id)
            ->where('created_at', '>=', now()->subSeconds(3))
            ->first();

        if ($recentAttempt) {
            return redirect()->route('skill-gaps')->with('success', 'Asesmen mandiri berhasil disubmit!');
        }

        DB::transaction(function () use ($user, $career, $assessment, $answers, $itemsByCompetency) {
            $attempt = AssessmentAttempt::create([
                'user_id' => $user->id,
                'assessment_id' => $assessment->id,
                'career_id' => $career->id,
                'status' => 'completed',
                'submitted_at' => now(),
            ]);

            foreach ($answers as $competencyId => $score) {
                $item = $itemsByCompetency->get($competencyId);
                $maxScore = $item ? (float) $item->max_score : 5.0;

                AssessmentResult::create([
                    'attempt_id' => $attempt->id,
                    'competency_id' => $competencyId,
                    'score' => (float) $score,
                    'max_score' => $maxScore,
                    'explanation' => "Penilaian mandiri mahasiswa: skor {$score}/{$maxScore}",
                ]);
            }

            // Trigger snapshot reassessment
            $this->reassessmentService->createSnapshot($user, $career);
        });

        return redirect()->route('skill-gaps')->with('success', 'Asesmen mandiri berhasil disubmit dan snapshot penilaian dirilis!');
    }
}
