<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseRequest extends Model
{
    protected $fillable = ['user_id', 'course_id', 'status'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Course (opsional, untuk kelengkapan)
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
