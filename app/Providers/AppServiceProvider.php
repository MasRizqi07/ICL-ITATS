<?php

namespace App\Providers;

use App\Models\Career;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $currentCareer = null;
            try {
                if (request()->filled('career')) {
                    $currentCareer = Career::where('slug', request()->query('career'))->first();
                }
                if (! $currentCareer && Auth::check() && Auth::user()->target_career_id) {
                    $currentCareer = Career::find(Auth::user()->target_career_id);
                }
                if (! $currentCareer && session('selected_career_slug')) {
                    $currentCareer = Career::where('slug', session('selected_career_slug'))->first();
                }
                if (! $currentCareer) {
                    $currentCareer = Career::where('status', 'published')->first();
                }
            } catch (\Throwable $e) {
                $currentCareer = null;
            }

            $view->with('currentCareer', $currentCareer);
        });
    }
}
