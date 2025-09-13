<!-- resources/views/teachers/details.blade.php -->

@extends('layouts.app')

@section('title', 'Detalhes do Professor')

@push('styles')
    @vite(['resources/css/teachers/details.css'])
@endpush

@section('content')
<div class="container">
    @if(!$teacher)
        <h1 class="title">Professor não encontrado</h1>
        <a href="{{ route('teachers.index') }}" class="btn btnSecondary">Voltar à Lista</a>
    @else
        <h1 class="title">Detalhes do Professor</h1>

        @php
            $formattedDate = \Carbon\Carbon::parse($teacher->date_of_birth)->format('d/m/Y');
        @endphp

        <div class="detailsRow">
            <span class="detailsLabel">Nome:</span>
            <span class="detailsValue">{{ $teacher->name }}</span>
        </div>
        <div class="detailsRow">
            <span class="detailsLabel">Email:</span>
            <span class="detailsValue">{{ $teacher->email }}</span>
        </div>
        <div class="detailsRow">
            <span class="detailsLabel">Data de Nascimento:</span>
            <span class="detailsValue">{{ $formattedDate }}</span>
        </div>
        <div class="detailsRow">
            <span class="detailsLabel">Disciplina:</span>
            <span class="detailsValue">{{ $teacher->subject }}</span>
        </div>
        <div class="detailsRow">
            <span class="detailsLabel">Telefone:</span>
            <span class="detailsValue">{{ $teacher->phone ?? '-' }}</span>
        </div>
        <div class="detailsRow">
            <span class="detailsLabel">Endereço:</span>
            <span class="detailsValue">{{ $teacher->address ?? '-' }}</span>
        </div>

        <div class="actions">
            <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn btnWarning">Editar</a>
            <a href="{{ route('teachers.index') }}" class="btn btnSecondary">Voltar</a>
        </div>
    @endif
</div>
@endsection
