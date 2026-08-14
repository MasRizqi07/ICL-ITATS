<?php

namespace App\Services;

use App\Models\Career;
use App\Models\CompetencySnapshot;
use App\Models\Reassessment;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ReassessmentService
{
    public function __construct(protected ScoringService $scoringService)
    {
    }

    /**
     * Create an immutable reassessment snapshot for a user and target career.
     */
    public function createSnapshot(User $user, Career $career): Reassessment
    {
        return DB::transaction(function () use ($user, $career) {
            $latestPrevious = Reassessment::where('user_id', $user->id)
                ->where('career_id', $career->id)
                ->orderBy('created_at', 'desc')
                ->orderBy('id', 'desc')
                ->first();

            $reassessment = Reassessment::create([
                'user_id' => $user->id,
                'career_id' => $career->id,
                'previous_id' => $latestPrevious?->id,
                'rule_version' => 'v1.0',
                'status' => 'completed',
                'completed_at' => now(),
            ]);

            $gapResults = $this->scoringService->calculateGap($user, $career);

            foreach ($gapResults as $item) {
                CompetencySnapshot::create([
                    'reassessment_id' => $reassessment->id,
                    'competency_id' => $item['competency_id'],
                    'required_level' => $item['required_level'],
                    'current_level' => $item['current_level'],
                    'gap' => $item['gap'],
                    'status' => $item['status'],
                    'evidence_summary' => "Total {$item['evidence_count']} bukti terdaftar.",
                    'explanation' => $item['explanation'],
                ]);
            }

            return $reassessment;
        });
    }
}
