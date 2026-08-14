<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasUuids;

    protected $table = 'feedback';

    protected $fillable = [
        'reviewer_id',
        'student_id',
        'evidence_id',
        'competency_id',
        'body',
    ];

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function evidence()
    {
        return $this->belongsTo(Evidence::class, 'evidence_id');
    }

    public function competency()
    {
        return $this->belongsTo(Competency::class, 'competency_id');
    }
}
