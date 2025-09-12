<!-- resources/views/subjects/edit.blade.php -->

@extends('layouts.app')

@section('title', 'Editar Disciplina')

@push('styles')
    @vite(['resources/css/subjects/edit.css'])
@endpush

@section('content')
<div class="createContainer">
    @if (!$subject)
        <h2 class="createTitle">Disciplina não encontrada</h2>
        <a href="{{ route('subjects.index') }}" class="btnSecondary btn">Voltar</a>
    @else
        <h1 class="createTitle">Editar Disciplina</h1>
        <form action="{{ route('subjects.update', $subject->id) }}" method="POST" class="createForm">
            @csrf
            @method('PUT')

            <div class="formGroup">
                <label for="name" class="formLabel">Nome da Disciplina:</label>
                <input type="text" id="name" name="name" value="{{ old('name', $subject->name) }}" class="formInput">
                @error('name')
                    <span class="formError">{{ $message }}</span>
                @enderror
            </div>

            <div class="formGroup">
                <label for="description" class="formLabel">Descrição:</label>
                <textarea id="description" name="description" rows="3" class="formInput">{{ old('description', $subject->description) }}</textarea>
            </div>

            <div class="formGroup">
                <label for="workloadHours" class="formLabel">Carga Horária:</label>
                <input type="number" id="workloadHours" name="workloadHours" value="{{ old('workloadHours', $subject->workloadHours) }}" class="formInput">
            </div>

            <div class="formActions">
                <button type="submit" class="btnPrimary btn">Salvar Alterações</button>
                <a href="{{ route('subjects.index') }}" class="btnSecondary btn">Voltar</a>
            </div>
        </form>
    @endif
</div>
@endsection
