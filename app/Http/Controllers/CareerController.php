<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\Competency;
use App\Services\ScoringService;
use App\Traits\ResolvesCareer;
use Illuminate\Support\Facades\Auth;

class CareerController extends Controller
{
    use ResolvesCareer;

    public function __construct(protected ScoringService $scoringService)
    {
    }

    public function index()
    {
        $careers = Career::where('status', 'published')->withCount('competencies')->get();
        return view('pages.career.index', compact('careers'));
    }

    public function show(string $slug)
    {
        $career = Career::where('slug', $slug)->with('competencies')->firstOrFail();
        session(['selected_career_slug' => $career->slug]);
        $user = Auth::user();
        $gaps = $user ? $this->scoringService->calculateGap($user, $career) : [];

        return view('pages.career.show', compact('career', 'gaps'));
    }

    public function map()
    {
        $user = Auth::user();
        $career = $this->getCurrentCareer();
        $career->load('competencies');
        $gaps = $this->scoringService->calculateGap($user, $career);

        return view('pages.competency.map', compact('career', 'gaps'));
    }

    public function competencyDetail(string $slug)
    {
        $competency = Competency::where('slug', $slug)->with('evidence', 'careers')->firstOrFail();
        return view('pages.competency.detail', compact('competency'));
    }
}
