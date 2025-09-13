<!-- resources/views/students/create.blade.php -->

@extends('layouts.app')

@section('title', 'Cadastrar Aluno')

@push('styles')
    @vite(['resources/css/students/create.css'])
@endpush

@section('content')
<div class="createContainer">
    <h1 class="createTitle">Cadastrar Novo Aluno</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('students.store') }}" method="POST" class="createForm">
        @csrf

        @php
            $fields = [
                ['label' => 'Nome', 'name' => 'name', 'type' => 'text'],
                ['label' => 'Email', 'name' => 'email', 'type' => 'email'],
                ['label' => 'Data de Nascimento', 'name' => 'date_of_birth', 'type' => 'date'],
                ['label' => 'Matrícula', 'name' => 'enrollment_number', 'type' => 'text'],
                ['label' => 'Telefone', 'name' => 'phone', 'type' => 'text'],
                ['label' => 'Endereço', 'name' => 'address', 'type' => 'text'],
            ];
        @endphp

        @foreach($fields as $field)
            <div class="formGroup">
                <label for="{{ $field['name'] }}" class="formLabel">{{ $field['label'] }}:</label>
                <input
                    type="{{ $field['type'] }}"
                    name="{{ $field['name'] }}"
                    id="{{ $field['name'] }}"
                    value="{{ old($field['name']) }}"
                    class="formInput @error($field['name']) formError @enderror"
                >
                @error($field['name'])
                    <span class="formError">{{ $message }}</span>
                @enderror
            </div>
        @endforeach

        <div class="formActions">
            <button type="submit" class="btnPrimary">Salvar</button>
            <a href="{{ route('students.index') }}" class="btnSecondary">Voltar</a>
        </div>
    </form>
</div>
@endsection
