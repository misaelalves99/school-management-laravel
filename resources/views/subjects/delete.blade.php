<!-- resources/views/subjects/delete.blade.php -->

@extends('layouts.app')

@section('title', 'Excluir Disciplina')

@push('styles')
    @vite(['resources/css/subjects/delete.css'])
@endpush

@section('content')
<div class="container">
    @if (!$subject)
        <h2>Disciplina não encontrada.</h2>
        <a href="{{ route('subjects.index') }}" class="btnSecondary btn">Voltar</a>
    @else
        <h1 class="title">Excluir Disciplina</h1>
        <h3 class="warning">
            Tem certeza que deseja excluir <strong>{{ $subject->name }}</strong>?
        </h3>

        <div class="actions">
            <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btnDanger btn">Excluir</button>
            </form>

            <a href="{{ route('subjects.index') }}" class="btnSecondary btn">Cancelar</a>
        </div>
    @endif
</div>
@endsection
