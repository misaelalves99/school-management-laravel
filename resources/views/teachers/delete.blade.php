<!-- resources/views/teachers/delete.blade.php -->

@extends('layouts.app')

@section('title', 'Excluir Professor')

@push('styles')
    @vite(['resources/css/teachers/delete.css'])
@endpush

@section('content')
<div class="container">
    <h1 class="title">Excluir Professor</h1>
    <h3 class="warning">
        Tem certeza que deseja excluir <strong>{{ $teacher->name }}</strong>?
    </h3>

    <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" class="form">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btnDanger">Excluir</button>
        <a href="{{ route('teachers.index') }}" class="btn btnSecondary">Cancelar</a>
    </form>
</div>
@endsection
