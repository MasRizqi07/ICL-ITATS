<?php

namespace Tests\Feature;

use App\Models\Career;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CareerSelectionTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    public function test_student_can_view_career_details_and_set_selected_career(): void
    {
        $student = User::where('email', 'student@itats.ac.id')->firstOrFail();
        $this->actingAs($student);

        // Get second career from seeder or create a new one
        $career = Career::where('slug', '!=', 'fullstack-web-developer')->first() 
            ?? Career::create([
                'name' => 'DevOps Engineer',
                'slug' => 'devops-engineer',
                'description' => 'Infrastructure and CI/CD specialist',
                'status' => 'published',
            ]);

        $response = $this->get("/careers/{$career->slug}");
        $response->assertStatus(200);
        $response->assertSee($career->name);

        $this->assertEquals($career->slug, session('selected_career_slug'));
        $this->assertEquals($career->id, $student->fresh()->target_career_id);

        // Dashboard should now reflect selected career
        $dashboardResponse = $this->get('/dashboard');
        $dashboardResponse->assertStatus(200);
        $dashboardResponse->assertSee($career->name);
    }
}
