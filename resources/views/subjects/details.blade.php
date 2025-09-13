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
        <a href="{{ route('subjects.index') }}" class="btn btnSecondary">Voltar à Lista</a>
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
            <span class="detailsValue">{{ $subject->workload_hours }} horas</span>
        </div>

        <div class="actions">
            <a href="{{ route('subjects.edit', $subject->id) }}" class="btn btnWarning">Editar</a>
            <a href="{{ route('subjects.index') }}" class="btn btnSecondary">Voltar à Lista</a>
        </div>
    @endif
</div>
@endsection
