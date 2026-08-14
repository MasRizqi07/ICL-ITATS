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
        $validCompetencyIds = $assessment->items->pluck('competency_id')->toArray();

        DB::transaction(function () use ($user, $career, $assessment, $answers, $validCompetencyIds) {
            $attempt = AssessmentAttempt::create([
                'user_id' => $user->id,
                'assessment_id' => $assessment->id,
                'career_id' => $career->id,
                'status' => 'completed',
                'submitted_at' => now(),
            ]);

            foreach ($answers as $competencyId => $score) {
                if (! in_array($competencyId, $validCompetencyIds, true)) {
                    continue;
                }

                AssessmentResult::create([
                    'attempt_id' => $attempt->id,
                    'competency_id' => $competencyId,
                    'score' => (float) $score,
                    'max_score' => 5.0,
                    'explanation' => "Penilaian mandiri mahasiswa: skor {$score}/5.0",
                ]);
            }

            // Trigger snapshot reassessment
            $this->reassessmentService->createSnapshot($user, $career);
        });

        return redirect()->route('skill-gaps')->with('success', 'Asesmen mandiri berhasil disubmit dan snapshot penilaian dirilis!');
    }
}
