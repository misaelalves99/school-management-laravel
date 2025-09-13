<?php
// app/Http/Services/StudentService.php

namespace App\Services;

use App\Models\Student;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

class StudentService
{
    /**
     * Listar alunos com busca e paginação
     *
     * @param string|null $search
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function paginate(?string $search = null, int $perPage = 10): LengthAwarePaginator
    {
        $query = Student::query();

        if ($search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('enrollment_number', 'like', "%{$search}%");
        }

        return $query->orderBy('id', 'desc')->paginate($perPage);
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

    /**
     * Buscar todos os alunos (opcional sem paginação)
     *
     * @return \Illuminate\Database\Eloquent\Collection|Student[]
     */
    public function all()
    {
        return Student::all();
    }
}
