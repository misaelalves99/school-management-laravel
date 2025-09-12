<!-- resources/views/enrollments/delete.blade.php -->

@extends('layouts.app')

@section('title', 'Excluir Matrícula')

@push('styles')
    @vite(['resources/css/enrollments/delete.css'])
@endpush

@section('content')
<div class="pageContainer">
    <h1 class="title">Excluir Matrícula</h1>
    <h3 class="warning">
        Tem certeza que deseja excluir <strong>{{ $enrollment->student->name }}</strong>?
    </h3>

    <form action="{{ route('enrollments.destroy', $enrollment->id) }}" method="POST" class="form">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btnDanger">Excluir</button>
        <a href="{{ route('enrollments.index') }}" class="btn btnSecondary">Cancelar</a>
    </form>
</div>
@endsection
