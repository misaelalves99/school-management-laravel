<?php
// app/Services/ClassRoomService.php

namespace App\Services;

use App\Models\ClassRoom;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ClassRoomService
{
    /**
     * Retorna todas as salas
     */
    public function all(): Collection
    {
        return ClassRoom::with(['subjects', 'teachers', 'classTeacher'])->get();
    }

    /**
     * Retorna uma sala pelo ID
     */
    public function find(int $id): ClassRoom
    {
        $classRoom = ClassRoom::with(['subjects', 'teachers', 'classTeacher'])->find($id);

        if (!$classRoom) {
            throw new ModelNotFoundException("Sala com ID $id não encontrada.");
        }

        return $classRoom;
    }

    /**
     * Cria uma nova sala
     */
    public function create(array $data): ClassRoom
    {
        $classRoom = ClassRoom::create([
            'name' => $data['name'],
            'capacity' => $data['capacity'],
            'schedule' => $data['schedule'],
            'class_teacher_id' => $data['class_teacher_id'] ?? null,
        ]);

        if (!empty($data['teacher_ids'])) {
            $classRoom->teachers()->sync($data['teacher_ids']);
        }

        if (!empty($data['subject_ids'])) {
            $classRoom->subjects()->sync($data['subject_ids']);
        }

        return $classRoom;
    }

    /**
     * Atualiza uma sala existente
     */
    public function update(int $id, array $data): ClassRoom
    {
        $classRoom = $this->find($id);

        $classRoom->update([
            'name' => $data['name'],
            'capacity' => $data['capacity'],
            'schedule' => $data['schedule'],
            'class_teacher_id' => $data['class_teacher_id'] ?? null,
        ]);

        if (isset($data['teacher_ids'])) {
            $classRoom->teachers()->sync($data['teacher_ids']);
        }

        if (isset($data['subject_ids'])) {
            $classRoom->subjects()->sync($data['subject_ids']);
        }

        return $classRoom;
    }

    /**
     * Remove uma sala
     */
    public function delete(int $id): bool
    {
        $classRoom = $this->find($id);
        return $classRoom->delete();
    }
}
