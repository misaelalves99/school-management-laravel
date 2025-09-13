<?php
// app/Http/Controllers/TeacherController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Teacher;
use App\Services\TeacherService;

class TeacherController extends Controller
{
    protected TeacherService $service;

    public function __construct(TeacherService $service)
    {
        $this->service = $service;
    }

    /**
     * Listar professores com busca e paginação
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $teachers = $this->service->paginate($search, 10);

        return view('teachers.index', compact('teachers'));
    }

    /**
     * Formulário de criação
     */
    public function create()
    {
        $subjects = Subject::all();
        return view('teachers.create', compact('subjects'));
    }

    /**
     * Armazenar novo professor
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email',
            'date_of_birth' => 'required|date',
            'subject' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'photo_url' => 'nullable|url',
        ]);

        $this->service->create($data);

        return redirect()->route('teachers.index')
                         ->with('success', 'Professor criado com sucesso!');
    }

    /**
     * Formulário de edição
     */
    public function edit(Teacher $teacher)
    {
        $subjects = Subject::all();
        return view('teachers.edit', compact('teacher', 'subjects'));
    }

    /**
     * Atualizar professor
     */
    public function update(Request $request, Teacher $teacher)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email,' . $teacher->id,
            'date_of_birth' => 'required|date',
            'subject' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'photo_url' => 'nullable|url',
        ]);

        $this->service->update($teacher, $data);

        return redirect()->route('teachers.index')
                         ->with('success', 'Professor atualizado com sucesso!');
    }

    /**
     * Mostrar página de confirmação de exclusão
     */
    public function delete(Teacher $teacher)
    {
        return view('teachers.delete', compact('teacher'));
    }

    /**
     * Excluir professor
     */
    public function destroy(Teacher $teacher)
    {
        $this->service->delete($teacher);

        return redirect()->route('teachers.index')
                         ->with('success', 'Professor excluído com sucesso!');
    }

    /**
     * Mostrar detalhes
     */
    public function show(Teacher $teacher)
    {
        return view('teachers.details', compact('teacher'));
    }
}
