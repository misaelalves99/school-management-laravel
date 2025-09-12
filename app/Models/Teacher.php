<?php
// app/Models/Teacher.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'date_of_birth',
        'subject',
        'phone',
        'address',
        'photo_url',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];
}
