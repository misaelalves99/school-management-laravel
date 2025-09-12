<!-- resources/views/subjects/create.blade.php -->

@extends('layouts.app')

@section('title', 'Cadastrar Disciplina')

@push('styles')
    @vite(['resources/css/subjects/create.css'])
@endpush

@section('content')
<div class="createContainer">
    <h1 class="createTitle">Cadastrar Nova Disciplina</h1>

    <form action="{{ route('subjects.store') }}" method="POST" class="createForm">
        @csrf

        <div class="formGroup">
            <label for="name" class="formLabel">Nome da Disciplina</label>
            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
                class="formInput"
            />
            @error('name')
                <span class="formError">{{ $message }}</span>
            @enderror
        </div>

        <div class="formGroup">
            <label for="description" class="formLabel">Descrição</label>
            <textarea
                id="description"
                name="description"
                class="formInput"
                rows="3"
            >{{ old('description') }}</textarea>
        </div>

        <div class="formGroup">
            <label for="workloadHours" class="formLabel">Carga Horária</label>
            <input
                type="number"
                id="workloadHours"
                name="workloadHours"
                value="{{ old('workloadHours', 0) }}"
                class="formInput"
            />
        </div>

        <div class="formActions">
            <button type="submit" class="btnPrimary">Salvar</button>
            <a href="{{ route('subjects.index') }}" class="btnSecondary">Voltar</a>
        </div>
    </form>
</div>
@endsection
