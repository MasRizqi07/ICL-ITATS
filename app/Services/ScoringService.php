<?php

namespace App\Services;

use App\Models\Career;
use App\Models\User;

class ScoringService
{
    /**
     * Calculate competency gaps for a user against a target career.
     * Rule version: v1.0
     */
    public function calculateGap(User $user, Career $career): array
    {
        $career->load('competencies');
        $userEvidence = $user->evidence()->whereIn('validation_status', ['verified', 'pending'])->with('competencies')->get();
        $latestAttempt = $user->assessmentAttempts()->where('career_id', $career->id)->with('results')->latest()->first();

        $results = [];

        foreach ($career->competencies as $competency) {
            $requiredLevel = (float) $competency->pivot->required_level;
            
            // Base score from assessment attempt if available
            $assessmentScore = 0.0;
            if ($latestAttempt) {
                $itemResult = $latestAttempt->results->where('competency_id', $competency->id)->first();
                if ($itemResult) {
                    $assessmentScore = (float) $itemResult->score;
                }
            }

            // Additional score boost from validated evidence
            $evidenceBonus = 0.0;
            $evidenceCount = 0;
            $hasVerified = false;

            foreach ($userEvidence as $ev) {
                $matchingComp = $ev->competencies->where('id', $competency->id)->first();
                if ($matchingComp) {
                    $evidenceCount++;
                    if ($ev->validation_status === 'verified') {
                        $hasVerified = true;
                        $evidenceBonus += 1.0;
                    } else {
                        $evidenceBonus += 0.5;
                    }
                }
            }

            $currentLevel = min(5.0, round($assessmentScore + $evidenceBonus, 2));
            if ($currentLevel == 0 && $evidenceCount == 0 && !$latestAttempt) {
                $status = 'belum_dinilai';
            } elseif ($hasVerified && $currentLevel >= $requiredLevel) {
                $status = 'terverifikasi';
            } elseif ($currentLevel >= $requiredLevel) {
                $status = 'memenuhi';
            } else {
                $status = 'perlu_ditingkatkan';
            }

            $gap = max(0.0, round($requiredLevel - $currentLevel, 2));

            $results[] = [
                'competency_id' => $competency->id,
                'name' => $competency->name,
                'slug' => $competency->slug,
                'domain' => $competency->domain,
                'priority' => $competency->pivot->priority,
                'required_level' => $requiredLevel,
                'current_level' => $currentLevel,
                'gap' => $gap,
                'status' => $status,
                'evidence_count' => $evidenceCount,
                'explanation' => $this->generateExplanation($competency->name, $requiredLevel, $currentLevel, $gap, $status, $evidenceCount),
            ];
        }

        return $results;
    }

    private function generateExplanation(string $name, float $req, float $curr, float $gap, string $status, int $evCount): string
    {
        if ($status === 'terverifikasi') {
            return "Telah memenuhi standar ($curr/$req) dengan $evCount bukti yang terverifikasi oleh reviewer.";
        }
        if ($status === 'memenuhi') {
            return "Memenuhi tingkat target ($curr/$req). Disarankan menambah sertifikat/portofolio resmi untuk verifikasi.";
        }
        if ($status === 'belum_dinilai') {
            return "Belum ada asesmen atau bukti kemampuan yang disubmit untuk kompetensi $name.";
        }
        return "Terdapat selisih $gap tingkat ($curr dari $req). Memerlukan aktivitas belajar tambahan dan pengunggahan bukti baru.";
    }
}
