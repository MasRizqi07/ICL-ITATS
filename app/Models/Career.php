<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasUuids;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'status',
        'version',
        'source_notes',
        'created_by',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function careerCompetencies()
    {
        return $this->hasMany(CareerCompetency::class, 'career_id');
    }

    public function competencies()
    {
        return $this->belongsToMany(Competency::class, 'career_competencies')
                    ->withPivot(['required_level', 'priority', 'weight', 'rule_version', 'source_notes'])
                    ->withTimestamps();
    }

    public function assessments()
    {
        return $this->hasMany(Assessment::class, 'career_id');
    }
}
