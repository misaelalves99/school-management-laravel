<?php
// app/Http/Controllers/EnrollmentController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\ClassRoom;
use App\Models\Enrollment;
use App\Services\EnrollmentService;

class EnrollmentController extends Controller
{
    protected EnrollmentService $service;

    public function __construct(EnrollmentService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $search = $request->query('search');
        $enrollments = $this->service->paginate($search, 10);

        return view('enrollments.index', compact('enrollments'));
    }

    public function create()
    {
        $students = Student::all();
        $classRooms = ClassRoom::all();
        return view('enrollments.create', compact('students', 'classRooms'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'student_id' => 'required|exists:students,id',
            'class_room_id' => 'required|exists:class_rooms,id',
            'enrollment_date' => 'required|date',
            'status' => 'required|in:ativo,inativo',
        ]);

        $this->service->create($data);

        return redirect()->route('enrollments.index')->with('success', 'Matrícula criada com sucesso!');
    }

    public function show(Enrollment $enrollment)
    {
        $enrollment->load(['student', 'classRoom']);
        return view('enrollments.details', compact('enrollment'));
    }

    public function edit(Enrollment $enrollment)
    {
        $students = Student::all();
        $classRooms = ClassRoom::all();
        return view('enrollments.edit', compact('enrollment', 'students', 'classRooms'));
    }

    public function update(Request $request, Enrollment $enrollment)
    {
        $data = $request->validate([
            'student_id' => 'required|exists:students,id',
            'class_room_id' => 'required|exists:class_rooms,id',
            'enrollment_date' => 'required|date',
            'status' => 'required|in:ativo,inativo',
        ]);

        $this->service->update($enrollment, $data);

        return redirect()->route('enrollments.index')->with('success', 'Matrícula atualizada com sucesso!');
    }

    // ✅ Novo método: abre a página de confirmação de exclusão
    public function delete(Enrollment $enrollment)
    {
        $enrollment->load(['student', 'classRoom']);
        return view('enrollments.delete', compact('enrollment'));
    }

    public function destroy(Enrollment $enrollment)
    {
        $this->service->delete($enrollment);
        return redirect()->route('enrollments.index')->with('success', 'Matrícula excluída com sucesso!');
    }
}
