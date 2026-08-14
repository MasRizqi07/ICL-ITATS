<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasUuids;

    protected $fillable = [
        'career_id',
        'title',
        'version',
        'status',
    ];

    public function career()
    {
        return $this->belongsTo(Career::class, 'career_id');
    }

    public function items()
    {
        return $this->hasMany(AssessmentItem::class, 'assessment_id')->orderBy('position');
    }

    public function attempts()
    {
        return $this->hasMany(AssessmentAttempt::class, 'assessment_id');
    }
}
