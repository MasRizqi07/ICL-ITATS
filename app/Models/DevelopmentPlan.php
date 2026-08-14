<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class DevelopmentPlan extends Model
{
    use HasUuids;

    protected $fillable = [
        'user_id',
        'career_id',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function career()
    {
        return $this->belongsTo(Career::class, 'career_id');
    }

    public function activities()
    {
        return $this->hasMany(DevelopmentActivity::class, 'plan_id');
    }
}
