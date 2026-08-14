<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Services\ScoringService;
use Illuminate\Support\Facades\Auth;

class GapAnalysisController extends Controller
{
    public function __construct(protected ScoringService $scoringService)
    {
    }

    public function index()
    {
        $user = Auth::user();
        $career = Career::where('slug', 'fullstack-web-developer')->firstOrFail();
        $gaps = $this->scoringService->calculateGap($user, $career);

        return view('pages.gap.index', compact('career', 'gaps'));
    }
}
