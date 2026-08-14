<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentJourneyTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    public function test_landing_page_is_accessible(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('ICL ITATS');
    }

    public function test_student_can_quick_login_and_access_dashboard(): void
    {
        $response = $this->get('/login/quick/student');
        $response->assertRedirect('/dashboard');

        $this->assertAuthenticated();

        $dashboardResponse = $this->get('/dashboard');
        $dashboardResponse->assertStatus(200);
        $dashboardResponse->assertSee('Budi Santoso');
    }

    public function test_admin_can_access_admin_dashboard(): void
    {
        $admin = User::where('email', 'admin@itats.ac.id')->firstOrFail();
        $this->actingAs($admin);

        $response = $this->get('/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Dashboard Administrator');
        $response->assertSee('Total Profil Karier');
    }

    public function test_student_can_view_competency_map_and_skill_gaps(): void
    {
        $user = User::where('email', 'student@itats.ac.id')->firstOrFail();
        $this->actingAs($user);

        $responseMap = $this->get('/peta-kompetensi');
        $responseMap->assertStatus(200);
        $responseMap->assertSee('Peta Kompetensi Karier Target');

        $responseGaps = $this->get('/skill-gaps');
        $responseGaps->assertStatus(200);
        $responseGaps->assertSee('Analisis Skill Gap');
    }

    public function test_reviewer_can_access_reviewer_portal(): void
    {
        $reviewer = User::where('email', 'reviewer@itats.ac.id')->firstOrFail();
        $this->actingAs($reviewer);

        $response = $this->get('/reviewer');
        $response->assertStatus(200);
        $response->assertSee('Portal Penilaian');
    }
}
