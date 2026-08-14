<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Evidence extends Model
{
    use HasUuids;

    protected $table = 'evidence';

    protected $fillable = [
        'user_id',
        'title',
        'type',
        'description',
        'source_url',
        'storage_key',
        'obtained_at',
        'validation_status',
        'reviewer_id',
        'reviewer_note',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }

    public function competencies()
    {
        return $this->belongsToMany(Competency::class, 'evidence_competencies')
                    ->withPivot(['relevance', 'note']);
    }

    public function activities()
    {
        return $this->belongsToMany(DevelopmentActivity::class, 'activity_evidence', 'evidence_id', 'activity_id');
    }
}
