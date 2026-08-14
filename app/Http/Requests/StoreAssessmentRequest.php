<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAssessmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isStudent() ?? false;
    }

    public function rules(): array
    {
        return [
            'scores' => ['required', 'array'],
            'scores.*' => ['required', 'numeric', 'min:0', 'max:5'],
        ];
    }

    public function messages(): array
    {
        return [
            'scores.required' => 'Skor asesmen mandiri wajib diisi.',
            'scores.array' => 'Format jawaban tidak valid.',
            'scores.*.numeric' => 'Skor harus berupa nilai numerik.',
            'scores.*.min' => 'Skor minimal adalah 0.0.',
            'scores.*.max' => 'Skor maksimal adalah 5.0.',
        ];
    }
}
