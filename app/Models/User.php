<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Course;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected $fillable = ['name', 'email', 'password', 'is_admin'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    use Notifiable;
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'registrations', 'user_id', 'course_id')->withTimestamps();
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    use Notifiable;

}
