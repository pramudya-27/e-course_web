<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseRating extends Model
{
    protected $fillable = ['user_id', 'course_id', 'rating'];
}
