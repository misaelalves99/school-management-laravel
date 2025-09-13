<!-- resources/views/enrollments/create.blade.php -->

@extends('layouts.app')

@section('title', 'Nova Matrícula')

@push('styles')
    @vite(['resources/css/enrollments/create.css'])
@endpush

@section('content')
<div class="createContainer">
    <h1 class="createTitle">Nova Matrícula</h1>

    <form action="{{ route('enrollments.store') }}" method="POST" class="createForm">
        @csrf

        <!-- Aluno -->
        <div class="formGroup">
            <label for="studentId" class="formLabel">Aluno</label>
            <select name="student_id" id="studentId" class="formInput @error('student_id') formError @enderror">
                <option value="">Selecione o Aluno</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                        {{ $student->name }}
                    </option>
                @endforeach
            </select>
            @error('student_id')
                <span class="formError">{{ $message }}</span>
            @enderror
        </div>

        <!-- Turma -->
        <div class="formGroup">
            <label for="classRoomId" class="formLabel">Turma</label>
            <select name="class_room_id" id="classRoomId" class="formInput @error('class_room_id') formError @enderror">
                <option value="">Selecione a Turma</option>
                @foreach($classRooms as $classRoom)
                    <option value="{{ $classRoom->id }}" {{ old('class_room_id') == $classRoom->id ? 'selected' : '' }}>
                        {{ $classRoom->name }}
                    </option>
                @endforeach
            </select>
            @error('class_room_id')
                <span class="formError">{{ $message }}</span>
            @enderror
        </div>

        <!-- Data da matrícula -->
        <div class="formGroup">
            <label for="enrollmentDate" class="formLabel">Data da Matrícula</label>
            <input type="date" name="enrollment_date" id="enrollmentDate" class="formInput @error('enrollment_date') formError @enderror" value="{{ old('enrollment_date', date('Y-m-d')) }}">
            @error('enrollment_date')
                <span class="formError">{{ $message }}</span>
            @enderror
        </div>

        <!-- Status -->
        <div class="formGroup">
            <label for="status" class="formLabel">Status</label>
            <select name="status" id="status" class="formInput @error('status') formError @enderror">
                <option value="ativo" {{ old('status') == 'ativo' ? 'selected' : '' }}>Ativo</option>
                <option value="inativo" {{ old('status') == 'inativo' ? 'selected' : '' }}>Inativo</option>
            </select>
            @error('status')
                <span class="formError">{{ $message }}</span>
            @enderror
        </div>

        <div class="formActions">
            <button type="submit" class="btnPrimary">Salvar</button>
            <a href="{{ route('enrollments.index') }}" class="btnSecondary">Voltar</a>
        </div>
    </form>
</div>
@endsection
