<!-- resources/views/classrooms/edit.blade.php -->

@extends('layouts.app')

@section('title', 'Editar Sala')

@push('styles')
    @vite(['resources/css/classrooms/edit.css'])
@endpush

@section('content')
<div class="createContainer">
    @if(!$classRoom)
        <p>Turma não encontrada.</p>
    @else
        <h1 class="createTitle">Editar Sala</h1>

        <form action="{{ route('classrooms.update', $classRoom->id) }}" method="POST" class="createForm">
            @csrf
            @method('PUT')

            <div class="formGroup">
                <label for="name" class="formLabel">Nome</label>
                <input
                    id="name"
                    name="name"
                    type="text"
                    value="{{ old('name', $classRoom->name) }}"
                    class="formInput @error('name') border-red-500 @enderror"
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
                    value="{{ old('capacity', $classRoom->capacity) }}"
                    class="formInput @error('capacity') border-red-500 @enderror"
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
                    value="{{ old('schedule', $classRoom->schedule) }}"
                    class="formInput @error('schedule') border-red-500 @enderror"
                />
                @error('schedule')
                    <span class="formError">{{ $message }}</span>
                @enderror
            </div>

            <div class="formActions">
                <button type="submit" class="btnPrimary">Salvar Alterações</button>
                <a href="{{ route('classrooms.index') }}" class="btnSecondary">Cancelar</a>
            </div>
        </form>
    @endif
</div>
@endsection
