<?php
// app/Http/Controllers/SubjectController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Services\SubjectService;

class SubjectController extends Controller
{
    protected SubjectService $service;

    public function __construct(SubjectService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $search = $request->query('search');
        $subjects = $this->service->paginate($search, 10);

        return view('subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('subjects.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'workload_hours' => 'required|integer|min:1',
        ]);

        $this->service->create($data);

        return redirect()->route('subjects.index')
                         ->with('success', 'Disciplina criada com sucesso!');
    }

    public function edit(Subject $subject)
    {
        return view('subjects.edit', compact('subject'));
    }

    public function update(Request $request, Subject $subject)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'workload_hours' => 'required|integer|min:1',
        ]);

        $this->service->update($subject, $data);

        return redirect()->route('subjects.index')
                         ->with('success', 'Disciplina atualizada com sucesso!');
    }

    public function destroy(Subject $subject)
    {
        $this->service->delete($subject);

        return redirect()->route('subjects.index')
                         ->with('success', 'Disciplina excluída com sucesso!');
    }

    public function show(Subject $subject)
    {
        return view('subjects.show', compact('subject'));
    }
}
