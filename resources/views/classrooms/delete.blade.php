<!-- resources/views/classrooms/delete.blade.php -->

@extends('layouts.app')

@section('title', 'Excluir Turma')

@push('styles')
    @vite(['resources/css/classrooms/delete.css'])
@endpush

@section('content')
<div class="container">
    <h1 class="title">Excluir Turma</h1>

    @if(!$classRoom)
        <p>Turma não encontrada.</p>
    @else
        <h3 class="warning">
            Tem certeza que deseja excluir <strong>{{ $classRoom->name }}</strong>?
        </h3>

        <div class="actions">
            <form action="{{ route('classrooms.destroy', $classRoom->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btnDanger">Excluir</button>
            </form>

            <a href="{{ route('classrooms.index') }}" class="btn btnSecondary">Cancelar</a>
        </div>
    @endif
</div>
@endsection
