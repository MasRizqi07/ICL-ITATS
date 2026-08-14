<?php

namespace Tests\Feature;

use App\Models\Assessment;
use App\Models\AssessmentAttempt;
use App\Models\AssessmentItem;
use App\Models\Career;
use App\Models\Competency;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AssessmentValidationTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    public function test_student_can_submit_valid_assessment_atomically(): void
    {
        $student = User::where('email', 'student@itats.ac.id')->firstOrFail();
        $this->actingAs($student);

        $career = Career::where('slug', 'fullstack-web-developer')->firstOrFail();
        $assessment = Assessment::where('career_id', $career->id)->with('items')->firstOrFail();

        $scores = [];
        foreach ($assessment->items as $item) {
            $scores[$item->competency_id] = 4.0;
        }

        $response = $this->post('/assessment', ['scores' => $scores]);
        $response->assertRedirect('/skill-gaps');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('assessment_attempts', [
            'user_id' => $student->id,
            'career_id' => $career->id,
            'status' => 'completed',
        ]);
    }

    public function test_score_below_zero_rejected(): void
    {
        $student = User::where('email', 'student@itats.ac.id')->firstOrFail();
        $this->actingAs($student);

        $comp = Competency::firstOrFail();
        $response = $this->post('/assessment', [
            'scores' => [$comp->id => -1.0],
        ]);

        $response->assertSessionHasErrors(['scores.' . $comp->id]);
    }

    public function test_score_above_five_rejected(): void
    {
        $student = User::where('email', 'student@itats.ac.id')->firstOrFail();
        $this->actingAs($student);

        $comp = Competency::firstOrFail();
        $response = $this->post('/assessment', [
            'scores' => [$comp->id => 5.5],
        ]);

        $response->assertSessionHasErrors(['scores.' . $comp->id]);
    }

    public function test_empty_assessment_scores_rejected(): void
    {
        $student = User::where('email', 'student@itats.ac.id')->firstOrFail();
        $this->actingAs($student);

        $response = $this->post('/assessment', [
            'scores' => [],
        ]);

        $response->assertSessionHasErrors(['scores']);
    }

    public function test_incomplete_assessment_scores_rejected(): void
    {
        $student = User::where('email', 'student@itats.ac.id')->firstOrFail();
        $this->actingAs($student);

        $comp = Competency::firstOrFail();

        // Submit only 1 score when assessment requires all items
        $response = $this->post('/assessment', [
            'scores' => [$comp->id => 4.0],
        ]);

        $response->assertSessionHasErrors(['scores']);
    }

    public function test_foreign_competency_id_in_assessment_rejected(): void
    {
        $student = User::where('email', 'student@itats.ac.id')->firstOrFail();
        $this->actingAs($student);

        $career = Career::where('slug', 'fullstack-web-developer')->firstOrFail();
        $assessment = Assessment::where('career_id', $career->id)->with('items')->firstOrFail();

        $scores = [];
        foreach ($assessment->items as $item) {
            $scores[$item->competency_id] = 4.0;
        }

        // Add a foreign competency ID not in assessment items
        $foreignComp = Competency::create([
            'name' => 'Foreign Unassociated Competency',
            'slug' => 'foreign-unassociated-competency',
            'domain' => 'Technical',
            'description' => 'Not in assessment items',
        ]);
        $scores[$foreignComp->id] = 4.0;

        $response = $this->post('/assessment', ['scores' => $scores]);
        $response->assertSessionHasErrors(['scores']);
    }

    public function test_reviewer_cannot_submit_assessment(): void
    {
        $reviewer = User::where('email', 'reviewer@itats.ac.id')->firstOrFail();
        $this->actingAs($reviewer);

        $response = $this->post('/assessment', ['scores' => ['some-id' => 4.0]]);
        $response->assertStatus(403);
    }

    public function test_admin_cannot_submit_assessment(): void
    {
        $admin = User::where('email', 'admin@itats.ac.id')->firstOrFail();
        $this->actingAs($admin);

        $response = $this->post('/assessment', ['scores' => ['some-id' => 4.0]]);
        $response->assertStatus(403);
    }

    public function test_assessment_item_max_score_is_used(): void
    {
        $student = User::where('email', 'student@itats.ac.id')->firstOrFail();
        $this->actingAs($student);

        $career = Career::where('slug', 'fullstack-web-developer')->firstOrFail();
        $assessment = Assessment::where('career_id', $career->id)->with('items')->firstOrFail();

        $item = $assessment->items->first();
        $item->update(['max_score' => 5.0]);

        $scores = [];
        foreach ($assessment->items as $it) {
            $scores[$it->competency_id] = 3.0;
        }

        $this->post('/assessment', ['scores' => $scores]);

        $attempt = AssessmentAttempt::where('user_id', $student->id)->latest()->firstOrFail();
        $result = $attempt->results->where('competency_id', $item->competency_id)->firstOrFail();

        $this->assertEquals(5.0, (float) $result->max_score);
    }
}
