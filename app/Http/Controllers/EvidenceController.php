<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEvidenceRequest;
use App\Models\Career;
use App\Models\Competency;
use App\Models\Evidence;
use App\Services\ReassessmentService;
use App\Traits\ResolvesCareer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;

class EvidenceController extends Controller
{
    use ResolvesCareer;

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

    public function store(StoreEvidenceRequest $request)
    {
        $user = Auth::user();
        $validated = $request->validated();

        $storageKey = null;
        if ($request->hasFile('evidence_file')) {
            $storageKey = $request->file('evidence_file')->store('evidence', 'local');
        }

        $ev = Evidence::create([
            'user_id' => $user->id,
            'title' => $validated['title'],
            'type' => $validated['type'],
            'description' => $validated['description'],
            'source_url' => $validated['source_url'] ?? null,
            'storage_key' => $storageKey,
            'obtained_at' => $validated['obtained_at'] ?? now(),
            'validation_status' => 'pending',
        ]);

        foreach ($validated['competency_ids'] as $compId) {
            $ev->competencies()->attach($compId, ['relevance' => 1.0]);
        }

        // Trigger snapshot update
        $career = $this->getCurrentCareer($request);
        if ($career) {
            $this->reassessmentService->createSnapshot($user, $career);
        }

        return redirect()->route('evidence.index')->with('success', 'Bukti kemampuan berhasil diunggah dan menunggu peninjauan reviewer.');
    }

    public function download(string $id)
    {
        $user = Auth::user();
        $evidence = Evidence::findOrFail($id);

        if (! $user->isAdmin() && ! $user->isReviewer() && $evidence->user_id !== $user->id) {
            abort(403, 'Anda tidak memiliki akses untuk mengunduh berkas ini.');
        }

        if (! $evidence->storage_key || ! Storage::disk('local')->exists($evidence->storage_key)) {
            abort(404, 'Berkas bukti tidak ditemukan di penyimpanan.');
        }

        $extension = pathinfo($evidence->storage_key, PATHINFO_EXTENSION);
        $filename = \Illuminate\Support\Str::slug($evidence->title) . ($extension ? '.' . $extension : '');

        return Storage::disk('local')->download($evidence->storage_key, $filename);
    }
}
