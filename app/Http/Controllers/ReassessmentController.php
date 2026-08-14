<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\Reassessment;
use App\Services\ReassessmentService;
use Illuminate\Support\Facades\Auth;

class ReassessmentController extends Controller
{
    public function __construct(protected ReassessmentService $reassessmentService)
    {
    }

    public function index()
    {
        $user = Auth::user();
        $career = Career::where('slug', 'fullstack-web-developer')->firstOrFail();
        
        $reassessments = Reassessment::where('user_id', $user->id)
            ->where('career_id', $career->id)
            ->with('snapshots.competency')
            ->latest()
            ->get();

        $latestSnapshot = $reassessments->first();
        $previousSnapshot = $reassessments->skip(1)->first();

        return view('pages.reassessment.index', compact('career', 'reassessments', 'latestSnapshot', 'previousSnapshot'));
    }

    public function trigger()
    {
        $user = Auth::user();
        $career = Career::where('slug', 'fullstack-web-developer')->firstOrFail();
        
        $this->reassessmentService->createSnapshot($user, $career);

        return redirect()->route('reassessments.index')->with('success', 'Penilaian ulang (Reassessment Snapshot) berhasil diperbarui!');
    }
}
