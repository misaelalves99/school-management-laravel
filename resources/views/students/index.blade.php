<!-- resources/views/students/index.blade.php -->

@extends('layouts.app')

@section('title', 'Lista de Alunos')

@push('styles')
    @vite(['resources/css/students/index.css'])
@endpush

@section('content')
<div class="pageContainer">
    <aside class="leftPanel">
        <h2 class="title">Buscar Alunos</h2>
        <form method="GET" class="searchForm">
            <input
                type="text"
                name="search"
                placeholder="Digite o nome do aluno..."
                value="{{ request('search') }}"
                class="input"
                aria-label="Buscar aluno"
            >
            <button type="submit" class="btn btnPrimary">Buscar</button>
        </form>
        <a href="{{ route('students.create') }}" class="btn btnSuccess">Cadastrar Novo Aluno</a>
    </aside>

    <main class="rightPanel">
        <h2 class="title">Lista de Alunos</h2>

        @if($students->count() > 0)
        <div class="tableWrapper">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Matrícula</th>
                        <th>Telefone</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->enrollment_number ?? '-' }}</td>
                        <td>{{ $student->phone ?? '-' }}</td>
                        <td class="actionsCell">
                            <a href="{{ route('students.show', $student->id) }}" class="btn btnInfo">Detalhes</a>
                            <a href="{{ route('students.edit', $student->id) }}" class="btn btnWarning">Editar</a>
                            <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btnDanger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="pagination">
            {{ $students->links() }}
        </div>

        @else
        <p class="noResults">Nenhum aluno encontrado.</p>
        @endif
    </main>
</div>
@endsection
