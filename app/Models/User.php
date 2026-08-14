<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasUuids, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'program',
        'semester',
        'bio',
        'avatar_url',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function isStudent(): bool
    {
        return $this->role === 'student';
    }

    public function isReviewer(): bool
    {
        return $this->role === 'reviewer';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function evidence()
    {
        return $this->hasMany(Evidence::class, 'user_id');
    }

    public function assessmentAttempts()
    {
        return $this->hasMany(AssessmentAttempt::class, 'user_id');
    }

    public function developmentPlans()
    {
        return $this->hasMany(DevelopmentPlan::class, 'user_id');
    }

    public function reassessments()
    {
        return $this->hasMany(Reassessment::class, 'user_id');
    }
}
