<?php
// app/Http/Services/SubjectService.php

namespace App\Services;

use App\Models\Subject;

class SubjectService
{
    /**
     * Pagina disciplinas com busca opcional
     */
    public function paginate(?string $query = null, int $perPage = 10)
    {
        $q = Subject::query();

        if ($query) {
            $q->where('name', 'like', "%{$query}%")
              ->orWhere('description', 'like', "%{$query}%");
        }

        return $q->orderBy('id', 'desc')->paginate($perPage);
    }

    public function getById(int $id): ?Subject
    {
        return Subject::find($id);
    }

    public function create(array $data): Subject
    {
        return Subject::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'workload_hours' => $data['workload_hours'] ?? 0,
        ]);
    }

    public function update(Subject $subject, array $data): Subject
    {
        $subject->update([
            'name' => $data['name'],
            'description' => $data['description'],
            'workload_hours' => $data['workload_hours'] ?? $subject->workload_hours,
        ]);

        return $subject;
    }

    public function delete(Subject $subject): bool
    {
        return $subject->delete();
    }
}
