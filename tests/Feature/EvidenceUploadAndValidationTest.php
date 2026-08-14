<?php

namespace Tests\Feature;

use App\Models\Competency;
use App\Models\DevelopmentActivity;
use App\Models\DevelopmentPlan;
use App\Models\Evidence;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class EvidenceUploadAndValidationTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    public function test_student_can_upload_pdf_evidence_file_and_download_it(): void
    {
        Storage::fake('local');

        $student = User::where('email', 'student@itats.ac.id')->firstOrFail();
        $this->actingAs($student);

        $comp = Competency::firstOrFail();
        $file = UploadedFile::fake()->create('sertifikat.pdf', 500, 'application/pdf');

        $response = $this->post('/evidence', [
            'title' => 'Sertifikat kompetensi Laravel',
            'type' => 'certificate',
            'description' => 'Sertifikat resmi kelulusan ujian Laravel',
            'evidence_file' => $file,
            'competency_ids' => [$comp->id],
        ]);

        $response->assertRedirect('/evidence');

        $evidence = Evidence::where('title', 'Sertifikat kompetensi Laravel')->firstOrFail();
        $this->assertNotNull($evidence->storage_key);
        Storage::disk('local')->assertExists($evidence->storage_key);

        // Student owner can download
        $downloadResponse = $this->get("/evidence/{$evidence->id}/download");
        $downloadResponse->assertStatus(200);

        // Reviewer can also download
        $reviewer = User::where('email', 'reviewer@itats.ac.id')->firstOrFail();
        $this->actingAs($reviewer);
        $reviewerDownload = $this->get("/evidence/{$evidence->id}/download");
        $reviewerDownload->assertStatus(200);
    }

    public function test_assessment_rejects_score_out_of_range(): void
    {
        $student = User::where('email', 'student@itats.ac.id')->firstOrFail();
        $this->actingAs($student);

        $comp = Competency::firstOrFail();

        $response = $this->post('/assessment', [
            'scores' => [
                $comp->id => 6.5, // > 5.0 invalid
            ],
        ]);

        $response->assertSessionHasErrors(['scores.' . $comp->id]);
    }

    public function test_user_cannot_update_activity_belonging_to_another_users_plan(): void
    {
        $student = User::where('email', 'student@itats.ac.id')->firstOrFail();
        $otherUser = User::create([
            'name' => 'Other Student',
            'email' => 'otherstudent@itats.ac.id',
            'password' => 'password',
            'role' => 'student',
        ]);

        $plan = DevelopmentPlan::create([
            'user_id' => $otherUser->id,
            'career_id' => \App\Models\Career::firstOrFail()->id,
            'status' => 'active',
        ]);

        $comp = Competency::firstOrFail();
        $activity = DevelopmentActivity::create([
            'plan_id' => $plan->id,
            'competency_id' => $comp->id,
            'title' => 'Aktivitas Mahasiswa Lain',
            'description' => 'Deskripsi aktivitas',
            'priority' => 'high',
            'status' => 'in_progress',
        ]);

        // Attempting to update other user's activity
        $this->actingAs($student);
        $response = $this->put("/development-plans/activities/{$activity->id}", [
            'status' => 'completed',
        ]);

        $response->assertStatus(404);
    }
}
