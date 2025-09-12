<!-- resources/views/teachers/edit.blade.php -->

@extends('layouts.app')

@section('title', 'Editar Professor')

@push('styles')
    @vite(['resources/css/teachers/edit.css'])
@endpush

@section('content')
<div class="createContainer">
    <h1 class="createTitle">Editar Professor</h1>

    <form action="{{ route('teachers.update', $teacher->id) }}" method="POST" class="createForm">
        @csrf
        @method('PUT')

        @php
            $fields = [
                ['label' => 'Nome', 'name' => 'name', 'type' => 'text'],
                ['label' => 'Email', 'name' => 'email', 'type' => 'email'],
                ['label' => 'Data de Nascimento', 'name' => 'date_of_birth', 'type' => 'date'],
                ['label' => 'Telefone', 'name' => 'phone', 'type' => 'tel'],
                ['label' => 'Endereço', 'name' => 'address', 'type' => 'text'],
            ];
        @endphp

        @foreach ($fields as $field)
            <div class="formGroup">
                <label for="{{ $field['name'] }}" class="formLabel">{{ $field['label'] }}</label>
                <input
                    type="{{ $field['type'] }}"
                    name="{{ $field['name'] }}"
                    id="{{ $field['name'] }}"
                    value="{{ old($field['name'], $teacher->{$field['name']}) }}"
                    class="formInput @error($field['name']) formError @enderror"
                >
                @error($field['name'])
                    <span class="formError">{{ $message }}</span>
                @enderror
            </div>
        @endforeach

        <div class="formGroup">
            <label for="subject" class="formLabel">Disciplina</label>
            <select name="subject" id="subject" class="formInput @error('subject') formError @enderror">
                <option value="">Selecione uma disciplina</option>
                @foreach($subjects as $subj)
                    <option value="{{ $subj->name }}" @selected(old('subject', $teacher->subject) == $subj->name)>{{ $subj->name }}</option>
                @endforeach
            </select>
            @error('subject')
                <span class="formError">{{ $message }}</span>
            @enderror
        </div>

        <div class="formActions">
            <button type="submit" class="btnPrimary">Salvar Alterações</button>
            <a href="{{ route('teachers.index') }}" class="btnSecondary">Voltar</a>
        </div>
    </form>
</div>
