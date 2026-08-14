<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class AssessmentItem extends Model
{
    use HasUuids;

    protected $fillable = [
        'assessment_id',
        'competency_id',
        'prompt',
        'item_type',
        'max_score',
        'position',
    ];

    public function assessment()
    {
        return $this->belongsTo(Assessment::class, 'assessment_id');
    }

    public function competency()
    {
        return $this->belongsTo(Competency::class, 'competency_id');
    }
}
