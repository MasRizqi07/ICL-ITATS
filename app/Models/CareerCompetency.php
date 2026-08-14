<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class CareerCompetency extends Model
{
    use HasUuids;

    protected $table = 'career_competencies';

    protected $fillable = [
        'career_id',
        'competency_id',
        'required_level',
        'priority',
        'weight',
        'rule_version',
        'source_notes',
    ];

    public function career()
    {
        return $this->belongsTo(Career::class, 'career_id');
    }

    public function competency()
    {
        return $this->belongsTo(Competency::class, 'competency_id');
    }
}
