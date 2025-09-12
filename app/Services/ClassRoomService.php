<?php
// app/Http/Services/ClassRoomService.php

namespace App\Services;

use App\Models\ClassRoom;
use Illuminate\Support\Collection;

class ClassRoomService
{
    public function paginate(?string $term = null, int $perPage = 10)
    {
        $query = ClassRoom::with(['subjects', 'teachers', 'classTeacher']);

        if ($term) {
            $query->where(function($q) use ($term) {
                $q->where('name', 'like', "%{$term}%")
                  ->orWhere('schedule', 'like', "%{$term}%")
                  ->orWhere('capacity', $term);
            });
        }

        return $query->orderBy('id', 'desc')->paginate($perPage);
    }

    public function find(int $id): ?ClassRoom
    {
        return ClassRoom::with(['subjects', 'teachers', 'classTeacher'])->find($id);
    }

    public function create(array $data): ClassRoom
    {
        $classRoom = ClassRoom::create([
            'name' => $data['name'],
            'capacity' => $data['capacity'],
            'schedule' => $data['schedule'],
            'class_teacher_id' => $data['class_teacher_id'] ?? null,
        ]);

        $classRoom->subjects()->sync($data['subject_ids'] ?? []);
        $classRoom->teachers()->sync($data['teacher_ids'] ?? []);

        return $classRoom;
    }

    public function update(ClassRoom $classRoom, array $data): ClassRoom
    {
        $classRoom->update([
            'name' => $data['name'],
            'capacity' => $data['capacity'],
            'schedule' => $data['schedule'],
            'class_teacher_id' => $data['class_teacher_id'] ?? null,
        ]);

        $classRoom->subjects()->sync($data['subject_ids'] ?? []);
        $classRoom->teachers()->sync($data['teacher_ids'] ?? []);

        return $classRoom;
    }

    public function delete(ClassRoom $classRoom): bool
    {
        $classRoom->subjects()->detach();
        $classRoom->teachers()->detach();
        return $classRoom->delete();
    }
}
