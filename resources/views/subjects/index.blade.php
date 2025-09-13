<!-- resources/views/subjects/index.blade.php -->

@extends('layouts.app')

@section('title', 'Lista de Disciplinas')

@push('styles')
    @vite(['resources/css/subjects/index.css'])
@endpush

@section('content')
<div class="pageContainer">
    <div class="leftPanel">
        <h2 class="title">Buscar Disciplinas</h2>
        <form method="GET" action="{{ route('subjects.index') }}" class="searchForm">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Digite o nome ou descrição..."
                class="input"
            />
            <button type="submit" class="btn btnPrimary">Buscar</button>
        </form>

        <a href="{{ route('subjects.create') }}" class="btn btnSuccess">Cadastrar Nova Disciplina</a>
    </div>

    <div class="rightPanel">
        <h2 class="title">Lista de Disciplinas</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Carga Horária</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($subjects as $subject)
                    @if (empty(request('search')) || str_contains(strtolower($subject->name), strtolower(request('search'))) || str_contains(strtolower($subject->description), strtolower(request('search'))))
                    <tr>
                        <td>{{ $subject->id }}</td>
                        <td>{{ $subject->name }}</td>
                        <td>{{ $subject->description }}</td>
                        <td>{{ $subject->workload_hours }}</td>
                        <td class="actionsCell">
                            <a href="{{ route('subjects.show', $subject->id) }}" class="btn btnInfo">Detalhes</a>
                            <a href="{{ route('subjects.edit', $subject->id) }}" class="btn btnWarning">Editar</a>
                            <a href="{{ route('subjects.delete', $subject->id) }}" class="btn btnDanger">Excluir</a>
                        </td>
                    </tr>
                    @endif
                @empty
                    <tr>
                        <td colspan="5" style="text-align:center; padding:20px;">Nenhuma disciplina encontrada.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
