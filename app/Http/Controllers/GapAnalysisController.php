<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Services\ScoringService;
use App\Traits\ResolvesCareer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GapAnalysisController extends Controller
{
    use ResolvesCareer;

    public function __construct(protected ScoringService $scoringService)
    {
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $career = $this->getCurrentCareer($request);
        $gaps = $this->scoringService->calculateGap($user, $career);

        return view('pages.gap.index', compact('career', 'gaps'));
    }
}
