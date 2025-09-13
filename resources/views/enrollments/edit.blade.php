<!-- resources/views/enrollments/edit.blade.php -->

@extends('layouts.app')

@section('title', 'Editar Matrícula')

@push('styles')
    @vite(['resources/css/enrollments/edit.css'])
@endpush

@section('content')
<div class="createContainer">
    <h1 class="createTitle">Editar Matrícula</h1>

    <form action="{{ route('enrollments.update', $enrollment->id) }}" method="POST" class="createForm">
        @csrf
        @method('PUT')

        {{-- Aluno --}}
        <div class="formGroup">
            <label for="studentId" class="formLabel">Aluno:</label>
            <select id="studentId" name="student_id" class="formInput @error('student_id') formError @enderror">
                <option value="">Selecione o Aluno</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}" {{ old('student_id', $enrollment->student_id) == $student->id ? 'selected' : '' }}>
                        {{ $student->name }}
                    </option>
                @endforeach
            </select>
            @error('student_id')
                <span class="formError">{{ $message }}</span>
            @enderror
        </div>

        {{-- Turma --}}
        <div class="formGroup">
            <label for="classRoomId" class="formLabel">Turma:</label>
            <select id="classRoomId" name="class_room_id" class="formInput @error('class_room_id') formError @enderror">
                <option value="">Selecione a Turma</option>
                @foreach($classRooms as $classRoom)
                    <option value="{{ $classRoom->id }}" {{ old('class_room_id', $enrollment->class_room_id) == $classRoom->id ? 'selected' : '' }}>
                        {{ $classRoom->name }}
                    </option>
                @endforeach
            </select>
            @error('class_room_id')
                <span class="formError">{{ $message }}</span>
            @enderror
        </div>

        {{-- Data da matrícula --}}
        <div class="formGroup">
            <label for="enrollmentDate" class="formLabel">Data da Matrícula:</label>
            <input type="date" id="enrollmentDate" name="enrollment_date" class="formInput @error('enrollment_date') formError @enderror" value="{{ old('enrollment_date', $enrollment->enrollment_date->format('Y-m-d')) }}">
            @error('enrollment_date')
                <span class="formError">{{ $message }}</span>
            @enderror
        </div>

        {{-- Status --}}
        <div class="formGroup">
            <label for="status" class="formLabel">Status:</label>
            <select id="status" name="status" class="formInput @error('status') formError @enderror">
                <option value="ativo" {{ old('status', $enrollment->status) == 'ativo' ? 'selected' : '' }}>Ativo</option>
                <option value="inativo" {{ old('status', $enrollment->status) == 'inativo' ? 'selected' : '' }}>Inativo</option>
            </select>
            @error('status')
                <span class="formError">{{ $message }}</span>
            @enderror
        </div>

        <div class="formActions">
            <button type="submit" class="btnPrimary">Salvar Alterações</button>
            <a href="{{ route('enrollments.index') }}" class="btnSecondary">Voltar</a>
        </div>
    </form>
</div>
@endsection
