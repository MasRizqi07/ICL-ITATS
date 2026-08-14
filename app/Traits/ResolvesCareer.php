<?php

namespace App\Traits;

use App\Models\Career;
use Illuminate\Http\Request;

trait ResolvesCareer
{
    /**
     * Resolves the current active target career dynamically.
     */
    protected function getCurrentCareer(?Request $request = null): Career
    {
        $slug = $request?->query('career') ?? session('selected_career_slug');

        if ($slug) {
            $career = Career::where('slug', $slug)->first();
            if ($career) {
                session(['selected_career_slug' => $career->slug]);
                return $career;
            }
        }

        $career = Career::where('status', 'published')->first() ?? Career::firstOrFail();
        session(['selected_career_slug' => $career->slug]);

        return $career;
    }
}
