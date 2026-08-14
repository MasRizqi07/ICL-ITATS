<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class AiGeneration extends Model
{
    use HasUuids;

    protected $fillable = [
        'user_id',
        'purpose',
        'input_reference',
        'output_text',
        'provider',
        'model',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'input_reference' => 'array',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
