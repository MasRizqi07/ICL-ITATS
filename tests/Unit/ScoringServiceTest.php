<?php

namespace Tests\Unit;

use App\Models\Career;
use App\Models\User;
use App\Services\ScoringService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ScoringServiceTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    public function test_calculate_gap_returns_correct_structure_and_values(): void
    {
        $user = User::where('email', 'student@itats.ac.id')->firstOrFail();
        $career = Career::where('slug', 'fullstack-web-developer')->firstOrFail();

        $scoringService = new ScoringService();
        $results = $scoringService->calculateGap($user, $career);

        $this->assertNotEmpty($results);
        foreach ($results as $item) {
            $this->assertArrayHasKey('competency_id', $item);
            $this->assertArrayHasKey('name', $item);
            $this->assertArrayHasKey('required_level', $item);
            $this->assertArrayHasKey('current_level', $item);
            $this->assertArrayHasKey('gap', $item);
            $this->assertArrayHasKey('status', $item);
            $this->assertArrayHasKey('explanation', $item);
        }
    }
}
