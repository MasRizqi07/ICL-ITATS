<?php

namespace App\Services;

use App\Models\AiGeneration;
use App\Models\User;

class AiSupportService
{
    /**
     * Generate non-authoritative AI activity recommendations & gap summaries.
     */
    public function generateSuggestions(User $user, string $competencyName, float $gap): array
    {
        $prompt = "Mahasiswa {$user->name} memiliki skill gap {$gap} pada kompetensi {$competencyName}. Berikan saran aksi belajar.";

        $output = "Rekomendasi Aktivitas Belajar (Bantuan AI):\n"
            . "1. Pelajari modul kursus/dokumentasi resmi terkait {$competencyName}.\n"
            . "2. Kerjakan mini-project riil untuk membuktikan pemahaman praktis.\n"
            . "3. Unggah portofolio/sertifikat hasil belajar ke ICL ITATS untuk diverifikasi oleh Reviewer.";

        $generation = AiGeneration::create([
            'user_id' => $user->id,
            'purpose' => 'development_activity_suggestion',
            'input_reference' => ['competency' => $competencyName, 'gap' => $gap],
            'output_text' => $output,
            'provider' => 'fallback',
            'model' => 'icl-ai-engine-v1',
            'status' => 'generated',
        ]);

        return [
            'id' => $generation->id,
            'output' => $output,
            'status' => $generation->status,
        ];
    }
}
