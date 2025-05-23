<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['title', 'description', 'duration', 'user_id', 'price',  'thumbnail', 'theme_link'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'registrations', 'course_id', 'user_id')->withTimestamps();
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
    
}
