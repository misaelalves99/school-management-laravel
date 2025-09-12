<!-- resources/views/teachers/create.blade.php -->

@extends('layouts.app')

@section('title', 'Cadastrar Professor')

@push('styles')
    @vite(['resources/css/teachers/create.css'])
@endpush

@section('content')
<div class="createContainer">
    <h1 class="createTitle">Cadastrar Novo Professor</h1>

    <form action="{{ route('teachers.store') }}" method="POST" class="createForm">
        @csrf

        @php
        $fields = [
            ['label' => 'Nome', 'name' => 'name', 'type' => 'text'],
            ['label' => 'Email', 'name' => 'email', 'type' => 'email'],
            ['label' => 'Data de Nascimento', 'name' => 'dateOfBirth', 'type' => 'date'],
            ['label' => 'Telefone', 'name' => 'phone', 'type' => 'tel'],
            ['label' => 'Endereço', 'name' => 'address', 'type' => 'text'],
        ];
        @endphp

        @foreach ($fields as $field)
        <div class="formGroup">
            <label for="{{ $field['name'] }}" class="formLabel">{{ $field['label'] }}</label>
            <input
                type="{{ $field['type'] }}"
                id="{{ $field['name'] }}"
                name="{{ $field['name'] }}"
                value="{{ old($field['name']) }}"
                class="formInput"
            />
            @error($field['name'])
            <span class="formError">{{ $message }}</span>
            @enderror
        </div>
        @endforeach

        <div class="formGroup">
            <label for="subject" class="formLabel">Disciplina</label>
            <select name="subject" id="subject" class="formInput">
                <option value="">Selecione uma disciplina</option>
                @foreach ($subjects as $subject)
                    <option value="{{ $subject->name }}" {{ old('subject') === $subject->name ? 'selected' : '' }}>
                        {{ $subject->name }}
                    </option>
                @endforeach
            </select>
            @error('subject')
            <span class="formError">{{ $message }}</span>
            @enderror
        </div>

        <div class="formActions">
            <button type="submit" class="btnPrimary">Salvar</button>
            <a href="{{ route('teachers.index') }}" class="btnSecondary">Voltar</a>
        </div>
    </form>
</div>
@endsection
