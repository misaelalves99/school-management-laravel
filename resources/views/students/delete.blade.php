<!-- resources/views/students/delete.blade.php -->

@extends('layouts.app')

@section('title', 'Excluir Aluno')

@push('styles')
    @vite(['resources/css/students/delete.css'])
@endpush

@section('content')

@php
    $studentId = $id ?? null; // Recebido via rota
@endphp

@if(!$studentId || !isset($student))
    <div class="container">
        <h1 class="title">Aluno não encontrado</h1>
    </div>
@else
    <div class="container">
        <h1 class="title">Excluir Aluno</h1>
        <h3 class="warning">
            Tem certeza que deseja excluir <strong>{{ $student->name }}</strong>?
        </h3>

        <div class="actions">
            <form action="{{ route('students.destroy', $student->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btnDelete">Excluir</button>
            </form>
            <a href="{{ route('students.index') }}" class="btnCancel">Cancelar</a>
        </div>
    </div>
@endif
@endsection
