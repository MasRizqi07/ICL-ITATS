<?php

namespace App\Traits;

use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait ResolvesCareer
{
    /**
     * Resolves the current active target career dynamically.
     *
     * Order of resolution:
     * 1. Explicit query parameter (?career=slug) for transient browsing.
     * 2. Authenticated user's persisted target_career_id.
     * 3. Session ('selected_career_slug') fallback for guests / legacy state.
     * 4. First published career in database.
     */
    protected function getCurrentCareer(?Request $request = null): Career
    {
        $request = $request ?? (request()->has('career') ? request() : null);

        // 1. Explicit query param (?career=slug) — browsing view, does not alter permanent target
        if ($request && $request->filled('career')) {
            $career = Career::where('slug', $request->query('career'))->first();
            if ($career) {
                return $career;
            }
        }

        // 2. Auth::user()->target_career_id if user is logged in and target is set
        $user = Auth::user();
        if ($user && $user->target_career_id) {
            $career = Career::find($user->target_career_id);
            if ($career) {
                return $career;
            }
        }

        // 3. Session ('selected_career_slug') — fallback for guest or before column is set
        $sessionSlug = session('selected_career_slug');
        if ($sessionSlug) {
            $career = Career::where('slug', $sessionSlug)->first();
            if ($career) {
                return $career;
            }
        }

        // 4. First published career
        return Career::where('status', 'published')->first() ?? Career::firstOrFail();
    }
}
