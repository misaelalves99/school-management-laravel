<!-- resources/views/classrooms/create.blade.php -->

@extends('layouts.app')

@section('title', 'Cadastrar Sala')

@push('styles')
    @vite(['resources/css/classrooms/create.css'])
@endpush

@section('content')
<div class="createContainer">
    <h1 class="createTitle">Cadastrar Nova Sala</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('classrooms.store') }}" method="POST" class="createForm">
        @csrf

        <div class="formGroup">
            <label for="name" class="formLabel">Nome</label>
            <input
                id="name"
                name="name"
                type="text"
                value="{{ old('name') }}"
                class="formInput @error('name') is-invalid @enderror"
            />
            @error('name')
                <span class="formError">{{ $message }}</span>
            @enderror
        </div>

        <div class="formGroup">
            <label for="capacity" class="formLabel">Capacidade</label>
            <input
                id="capacity"
                name="capacity"
                type="number"
                min="1"
                max="100"
                value="{{ old('capacity', 1) }}"
                class="formInput @error('capacity') is-invalid @enderror"
            />
            @error('capacity')
                <span class="formError">{{ $message }}</span>
            @enderror
        </div>

        <div class="formGroup">
            <label for="schedule" class="formLabel">Horário</label>
            <input
                id="schedule"
                name="schedule"
                type="text"
                placeholder="Ex: Seg - 08:00 às 10:00"
                value="{{ old('schedule') }}"
                class="formInput @error('schedule') is-invalid @enderror"
            />
            @error('schedule')
                <span class="formError">{{ $message }}</span>
            @enderror
        </div>

        <div class="formActions">
            <button type="submit" class="btnPrimary">Salvar</button>
            <a href="{{ route('classrooms.index') }}" class="btnSecondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
