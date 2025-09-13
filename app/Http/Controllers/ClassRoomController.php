<?php
// app/Http/Controllers/ClassRoomController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ClassRoomService;
use App\Models\Teacher;
use App\Models\Subject;

class ClassRoomController extends Controller
{
    protected $service;

    public function __construct(ClassRoomService $service)
    {
        $this->service = $service;
    }

    /**
     * Lista todas as salas
     */
    public function index()
    {
        $classRooms = $this->service->all();
        return view('classrooms.index', compact('classRooms'));
    }

    /**
     * Mostra detalhes de uma sala
     */
    public function show(int $id)
    {
        $classRoom = $this->service->find($id);
        return view('classrooms.details', compact('classRoom'));
    }
    
    /**
     * Formulário de criação
     */
    public function create()
    {
        $teachers = Teacher::all();
        $subjects = Subject::all();
        return view('classrooms.create', compact('teachers', 'subjects'));
    }

    /**
     * Salva uma nova sala
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'schedule' => 'required|string|max:255',
            'class_teacher_id' => 'nullable|exists:teachers,id',
            'teacher_ids' => 'nullable|array',
            'teacher_ids.*' => 'exists:teachers,id',
            'subject_ids' => 'nullable|array',
            'subject_ids.*' => 'exists:subjects,id',
        ]);

        $this->service->create($data);

        return redirect()->route('classrooms.index')->with('success', 'Sala criada com sucesso!');
    }

    /**
     * Formulário de edição
     */
    public function edit(int $id)
    {
        $classRoom = $this->service->find($id);
        $teachers = Teacher::all();
        $subjects = Subject::all();

        return view('classrooms.edit', compact('classRoom', 'teachers', 'subjects'));
    }

    /**
     * Atualiza uma sala
     */
    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'schedule' => 'required|string|max:255',
            'class_teacher_id' => 'nullable|exists:teachers,id',
            'teacher_ids' => 'nullable|array',
            'teacher_ids.*' => 'exists:teachers,id',
            'subject_ids' => 'nullable|array',
            'subject_ids.*' => 'exists:subjects,id',
        ]);

        $this->service->update($id, $data);

        return redirect()->route('classrooms.index')->with('success', 'Sala atualizada com sucesso!');
    }

    /**
     * Remove uma sala
     */
    public function destroy(int $id)
    {
        $this->service->delete($id);
        return redirect()->route('classrooms.index')->with('success', 'Sala removida com sucesso!');
    }
}
