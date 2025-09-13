<!-- resources/views/enrollments/details.blade.php -->

@extends('layouts.app')

@section('title', 'Detalhes da Matrícula')

@push('styles')
    @vite(['resources/css/enrollments/details.css'])
@endpush

@section('content')
<div class="container">
    @if(!$enrollment)
        <h2 class="title">Matrícula não encontrada</h2>
        <a href="{{ route('enrollments.index') }}" class="btn btnSecondary">Voltar à Lista</a>
    @else
        <h1 class="title">Detalhes da Matrícula</h1>

        <div class="detailsRow">
            <span class="detailsLabel">Aluno:</span>
            <span class="detailsValue">{{ $enrollment->student->name }}</span>
        </div>

        <div class="detailsRow">
            <span class="detailsLabel">Turma:</span>
            <span class="detailsValue">{{ $enrollment->classRoom->name }}</span>
        </div>

        <div class="detailsRow">
            <span class="detailsLabel">Status:</span>
            <span class="detailsValue">{{ ucfirst($enrollment->status) }}</span>
        </div>

        <div class="detailsRow">
            <span class="detailsLabel">Data da Matrícula:</span>
            <span class="detailsValue">{{ \Carbon\Carbon::parse($enrollment->enrollment_date)->format('d/m/Y') }}</span>
        </div>

        <div class="actions">
            <a href="{{ route('enrollments.edit', $enrollment->id) }}" class="btn btnWarning">Editar</a>
            <a href="{{ route('enrollments.index') }}" class="btn btnSecondary">Voltar à Lista</a>
        </div>
    @endif
</div>
@endsection
