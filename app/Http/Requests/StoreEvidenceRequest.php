<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

class StoreEvidenceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isStudent() ?? false;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', Rule::in(['project', 'portfolio', 'test', 'certificate', 'reflection', 'other'])],
            'description' => ['required', 'string', 'max:5000'],
            'source_url' => ['nullable', 'url', 'max:2048', 'required_without:evidence_file'],
            'evidence_file' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png,zip', 'max:10240', 'required_without:source_url'],
            'obtained_at' => ['nullable', 'date'],
            'competency_ids' => ['required', 'array', 'min:1'],
            'competency_ids.*' => ['required', 'exists:competencies,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'source_url.required_without' => 'Harap isi tautan bukti (URL) atau unggah berkas bukti kemampuan.',
            'evidence_file.required_without' => 'Harap unggah berkas bukti kemampuan atau sertakan tautan bukti (URL).',
            'competency_ids.required' => 'Pilih minimal satu kompetensi yang didukung oleh bukti ini.',
            'competency_ids.min' => 'Pilih minimal satu kompetensi yang didukung oleh bukti ini.',
        ];
    }
}
