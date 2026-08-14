<?php

namespace Tests\Feature;

use App\Models\Evidence;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorizationTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    public function test_student_cannot_access_admin_careers(): void
    {
        $student = User::where('email', 'student@itats.ac.id')->firstOrFail();
        $this->actingAs($student);

        $response = $this->get('/admin/careers');
        $response->assertStatus(403);
    }

    public function test_student_cannot_store_career(): void
    {
        $student = User::where('email', 'student@itats.ac.id')->firstOrFail();
        $this->actingAs($student);

        $response = $this->post('/admin/careers', [
            'name' => 'Cyber Security Specialist',
            'description' => 'Security engineering',
            'status' => 'published',
        ]);
        $response->assertStatus(403);
    }

    public function test_student_cannot_access_admin_competencies(): void
    {
        $student = User::where('email', 'student@itats.ac.id')->firstOrFail();
        $this->actingAs($student);

        $response = $this->get('/admin/competencies');
        $response->assertStatus(403);
    }

    public function test_student_cannot_access_reviewer_portal(): void
    {
        $student = User::where('email', 'student@itats.ac.id')->firstOrFail();
        $this->actingAs($student);

        $response = $this->get('/reviewer');
        $response->assertStatus(403);
    }

    public function test_reviewer_cannot_review_own_evidence(): void
    {
        $reviewer = User::where('email', 'reviewer@itats.ac.id')->firstOrFail();
        $this->actingAs($reviewer);

        // Create an evidence owned by the reviewer
        $evidence = Evidence::create([
            'user_id' => $reviewer->id,
            'title' => 'Reviewer Self Project',
            'type' => 'project',
            'description' => 'Self uploaded evidence',
            'validation_status' => 'pending',
        ]);

        $response = $this->post("/reviewer/evidence/{$evidence->id}", [
            'validation_status' => 'verified',
            'reviewer_note' => 'Approving myself',
        ]);

        $response->assertStatus(403);
    }

    public function test_reviewer_cannot_access_admin_pages(): void
    {
        $reviewer = User::where('email', 'reviewer@itats.ac.id')->firstOrFail();
        $this->actingAs($reviewer);

        $response = $this->get('/admin/careers');
        $response->assertStatus(403);
    }

    public function test_quick_login_disabled_in_production_without_debug(): void
    {
        $this->app->detectEnvironment(fn () => 'production');
        config(['app.debug' => false]);

        $response = $this->get('/login/quick/admin');
        $response->assertStatus(403);
    }

    public function test_reviewer_cannot_access_student_assessment(): void
    {
        $reviewer = User::where('email', 'reviewer@itats.ac.id')->firstOrFail();
        $this->actingAs($reviewer);

        $response = $this->get('/assessment');
        $response->assertStatus(403);
    }

    public function test_admin_cannot_access_student_evidence_create(): void
    {
        $admin = User::where('email', 'admin@itats.ac.id')->firstOrFail();
        $this->actingAs($admin);

        $response = $this->get('/evidence/create');
        $response->assertStatus(403);
    }
}
