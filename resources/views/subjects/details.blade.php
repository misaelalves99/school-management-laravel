<!-- resources/views/subjects/details.blade.php -->

@extends('layouts.app')

@section('title', 'Detalhes da Disciplina')

@push('styles')
    @vite(['resources/css/subjects/details.css'])
@endpush

@section('content')
<div class="container">
    @if (!$subject)
        <h2 class="title">Disciplina não encontrada</h2>
        <a href="{{ route('subjects.index') }}" class="btnSecondary btn">Voltar</a>
    @else
        <h1 class="title">Detalhes da Disciplina</h1>

        <div class="detailsRow">
            <span class="detailsLabel">Nome:</span>
            <span class="detailsValue">{{ $subject->name }}</span>
        </div>

        <div class="detailsRow">
            <span class="detailsLabel">Descrição:</span>
            <span class="detailsValue">{{ $subject->description ?? '-' }}</span>
        </div>

        <div class="detailsRow">
            <span class="detailsLabel">Carga Horária:</span>
            <span class="detailsValue">{{ $subject->workloadHours }} horas</span>
        </div>

        <div class="actions">
            <a href="{{ route('subjects.edit', $subject->id) }}" class="btnWarning btn">Editar</a>
            <a href="{{ route('subjects.index') }}" class="btnSecondary btn">Voltar à Lista</a>
        </div>
    @endif
</div>
@endsection
