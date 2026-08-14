<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\AssessmentAttempt;
use App\Models\AssessmentResult;
use App\Models\Career;
use App\Services\ReassessmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssessmentController extends Controller
{
    public function __construct(protected ReassessmentService $reassessmentService)
    {
    }

    public function show()
    {
        $career = Career::where('slug', 'fullstack-web-developer')->firstOrFail();
        $assessment = Assessment::where('career_id', $career->id)->with('items.competency')->firstOrFail();
        return view('pages.assessment.take', compact('career', 'assessment'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $career = Career::where('slug', 'fullstack-web-developer')->firstOrFail();
        $assessment = Assessment::where('career_id', $career->id)->firstOrFail();

        $answers = $request->input('scores', []);

        $attempt = AssessmentAttempt::create([
            'user_id' => $user->id,
            'assessment_id' => $assessment->id,
            'career_id' => $career->id,
            'status' => 'completed',
            'submitted_at' => now(),
        ]);

        foreach ($answers as $competencyId => $score) {
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

        return redirect()->route('skill-gaps')->with('success', 'Asesmen mandiri berhasil disubmit dan snapshot penilaian dirilis!');
    }
}
