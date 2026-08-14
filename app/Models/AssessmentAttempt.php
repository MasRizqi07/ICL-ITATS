<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class AssessmentAttempt extends Model
{
    use HasUuids;

    protected $fillable = [
        'user_id',
        'assessment_id',
        'career_id',
        'status',
        'submitted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function assessment()
    {
        return $this->belongsTo(Assessment::class, 'assessment_id');
    }

    public function career()
    {
        return $this->belongsTo(Career::class, 'career_id');
    }

    public function results()
    {
        return $this->hasMany(AssessmentResult::class, 'attempt_id');
    }
}
