<!-- resources/views/classrooms/details.blade.php -->

@extends('layouts.app')

@section('title', 'Detalhes da Turma')

@push('styles')
    @vite(['resources/css/classrooms/details.css'])
@endpush

@section('content')
<div class="container">
    @if(!$classRoom)
        <p>Turma não encontrada.</p>
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

        @if($classRoom->classTeacher)
            <div class="detailsRow">
                <span class="detailsLabel">Professor Titular:</span>
                <span class="detailsValue">{{ $classRoom->classTeacher->name }}</span>
            </div>
        @endif

        @if($classRoom->teachers->count() > 0)
            <div class="detailsRow">
                <span class="detailsLabel">Professores:</span>
                <span class="detailsValue">
                    <ul>
                        @foreach($classRoom->teachers as $teacher)
                            <li>{{ $teacher->name }}</li>
                        @endforeach
                    </ul>
                </span>
            </div>
        @endif

        @if($classRoom->subjects->count() > 0)
            <div class="detailsRow">
                <span class="detailsLabel">Disciplinas:</span>
                <span class="detailsValue">
                    <ul>
                        @foreach($classRoom->subjects as $subject)
                            <li>{{ $subject->name }}</li>
                        @endforeach
                    </ul>
                </span>
            </div>
        @endif

        <div class="actions">
            <a href="{{ route('classrooms.edit', $classRoom->id) }}" class="btnWarning">Editar</a>
            <a href="{{ route('classrooms.index') }}" class="btnSecondary">Voltar</a>
        </div>
    @endif
</div>
@endsection
