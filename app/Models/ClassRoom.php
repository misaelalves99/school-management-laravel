<?php
// app/Models/ClassRoom.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Teacher;
use App\Models\Subject;

class ClassRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'capacity',
        'schedule',
        'class_teacher_id',
    ];

    /**
     * Relacionamento muitos-para-muitos com disciplinas
     */
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'class_room_subject');
    }

    /**
     * Relacionamento muitos-para-muitos com professores auxiliares
     */
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'class_room_teacher');
    }

    /**
     * Professor responsável pela sala
     */
    public function classTeacher()
    {
        return $this->belongsTo(Teacher::class, 'class_teacher_id');
    }
}
