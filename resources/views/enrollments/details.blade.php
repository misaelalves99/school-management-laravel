<!-- resources/views/enrollments/details.blade.php -->

@extends('layouts.app')

@section('title', 'Detalhes da Matrícula')

@push('styles')
    @vite(['resources/css/enrollments/details.css'])
@endpush

@section('content')
<div class="container">
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
        <span class="detailsValue">{{ $enrollment->status }}</span>
    </div>

    <div class="detailsRow">
        <span class="detailsLabel">Data da Matrícula:</span>
        <span class="detailsValue">{{ $enrollment->enrollment_date->format('d/m/Y') }}</span>
    </div>

    <div class="actions">
        <a href="{{ route('enrollments.edit', $enrollment->id) }}" class="btnWarning">Editar</a>
        <a href="{{ route('enrollments.index') }}" class="btnSecondary">Voltar</a>
    </div>
</div>
@endsection
