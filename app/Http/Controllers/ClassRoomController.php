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

    public function index()
    {
        $classRooms = $this->service->all();
        return view('classrooms.index', compact('classRooms'));
    }

    public function show(int $id)
    {
        $classRoom = $this->service->find($id);
        return view('classrooms.details', compact('classRoom'));
    }

    public function create()
    {
        $teachers = Teacher::all();
        $subjects = Subject::all();
        return view('classrooms.create', compact('teachers', 'subjects'));
    }

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

    public function edit(int $id)
    {
        $classRoom = $this->service->find($id);
        $teachers = Teacher::all();
        $subjects = Subject::all();
        return view('classrooms.edit', compact('classRoom', 'teachers', 'subjects'));
    }

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
     * Página de confirmação de exclusão
     */
    public function delete(int $id)
    {
        $classRoom = $this->service->find($id);

        if (!$classRoom) {
            return redirect()->route('classrooms.index')->with('error', 'Sala não encontrada.');
        }

        return view('classrooms.delete', compact('classRoom'));
    }

    public function destroy(int $id)
    {
        $this->service->delete($id);
        return redirect()->route('classrooms.index')->with('success', 'Sala removida com sucesso!');
    }
}
