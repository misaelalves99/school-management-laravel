<!-- resources/views/teachers/index.blade.php -->

@extends('layouts.app')

@section('title', 'Lista de Professores')

@push('styles')
    @vite(['resources/css/teachers/index.css'])
@endpush

@section('content')
<div class="pageContainer">
    {{-- Painel de Busca / Ações --}}
    <aside class="leftPanel">
        <h2 class="title">Buscar Professores</h2>
        <form action="{{ route('teachers.index') }}" method="GET" class="searchForm">
            <input
                type="text"
                name="search"
                placeholder="Digite o nome ou disciplina..."
                value="{{ request('search') }}"
                class="input"
            >
            <button type="submit" class="btn btnPrimary">Buscar</button>
        </form>
        <a href="{{ route('teachers.create') }}" class="btn btnSuccess">Cadastrar Novo Professor</a>
    </aside>

    {{-- Lista de Professores --}}
    <main class="rightPanel">
        <h2 class="title">Lista de Professores</h2>
        <div class="tableWrapper">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Disciplina</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($teachers as $teacher)
                        <tr>
                            <td>{{ $teacher->id }}</td>
                            <td>{{ $teacher->name }}</td>
                            <td>{{ $teacher->subject }}</td>
                            <td class="actionsCell">
                                <a href="{{ route('teachers.show', $teacher->id) }}" class="btn btnInfo">Detalhes</a>
                                <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn btnWarning">Editar</a>
                                <a href="{{ route('teachers.delete', $teacher->id) }}" class="btn btnDanger">Excluir</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="noResults">Nenhum professor encontrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Paginação (opcional) --}}
        <div class="pagination">
            {{ $teachers->withQueryString()->links() }}
        </div>
    </main>
</div>
