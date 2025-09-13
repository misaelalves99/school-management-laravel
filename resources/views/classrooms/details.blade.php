<!-- resources/views/classrooms/details.blade.php -->

@extends('layouts.app')

@section('title', 'Detalhes da Turma')

@push('styles')
    @vite(['resources/css/classrooms/details.css'])
@endpush

@section('content')
<div class="container">
    @if(!$classRoom)
        <h2 class="title">Turma não encontrada</h2>
        <a href="{{ route('classrooms.index') }}" class="btn btnSecondary">Voltar à Lista</a>
    @else
        <h1 class="title">Detalhes da Turma</h1>

        <div class="detailsRow">
            <span class="detailsLabel">Nome:</span>
            <span class="detailsValue">{{ $classRoom->name }}</span>
        </div>

        <div class="detailsRow">
            <span class="detailsLabel">Capacidade:</span>
            <span class="detailsValue">{{ $classRoom->capacity }}</span>
        </div>

        <div class="detailsRow">
            <span class="detailsLabel">Horário:</span>
            <span class="detailsValue">{{ $classRoom->schedule }}</span>
        </div>

        <div class="detailsRow">
            <span class="detailsLabel">Professor Titular:</span>
            <span class="detailsValue">
                {{ $classRoom->classTeacher?->name ?? 'Não definido' }}
            </span>
        </div>

        <div class="detailsRow">
            <span class="detailsLabel">Professores Auxiliares:</span>
            <span class="detailsValue">
                @if($classRoom->teachers->isNotEmpty())
                    <ul>
                        @foreach($classRoom->teachers as $teacher)
                            <li>{{ $teacher->name }}</li>
                        @endforeach
                    </ul>
                @else
                    Nenhum professor auxiliar
                @endif
            </span>
        </div>

        <div class="detailsRow">
            <span class="detailsLabel">Disciplinas:</span>
            <span class="detailsValue">
                @if($classRoom->subjects->isNotEmpty())
                    <ul>
                        @foreach($classRoom->subjects as $subject)
                            <li>{{ $subject->name }}</li>
                        @endforeach
                    </ul>
                @else
                    Nenhuma disciplina atribuída
                @endif
            </span>
        </div>

        <div class="actions">
            <a href="{{ route('classrooms.edit', $classRoom->id) }}" class="btn btnWarning">Editar</a>
            <a href="{{ route('classrooms.index') }}" class="btn btnSecondary">Voltar à Lista</a>
        </div>
    @endif
</div>
@endsection
