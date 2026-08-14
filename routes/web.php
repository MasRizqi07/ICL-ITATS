<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DevelopmentPlanController;
use App\Http\Controllers\EvidenceController;
use App\Http\Controllers\GapAnalysisController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReassessmentController;
use App\Http\Controllers\ReviewerController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SupportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('pages.landing');
})->name('landing');

Route::get('/about', [SupportController::class, 'about'])->name('about');
Route::get('/flow', [SupportController::class, 'flow'])->name('flow');
Route::get('/help', [SupportController::class, 'help'])->name('help');
Route::get('/support', [SupportController::class, 'contact'])->name('support');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/login/quick/{role}', [AuthController::class, 'quickLogin'])->name('login.quick');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Authenticated Web Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/careers', [CareerController::class, 'index'])->name('careers.index');
    Route::get('/careers/{slug}', [CareerController::class, 'show'])->name('careers.show');
    Route::get('/peta-kompetensi', [CareerController::class, 'map'])->name('competency.map');
    Route::get('/kompetensi/{slug}', [CareerController::class, 'competencyDetail'])->name('competency.detail');

    Route::get('/assessment', [AssessmentController::class, 'show'])->name('assessment.show');
    Route::post('/assessment', [AssessmentController::class, 'store'])->name('assessment.store');

    Route::get('/evidence', [EvidenceController::class, 'index'])->name('evidence.index');
    Route::get('/evidence/create', [EvidenceController::class, 'create'])->name('evidence.create');
    Route::post('/evidence', [EvidenceController::class, 'store'])->name('evidence.store');

    Route::get('/skill-gaps', [GapAnalysisController::class, 'index'])->name('skill-gaps');

    Route::get('/development-plans', [DevelopmentPlanController::class, 'index'])->name('development-plans.index');
    Route::post('/development-plans/activities', [DevelopmentPlanController::class, 'storeActivity'])->name('development-plans.activities.store');
    Route::put('/development-plans/activities/{id}', [DevelopmentPlanController::class, 'updateActivityStatus'])->name('development-plans.activities.update');
    Route::post('/development-plans/ai-suggest', [DevelopmentPlanController::class, 'aiSuggest'])->name('development-plans.ai-suggest');

    Route::get('/reassessments', [ReassessmentController::class, 'index'])->name('reassessments.index');
    Route::post('/reassessments/trigger', [ReassessmentController::class, 'trigger'])->name('reassessments.trigger');

    Route::get('/reviewer', [ReviewerController::class, 'index'])->name('reviewer.index');
    Route::get('/reviewer/evidence/{id}', [ReviewerController::class, 'showEvidence'])->name('reviewer.evidence.show');
    Route::post('/reviewer/evidence/{id}', [ReviewerController::class, 'reviewEvidence'])->name('reviewer.evidence.review');

    Route::get('/admin/careers', [AdminController::class, 'careers'])->name('admin.careers');
    Route::post('/admin/careers', [AdminController::class, 'storeCareer'])->name('admin.careers.store');
    Route::get('/admin/competencies', [AdminController::class, 'competencies'])->name('admin.competencies');
    Route::post('/admin/competencies', [AdminController::class, 'storeCompetency'])->name('admin.competencies.store');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/settings/account', [SettingsController::class, 'account'])->name('settings.account');
    Route::get('/settings/privacy', [SettingsController::class, 'privacy'])->name('settings.privacy');

    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
});
