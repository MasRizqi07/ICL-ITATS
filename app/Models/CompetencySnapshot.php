<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class CompetencySnapshot extends Model
{
    use HasUuids;

    protected $fillable = [
        'reassessment_id',
        'competency_id',
        'required_level',
        'current_level',
        'gap',
        'status',
        'evidence_summary',
        'explanation',
    ];

    public function reassessment()
    {
        return $this->belongsTo(Reassessment::class, 'reassessment_id');
    }

    public function competency()
    {
        return $this->belongsTo(Competency::class, 'competency_id');
    }
}
