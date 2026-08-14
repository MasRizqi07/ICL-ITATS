<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Reassessment extends Model
{
    use HasUuids;

    protected $fillable = [
        'user_id',
        'career_id',
        'previous_id',
        'rule_version',
        'status',
        'completed_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function career()
    {
        return $this->belongsTo(Career::class, 'career_id');
    }

    public function previous()
    {
        return $this->belongsTo(Reassessment::class, 'previous_id');
    }

    public function snapshots()
    {
        return $this->hasMany(CompetencySnapshot::class, 'reassessment_id');
    }
}
