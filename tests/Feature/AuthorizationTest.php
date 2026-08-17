<?php

namespace Tests\Feature;

use App\Models\Career;
use App\Models\CareerCompetency;
use App\Models\Competency;
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

    public function test_reviewer_approves_evidence_uses_student_target_career_not_reviewer_session(): void
    {
        $careerA = Career::where('slug', 'fullstack-web-developer')->firstOrFail();
        $careerB = Career::create([
            'name' => 'DevOps Engineer',
            'slug' => 'devops-engineer',
            'description' => 'Infrastructure and CI/CD specialist',
            'status' => 'published',
        ]);

        $comp = Competency::firstOrFail();
        CareerCompetency::create([
            'career_id' => $careerB->id,
            'competency_id' => $comp->id,
            'required_level' => 4.0,
            'priority' => 'high',
            'weight' => 1.0,
            'rule_version' => 'v1.0',
        ]);

        // Student with target_career_id = Career B
        $student = User::create([
            'name' => 'Student DevOps',
            'email' => 'student_devops@itats.ac.id',
            'password' => 'password',
            'role' => 'student',
            'target_career_id' => $careerB->id,
        ]);

        $evidence = Evidence::create([
            'user_id' => $student->id,
            'title' => 'CI/CD Pipeline Setup',
            'type' => 'project',
            'description' => 'Automated deployment on GitHub Actions',
            'validation_status' => 'pending',
        ]);
        $evidence->competencies()->attach($comp->id, ['relevance' => 1.0]);

        // Reviewer logs in and has Career A in session
        $reviewer = User::where('email', 'reviewer@itats.ac.id')->firstOrFail();
        $this->actingAs($reviewer);
        session(['selected_career_slug' => $careerA->slug]);

        // Reviewer approves student evidence
        $response = $this->post("/reviewer/evidence/{$evidence->id}", [
            'validation_status' => 'verified',
            'reviewer_note' => 'Great automated pipeline implementation.',
        ]);

        $response->assertRedirect('/reviewer');

        // Verify that snapshot created for student references Career B, NOT Career A
        $latestReassessment = $student->reassessments()->latest()->first();
        $this->assertNotNull($latestReassessment);
        $this->assertEquals($careerB->id, $latestReassessment->career_id);
        $this->assertNotEquals($careerA->id, $latestReassessment->career_id);
    }

    public function test_reviewer_approves_evidence_for_student_without_target_career_skips_snapshot(): void
    {
        $comp = Competency::firstOrFail();

        // Student with no target_career_id and no reassessment
        $student = User::create([
            'name' => 'Undecided Student',
            'email' => 'undecided@itats.ac.id',
            'password' => 'password',
            'role' => 'student',
            'target_career_id' => null,
        ]);

        $evidence = Evidence::create([
            'user_id' => $student->id,
            'title' => 'General Certificate',
            'type' => 'certificate',
            'description' => 'Certificate with no career chosen yet',
            'validation_status' => 'pending',
        ]);
        $evidence->competencies()->attach($comp->id, ['relevance' => 1.0]);

        $reviewer = User::where('email', 'reviewer@itats.ac.id')->firstOrFail();
        $this->actingAs($reviewer);

        $response = $this->post("/reviewer/evidence/{$evidence->id}", [
            'validation_status' => 'verified',
            'reviewer_note' => 'Approved',
        ]);

        $response->assertRedirect('/reviewer');

        // Assert no snapshot was created
        $this->assertEquals(0, $student->reassessments()->count());
    }
}
