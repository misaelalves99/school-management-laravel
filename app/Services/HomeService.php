<?php
// app/Http/Services/HomeService.php

namespace App\Services;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\ClassRoom;
use App\Models\Enrollment;

class HomeService
{
    /**
     * Retorna contagem de alunos
     */
    public function countStudents(): int
    {
        return Student::count();
    }

    /**
     * Retorna contagem de professores
     */
    public function countTeachers(): int
    {
        return Teacher::count();
    }

    /**
     * Retorna contagem de disciplinas
     */
    public function countSubjects(): int
    {
        return Subject::count();
    }

    /**
     * Retorna contagem de salas
     */
    public function countClassRooms(): int
    {
        return ClassRoom::count();
    }

    /**
     * Retorna contagem de matrículas
     */
    public function countEnrollments(): int
    {
        return Enrollment::count();
    }

    /**
     * Retorna todas as estatísticas em um array
     */
    public function dashboardStats(): array
    {
        return [
            'students' => $this->countStudents(),
            'teachers' => $this->countTeachers(),
            'subjects' => $this->countSubjects(),
            'classRooms' => $this->countClassRooms(),
            'enrollments' => $this->countEnrollments(),
        ];
    }
}
