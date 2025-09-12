<?php
// app/Http/Controllers/ClassRoomController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassRoom;
use App\Models\Teacher;
use App\Models\Subject;
use App\Services\ClassRoomService;

class ClassRoomController extends Controller
{
    protected ClassRoomService $classRoomService;

    public function __construct(ClassRoomService $classRoomService)
    {
        $this->classRoomService = $classRoomService;
    }

    public function index(Request $request)
    {
        $search = $request->query('search');
        $classRooms = $this->classRoomService->paginate($search, 10); // agora com paginação
        return view('classrooms.index', compact('classRooms'));
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
            'capacity' => 'required|integer|min:1|max:100',
            'schedule' => 'required|string|max:255',
            'class_teacher_id' => 'nullable|exists:teachers,id',
            'subject_ids' => 'nullable|array',
            'subject_ids.*' => 'exists:subjects,id',
            'teacher_ids' => 'nullable|array',
            'teacher_ids.*' => 'exists:teachers,id',
        ]);

        $this->classRoomService->create($data);

        return redirect()->route('classrooms.index')->with('success', 'Sala criada com sucesso!');
    }

    public function show(ClassRoom $classRoom)
    {
        $classRoom = $this->classRoomService->find($classRoom->id);
        return view('classrooms.show', compact('classRoom'));
    }

    public function edit(ClassRoom $classRoom)
    {
        $teachers = Teacher::all();
        $subjects = Subject::all();
        return view('classrooms.edit', compact('classRoom', 'teachers', 'subjects'));
    }

    public function update(Request $request, ClassRoom $classRoom)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1|max:100',
            'schedule' => 'required|string|max:255',
            'class_teacher_id' => 'nullable|exists:teachers,id',
            'subject_ids' => 'nullable|array',
            'subject_ids.*' => 'exists:subjects,id',
            'teacher_ids' => 'nullable|array',
            'teacher_ids.*' => 'exists:teachers,id',
        ]);

        $this->classRoomService->update($classRoom, $data);

        return redirect()->route('classrooms.index')->with('success', 'Sala atualizada com sucesso!');
    }

    public function destroy(ClassRoom $classRoom)
    {
        $this->classRoomService->delete($classRoom);
        return redirect()->route('classrooms.index')->with('success', 'Sala excluída com sucesso!');
    }
}
