<?php
// app/Http/Controllers/StudentController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Services\StudentService;

class StudentController extends Controller
{
    protected StudentService $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    /**
     * Lista os alunos
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $students = $this->studentService->paginate($search, 10);

        return view('students.index', compact('students'));
    }

    /**
     * Formulário de criação
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Salva um novo aluno
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'date_of_birth' => 'required|date',
            'enrollment_number' => 'required|string|unique:students,enrollment_number',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        $this->studentService->create($data);

        return redirect()->route('students.index')
                         ->with('success', 'Aluno criado com sucesso!');
    }

    /**
     * Mostra detalhes de um aluno
     */
    public function show(Student $student)
    {
        return view('students.details', compact('student'));
    }

    /**
     * Formulário de edição
     */
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    /**
     * Atualiza um aluno
     */
    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'date_of_birth' => 'required|date',
            'enrollment_number' => 'required|string|unique:students,enrollment_number,' . $student->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        $this->studentService->update($student, $data);

        return redirect()->route('students.index')
                         ->with('success', 'Aluno atualizado com sucesso!');
    }

    /**
     * Remove um aluno (chamado pelo formulário de confirmação)
     */
    public function destroy(Student $student)
    {
        $this->studentService->delete($student);

        return redirect()->route('students.index')
                         ->with('success', 'Aluno excluído com sucesso!');
    }

    /**
     * Página de confirmação de exclusão
     */
    public function delete(Student $student)
    {
        return view('students.delete', compact('student'));
    }
}
