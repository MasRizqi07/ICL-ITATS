<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReviewEvidenceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isReviewer() ?? false;
    }

    public function rules(): array
    {
        return [
            'validation_status' => ['required', 'string', Rule::in(['pending', 'verified', 'needs_revision'])],
            'reviewer_note' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'validation_status.required' => 'Status validasi wajib dipilih.',
            'validation_status.in' => 'Status validasi tidak valid.',
        ];
    }
}
