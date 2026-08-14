<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class DevelopmentActivity extends Model
{
    use HasUuids;

    protected $fillable = [
        'plan_id',
        'competency_id',
        'title',
        'description',
        'expected_evidence',
        'priority',
        'status',
        'target_date',
        'completed_at',
        'reflection',
    ];

    public function plan()
    {
        return $this->belongsTo(DevelopmentPlan::class, 'plan_id');
    }

    public function competency()
    {
        return $this->belongsTo(Competency::class, 'competency_id');
    }

    public function evidence()
    {
        return $this->belongsToMany(Evidence::class, 'activity_evidence', 'activity_id', 'evidence_id');
    }
}
