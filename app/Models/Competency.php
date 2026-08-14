<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Competency extends Model
{
    use HasUuids;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'domain',
    ];

    public function careers()
    {
        return $this->belongsToMany(Career::class, 'career_competencies')
                    ->withPivot(['required_level', 'priority', 'weight', 'rule_version', 'source_notes'])
                    ->withTimestamps();
    }

    public function evidence()
    {
        return $this->belongsToMany(Evidence::class, 'evidence_competencies')
                    ->withPivot(['relevance', 'note']);
    }
}
