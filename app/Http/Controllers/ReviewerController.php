<?php

namespace App\Http\Controllers;

use App\Models\Evidence;
use App\Models\Feedback;
use App\Services\ReassessmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function reviewEvidence(Request $request, string $id)
    {
        $reviewer = Auth::user();
        $evidence = Evidence::findOrFail($id);

        $status = $request->input('validation_status');
        $note = $request->input('reviewer_note');

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

        // Trigger snapshot update for student
        $career = \App\Models\Career::where('slug', 'fullstack-web-developer')->first();
        if ($career) {
            $this->reassessmentService->createSnapshot($evidence->user, $career);
        }

        return redirect()->route('reviewer.index')->with('success', 'Bukti kemampuan berhasil ditinjau dan status diperbarui.');
    }
}
