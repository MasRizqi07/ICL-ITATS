<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEvidenceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string'],
            'description' => ['required', 'string'],
            'source_url' => ['nullable', 'url'],
            'obtained_at' => ['nullable', 'date'],
            'competency_ids' => ['required', 'array'],
            'competency_ids.*' => ['exists:competencies,id'],
        ];
    }
}
