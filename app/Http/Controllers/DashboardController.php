<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\Competency;
use App\Models\Evidence;
use App\Models\Reassessment;
use App\Models\User;
use App\Services\ScoringService;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct(protected ScoringService $scoringService)
    {
    }

    public function index()
    {
        $user = Auth::user();

        if ($user->isReviewer()) {
            $pendingEvidence = Evidence::where('validation_status', 'pending')->with('user', 'competencies')->latest()->get();
            $verifiedCount = Evidence::where('validation_status', 'verified')->count();
            return view('pages.reviewer.dashboard', compact('user', 'pendingEvidence', 'verifiedCount'));
        }

        if ($user->isAdmin()) {
            $careers = Career::withCount('competencies')->latest()->get();
            $careersCount = $careers->count();
            $studentsCount = User::where('role', 'student')->count();
            $evidenceCount = Evidence::count();
            $competenciesCount = Competency::count();

            return view('pages.admin.dashboard', compact(
                'user',
                'careers',
                'careersCount',
                'studentsCount',
                'evidenceCount',
                'competenciesCount'
            ));
        }

        // Student Dashboard
        $career = Career::where('slug', 'fullstack-web-developer')->with('competencies')->first();
        $gaps = $career ? $this->scoringService->calculateGap($user, $career) : [];
        
        $verifiedEvidence = $user->evidence()->where('validation_status', 'verified')->count();
        $pendingEvidence = $user->evidence()->where('validation_status', 'pending')->count();
        $latestReassessment = Reassessment::where('user_id', $user->id)->with('snapshots.competency')->latest()->first();

        $plan = $user->developmentPlans()->where('status', 'active')->with('activities.competency')->first();

        return view('pages.student.dashboard', compact(
            'user',
            'career',
            'gaps',
            'verifiedEvidence',
            'pendingEvidence',
            'latestReassessment',
            'plan'
        ));
    }
}
