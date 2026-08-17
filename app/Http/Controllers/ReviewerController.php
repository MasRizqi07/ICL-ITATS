<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewEvidenceRequest;
use App\Models\Career;
use App\Models\Evidence;
use App\Models\Feedback;
use App\Services\ReassessmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ReviewerController extends Controller
{
    public function __construct(protected ReassessmentService $reassessmentService)
    {
    }

    public function index()
    {
        $user = Auth::user();
        $pendingEvidence = Evidence::where('validation_status', 'pending')->with('user', 'competencies')->latest()->get();
        $allEvidence = Evidence::with('user', 'competencies', 'reviewer')->latest()->get();
        $verifiedCount = Evidence::where('validation_status', 'verified')->count();

        return view('pages.reviewer.index', compact('user', 'pendingEvidence', 'allEvidence', 'verifiedCount'));
    }

    public function showEvidence(string $id)
    {
        $evidence = Evidence::with('user', 'competencies')->findOrFail($id);
        return view('pages.reviewer.review_evidence', compact('evidence'));
    }

    public function reviewEvidence(ReviewEvidenceRequest $request, string $id)
    {
        $reviewer = Auth::user();
        $evidence = Evidence::with('user.reassessments.career')->findOrFail($id);

        if ($reviewer->id === $evidence->user_id) {
            abort(403, 'Reviewer tidak dapat meninjau bukti kemampuan miliknya sendiri.');
        }

        $validated = $request->validated();
        $status = $validated['validation_status'];
        $note = $validated['reviewer_note'] ?? null;

        $evidence->update([
            'validation_status' => $status,
            'reviewer_id' => $reviewer->id,
            'reviewer_note' => $note,
        ]);

        if ($note) {
            Feedback::create([
                'reviewer_id' => $reviewer->id,
                'student_id' => $evidence->user_id,
                'evidence_id' => $evidence->id,
                'body' => "Penilaian bukti [{$evidence->title}]: " . $note,
            ]);
        }

        // Trigger snapshot update for student strictly based on evidence owner's target career
        $latestReassessment = $evidence->user->reassessments()->latest()->first();
        $career = $latestReassessment?->career
            ?? ($evidence->user->target_career_id ? Career::find($evidence->user->target_career_id) : null);

        if ($career) {
            $this->reassessmentService->createSnapshot($evidence->user, $career);
        } else {
            Log::info("Skipping snapshot creation for user {$evidence->user_id}: no target career or prior reassessment found.");
        }

        return redirect()->route('reviewer.index')->with('success', 'Bukti kemampuan berhasil ditinjau dan status diperbarui.');
    }
}
