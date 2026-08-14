<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\Competency;
use App\Models\DevelopmentActivity;
use App\Models\DevelopmentPlan;
use App\Services\AiSupportService;
use App\Traits\ResolvesCareer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DevelopmentPlanController extends Controller
{
    use ResolvesCareer;

    public function __construct(protected AiSupportService $aiSupportService)
    {
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $career = $this->getCurrentCareer($request);
        $plan = DevelopmentPlan::firstOrCreate(
            ['user_id' => $user->id, 'career_id' => $career->id],
            ['status' => 'active']
        );

        $activities = $plan->activities()->with('competency')->latest()->get();
        $competencies = Competency::all();

        return view('pages.development.index', compact('career', 'plan', 'activities', 'competencies'));
    }

    public function storeActivity(Request $request)
    {
        $user = Auth::user();
        $career = $this->getCurrentCareer($request);
        $plan = DevelopmentPlan::firstOrCreate(
            ['user_id' => $user->id, 'career_id' => $career->id],
            ['status' => 'active']
        );

        $validated = $request->validate([
            'competency_id' => 'required|uuid',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'expected_evidence' => 'nullable|string',
            'priority' => 'required|string',
            'target_date' => 'nullable|date',
        ]);

        DevelopmentActivity::create([
            'plan_id' => $plan->id,
            'competency_id' => $validated['competency_id'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'expected_evidence' => $validated['expected_evidence'] ?? null,
            'priority' => $validated['priority'],
            'status' => 'in_progress',
            'target_date' => $validated['target_date'] ?? null,
        ]);

        return redirect()->route('development-plans.index')->with('success', 'Aktivitas pengembangan berhasil ditambahkan.');
    }

    public function updateActivityStatus(Request $request, string $id)
    {
        $user = Auth::user();
        $activity = DevelopmentActivity::whereHas('plan', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->findOrFail($id);
        $status = $request->input('status');

        $activity->update([
            'status' => $status,
            'completed_at' => $status === 'completed' ? now() : null,
            'reflection' => $request->input('reflection', $activity->reflection),
        ]);

        return redirect()->route('development-plans.index')->with('success', 'Status aktivitas berhasil diperbarui.');
    }

    public function aiSuggest(Request $request)
    {
        $user = Auth::user();
        $competencyId = $request->input('competency_id');
        $competency = Competency::find($competencyId);
        
        $res = $this->aiSupportService->generateSuggestions(
            $user,
            $competency ? $competency->name : 'General Competency',
            1.5
        );

        return response()->json($res);
    }
}
