<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\Competency;
use App\Models\Evidence;
use App\Services\ReassessmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvidenceController extends Controller
{
    public function __construct(protected ReassessmentService $reassessmentService)
    {
    }

    public function index()
    {
        $user = Auth::user();
        $evidence = $user->evidence()->with('competencies', 'reviewer')->latest()->get();
        return view('pages.evidence.index', compact('evidence'));
    }

    public function create()
    {
        $competencies = Competency::all();
        return view('pages.evidence.create', compact('competencies'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string',
            'description' => 'required|string',
            'source_url' => 'nullable|url',
            'obtained_at' => 'nullable|date',
            'competency_ids' => 'required|array',
        ]);

        $ev = Evidence::create([
            'user_id' => $user->id,
            'title' => $validated['title'],
            'type' => $validated['type'],
            'description' => $validated['description'],
            'source_url' => $validated['source_url'] ?? null,
            'obtained_at' => $validated['obtained_at'] ?? now(),
            'validation_status' => 'pending',
        ]);

        foreach ($validated['competency_ids'] as $compId) {
            $ev->competencies()->attach($compId, ['relevance' => 1.0]);
        }

        // Trigger snapshot update
        $career = Career::where('slug', 'fullstack-web-developer')->first();
        if ($career) {
            $this->reassessmentService->createSnapshot($user, $career);
        }

        return redirect()->route('evidence.index')->with('success', 'Bukti kemampuan berhasil diunggah dan menunggu peninjauan reviewer.');
    }
}
