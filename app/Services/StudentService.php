<?php
// app/Http/Services/StudentService.php

namespace App\Services;

use App\Models\Student;
use Illuminate\Database\Eloquent\Collection;

class StudentService
{
    /**
     * Listar todos os alunos
     *
     * @return Collection|Student[]
     */
    public function all(): Collection
    {
        return Student::all();
    }

    /**
     * Buscar alunos por nome (opcional)
     *
     * @param string|null $name
     * @return Collection|Student[]
     */
    public function searchByName(?string $name): Collection
    {
        if (!$name) {
            return $this->all();
        }

        return Student::where('name', 'like', "%{$name}%")->get();
    }

    /**
     * Criar um novo aluno
     *
     * @param array $data
     * @return Student
     */
    public function create(array $data): Student
    {
        return Student::create($data);
    }

    /**
     * Atualizar um aluno existente
     *
     * @param Student $student
     * @param array $data
     * @return Student
     */
    public function update(Student $student, array $data): Student
    {
        $student->update($data);
        return $student;
    }

    /**
     * Deletar um aluno
     *
     * @param Student $student
     * @return bool
     */
    public function delete(Student $student): bool
    {
        return $student->delete();
    }

    /**
     * Obter aluno por ID
     *
     * @param int $id
     * @return Student|null
     */
    public function find(int $id): ?Student
    {
        return Student::find($id);
    }
}
