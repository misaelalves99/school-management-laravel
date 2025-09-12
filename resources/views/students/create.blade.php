<!-- resources/views/students/create.blade.php -->

@extends('layouts.app')

@section('title', 'Cadastrar Aluno')

@push('styles')
    @vite(['resources/css/students/create.css'])
@endpush

@section('content')
<div class="createContainer">
    <h1 class="createTitle">Cadastrar Novo Aluno</h1>

    <form action="{{ route('students.store') }}" method="POST" class="createForm">
        @csrf

        @php
            $fields = [
                'name' => 'Nome',
                'email' => 'Email',
                'dateOfBirth' => 'Data de Nascimento',
                'enrollmentNumber' => 'Matrícula',
                'phone' => 'Telefone',
                'address' => 'Endereço',
            ];
        @endphp

        @foreach($fields as $field => $label)
            <div class="formGroup">
                <label for="{{ $field }}" class="formLabel">{{ $label }}:</label>
                <input
                    type="{{ $field === 'dateOfBirth' ? 'date' : 'text' }}"
                    name="{{ $field }}"
                    id="{{ $field }}"
                    value="{{ old($field) }}"
                    class="formInput @error($field) border-red-600 @enderror"
                >
                @error($field)
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
