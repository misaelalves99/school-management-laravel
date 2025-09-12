<!-- resources/views/students/details.blade.php -->

@extends('layouts.app')

@section('title', 'Detalhes do Aluno')

@push('styles')
    @vite(['resources/css/students/details.css'])
@endpush

@section('content')
<div class="container">
    @if(!isset($student))
        <h1 class="title">Aluno não encontrado</h1>
        <a href="{{ route('students.index') }}" class="btnSecondary">Voltar à Lista</a>
    @else
        <h1 class="title">Detalhes do Aluno</h1>

        <div class="detailsRow">
            <span class="detailsLabel">Nome:</span>
            <span class="detailsValue">{{ $student->name }}</span>
        </div>

        <div class="detailsRow">
            <span class="detailsLabel">Email:</span>
            <span class="detailsValue">{{ $student->email }}</span>
        </div>

        <div class="detailsRow">
            <span class="detailsLabel">Data de Nascimento:</span>
            <span class="detailsValue">{{ $student->dateOfBirth }}</span>
        </div>

        <div class="detailsRow">
            <span class="detailsLabel">Número de Matrícula:</span>
            <span class="detailsValue">{{ $student->enrollmentNumber }}</span>
        </div>

        <div class="detailsRow">
            <span class="detailsLabel">Telefone:</span>
            <span class="detailsValue">{{ $student->phone ?? '-' }}</span>
        </div>

        <div class="detailsRow">
            <span class="detailsLabel">Endereço:</span>
            <span class="detailsValue">{{ $student->address ?? '-' }}</span>
        </div>

        <div class="actions">
            <a href="{{ route('students.edit', $student->id) }}" class="btnWarning">Editar</a>
            <a href="{{ route('students.index') }}" class="btnSecondary">Voltar à Lista</a>
        </div>
    @endif
</div>
