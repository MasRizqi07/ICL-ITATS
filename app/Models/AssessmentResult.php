<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class AssessmentResult extends Model
{
    use HasUuids;

    protected $fillable = [
        'attempt_id',
        'competency_id',
        'score',
        'max_score',
        'explanation',
    ];

    public function attempt()
    {
        return $this->belongsTo(AssessmentAttempt::class, 'attempt_id');
    }

    public function competency()
    {
        return $this->belongsTo(Competency::class, 'competency_id');
    }
}
