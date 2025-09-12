<?php
// app/Http/Services/TeacherService.php

namespace App\Services;

use App\Models\Teacher;

class TeacherService
{
    /**
     * Retorna todos os professores paginados
     */
    public function paginate(?string $query = null, int $perPage = 10)
    {
        $q = Teacher::query();

        if ($query) {
            $q->where('name', 'like', "%{$query}%")
              ->orWhere('subject', 'like', "%{$query}%");
        }

        return $q->orderBy('id', 'desc')->paginate($perPage);
    }

    /**
     * Retorna um professor específico pelo ID
     */
    public function getById(int $id): ?Teacher
    {
        return Teacher::find($id);
    }

    /**
     * Cria um novo professor
     */
    public function create(array $data): Teacher
    {
        return Teacher::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'date_of_birth' => $data['date_of_birth'],
            'subject' => $data['subject'],
            'phone' => $data['phone'] ?? null,
            'address' => $data['address'] ?? null,
            'photo_url' => $data['photo_url'] ?? null,
        ]);
    }

    /**
     * Atualiza um professor existente
     */
    public function update(Teacher $teacher, array $data): Teacher
    {
        $teacher->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'date_of_birth' => $data['date_of_birth'],
            'subject' => $data['subject'],
            'phone' => $data['phone'] ?? $teacher->phone,
            'address' => $data['address'] ?? $teacher->address,
            'photo_url' => $data['photo_url'] ?? $teacher->photo_url,
        ]);

        return $teacher;
    }

    /**
     * Exclui um professor
     */
    public function delete(Teacher $teacher): bool
    {
        return $teacher->delete();
    }
}
