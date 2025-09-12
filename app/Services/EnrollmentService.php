<?php
// app/Http/Services/EnrollmentService.php

namespace App\Services;

use App\Models\Enrollment;

class EnrollmentService
{
    public function paginate(int $perPage = 10)
    {
        return Enrollment::with(['student', 'classRoom'])->orderBy('id', 'desc')->paginate($perPage);
    }

    public function getById(int $id): ?Enrollment
    {
        return Enrollment::with(['student', 'classRoom'])->find($id);
    }

    public function create(array $data): Enrollment
    {
        return Enrollment::create([
            'student_id' => $data['student_id'],
            'class_room_id' => $data['class_room_id'],
            'enrollment_date' => $data['enrollment_date'],
            'status' => $data['status'] ?? 'ativo',
        ]);
    }

    public function update(Enrollment $enrollment, array $data): Enrollment
    {
        $enrollment->update([
            'student_id' => $data['student_id'],
            'class_room_id' => $data['class_room_id'],
            'enrollment_date' => $data['enrollment_date'],
            'status' => $data['status'] ?? $enrollment->status,
        ]);

        return $enrollment;
    }

    public function delete(Enrollment $enrollment): bool
    {
        return $enrollment->delete();
    }

    public function search(string $query)
    {
        return Enrollment::with(['student', 'classRoom'])
            ->whereHas('student', fn($q) => $q->where('name', 'like', "%{$query}%"))
            ->orWhereHas('classRoom', fn($q) => $q->where('name', 'like', "%{$query}%"))
            ->orWhere('status', 'like', "%{$query}%")
            ->get();
    }
}
