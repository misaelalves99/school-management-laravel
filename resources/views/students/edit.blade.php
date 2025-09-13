<!-- resources/views/students/edit.blade.php -->

@extends('layouts.app')

@section('title', 'Editar Aluno')

@push('styles')
    @vite(['resources/css/students/edit.css'])
@endpush

@section('content')
<div class="createContainer">
    <h1 class="createTitle">Editar Aluno</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('students.update', $student->id) }}" method="POST" class="createForm">
        @csrf
        @method('PUT')

        @php
        $fields = [
            ['key' => 'name', 'label' => 'Nome', 'placeholder' => 'Digite o nome do aluno', 'type' => 'text'],
            ['key' => 'email', 'label' => 'Email', 'placeholder' => 'Digite o email', 'type' => 'email'],
            ['key' => 'date_of_birth', 'label' => 'Data de Nascimento', 'placeholder' => '', 'type' => 'date'],
            ['key' => 'enrollment_number', 'label' => 'Matrícula', 'placeholder' => 'Número de matrícula', 'type' => 'text'],
            ['key' => 'phone', 'label' => 'Telefone', 'placeholder' => 'Digite o telefone', 'type' => 'tel'],
            ['key' => 'address', 'label' => 'Endereço', 'placeholder' => 'Digite o endereço', 'type' => 'text'],
        ];
        @endphp

        @foreach($fields as $field)
            <div class="formGroup">
                <label for="{{ $field['key'] }}" class="formLabel">{{ $field['label'] }}</label>
                <input
                    id="{{ $field['key'] }}"
                    name="{{ $field['key'] }}"
                    type="{{ $field['type'] }}"
                    value="{{ old($field['key'], $student->{$field['key']}) }}"
                    placeholder="{{ $field['placeholder'] }}"
                    class="formInput @error($field['key']) formError @enderror"
                >
                @error($field['key'])
                    <span class="formError">{{ $message }}</span>
                @enderror
            </div>
        @endforeach

        <div class="formActions">
            <button type="submit" class="btnPrimary">Salvar Alterações</button>
            <a href="{{ route('students.index') }}" class="btnSecondary">Voltar</a>
        </div>
    </form>
</div>
@endsection
