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

    public function index(Request $request)
    {
        $search = $request->query('search');
        $students = $this->studentService->paginate($search, 10);

        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

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

    public function show(Student $student)
    {
        // Passa o aluno para a view details.blade.php
        return view('students.details', compact('student'));
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

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

    public function destroy(Student $student)
    {
        $this->studentService->delete($student);

        return redirect()->route('students.index')
                         ->with('success', 'Aluno excluído com sucesso!');
    }
}
