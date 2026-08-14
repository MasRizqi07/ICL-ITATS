<?php

namespace Tests\Feature;

use App\Models\Assessment;
use App\Models\Career;
use App\Models\Competency;
use App\Models\DevelopmentPlan;
use App\Models\Evidence;
use App\Models\Reassessment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class RegressionJourneyTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    public function test_full_student_and_reviewer_career_journey(): void
    {
        Storage::fake('local');

        // 1. Student login
        $student = User::where('email', 'student@itats.ac.id')->firstOrFail();
        $this->actingAs($student);

        // 2. View dashboard
        $response = $this->get('/dashboard');
        $response->assertStatus(200);

        // 3. View career details
        $career = Career::where('slug', 'fullstack-web-developer')->firstOrFail();
        $response = $this->get("/careers/{$career->slug}");
        $response->assertStatus(200);

        // 4. Submit assessment
        $assessment = Assessment::where('career_id', $career->id)->with('items')->firstOrFail();
        $scores = [];
        foreach ($assessment->items as $item) {
            $scores[$item->competency_id] = 4.0;
        }
        $response = $this->post('/assessment', ['scores' => $scores]);
        $response->assertRedirect('/skill-gaps');

        // 5. View skill gaps
        $response = $this->get('/skill-gaps');
        $response->assertStatus(200);

        // 6. Create development activity
        $comp = Competency::firstOrFail();
        $response = $this->post('/development-plans/activities', [
            'competency_id' => $comp->id,
            'title' => 'Belajar Master Laravel 13',
            'description' => 'Mempelajari fitur terbaru Laravel 13',
            'priority' => 'high',
            'target_date' => now()->addDays(7)->format('Y-m-d'),
        ]);
        $response->assertRedirect('/development-plans');

        // 7. Upload evidence file
        $file = UploadedFile::fake()->create('sertifikat_laravel.pdf', 500, 'application/pdf');
        $response = $this->post('/evidence', [
            'title' => 'Sertifikat Master Laravel 13',
            'type' => 'certificate',
            'description' => 'Bukti sertifikasi resmi master laravel 13',
            'evidence_file' => $file,
            'competency_ids' => [$comp->id],
        ]);
        $response->assertRedirect('/evidence');

        $evidence = Evidence::where('title', 'Sertifikat Master Laravel 13')->firstOrFail();
        $this->assertEquals('pending', $evidence->validation_status);

        // 8. Reviewer login
        $reviewer = User::where('email', 'reviewer@itats.ac.id')->firstOrFail();
        $this->actingAs($reviewer);

        // 9. Review evidence
        $response = $this->get("/reviewer/evidence/{$evidence->id}");
        $response->assertStatus(200);

        $response = $this->post("/reviewer/evidence/{$evidence->id}", [
            'validation_status' => 'verified',
            'reviewer_note' => 'Bukti sangat valid dan memenuhi standar kompetensi.',
        ]);
        $response->assertRedirect('/reviewer');

        $evidence->refresh();
        $this->assertEquals('verified', $evidence->validation_status);
        $this->assertEquals($reviewer->id, $evidence->reviewer_id);

        // 10. Student login back
        $this->actingAs($student);

        // 11. Trigger reassessment
        $response = $this->post('/reassessments/trigger');
        $response->assertRedirect('/reassessments');

        // 12. Verify snapshot history chain
        $reassessments = Reassessment::where('user_id', $student->id)->get();
        $this->assertGreaterThanOrEqual(2, $reassessments->count());

        $hasChainedSnapshot = $reassessments->contains(fn ($r) => $r->previous_id !== null);
        $this->assertTrue($hasChainedSnapshot);
    }
}
