<?php
// app/Http/Services/ClassRoomService.php

namespace App\Services;

use App\Models\ClassRoom;

class ClassRoomService
{
    /**
     * Pagina as salas com filtros opcionais.
     */
    public function paginate(?string $term = null, int $perPage = 10)
    {
        $query = ClassRoom::with(['subjects', 'teachers', 'classTeacher']);

        if ($term) {
            $query->where(function ($q) use ($term) {
                $q->where('name', 'like', "%{$term}%")
                  ->orWhere('schedule', 'like', "%{$term}%")
                  ->orWhere('capacity', $term);
            });
        }

        return $query->orderBy('id', 'desc')->paginate($perPage);
    }

    /**
     * Retorna uma sala pelo ID com relacionamentos carregados.
     */
    public function find(int $id): ?ClassRoom
    {
        return ClassRoom::with(['subjects', 'teachers', 'classTeacher'])->find($id);
    }

    /**
     * Cria uma nova sala e sincroniza professores e disciplinas.
     */
    public function create(array $data): ClassRoom
    {
        $classRoom = ClassRoom::create([
            'name' => $data['name'],
            'capacity' => $data['capacity'],
            'schedule' => $data['schedule'],
            'class_teacher_id' => $data['class_teacher_id'] ?? null,
        ]);

        // Sincroniza disciplinas e professores auxiliares (se existirem)
        if (!empty($data['subject_ids']) && is_array($data['subject_ids'])) {
            $classRoom->subjects()->sync($data['subject_ids']);
        }

        if (!empty($data['teacher_ids']) && is_array($data['teacher_ids'])) {
            $classRoom->teachers()->sync($data['teacher_ids']);
        }

        return $classRoom;
    }

    /**
     * Atualiza uma sala existente e sincroniza relacionamentos.
     */
    public function update(ClassRoom $classRoom, array $data): ClassRoom
    {
        $classRoom->update([
            'name' => $data['name'],
            'capacity' => $data['capacity'],
            'schedule' => $data['schedule'],
            'class_teacher_id' => $data['class_teacher_id'] ?? null,
        ]);

        if (isset($data['subject_ids']) && is_array($data['subject_ids'])) {
            $classRoom->subjects()->sync($data['subject_ids']);
        } else {
            $classRoom->subjects()->sync([]);
        }

        if (isset($data['teacher_ids']) && is_array($data['teacher_ids'])) {
            $classRoom->teachers()->sync($data['teacher_ids']);
        } else {
            $classRoom->teachers()->sync([]);
        }

        return $classRoom;
    }

    /**
     * Remove uma sala e todos os relacionamentos pivot.
     */
    public function delete(ClassRoom $classRoom): bool
    {
        $classRoom->subjects()->detach();
        $classRoom->teachers()->detach();
        return $classRoom->delete();
    }
}
