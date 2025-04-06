<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    // Nama tabel (opsional, jika sesuai dengan konvensi Laravel 'contacts')
    protected $table = 'contacts';

    // Kolom yang bisa diisi
    protected $fillable = ['name', 'email', 'message', 'is_read'];
}