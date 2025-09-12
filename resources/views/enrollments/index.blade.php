<!-- resources/views/enrollments/index.blade.php -->

@extends('layouts.app')

@section('title', 'Matrículas')

@push('styles')
    @vite(['resources/css/enrollments/index.css'])
@endpush

@section('content')
<div class="pageContainer">

    {{-- Painel esquerdo: Busca e cadastro --}}
    <aside class="leftPanel">
        <h2 class="title">Buscar Matrículas</h2>

        <form action="{{ route('enrollments.index') }}" method="GET" class="searchForm">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Buscar Matrícula ou Status..."
                class="input"
            />
            <button type="submit" class="btn btnPrimary">Buscar</button>
        </form>

        <a href="{{ route('enrollments.create') }}" class="btn btnSuccess mt-3">Cadastrar Nova Matrícula</a>
    </aside>

    {{-- Painel direito: Lista de matrículas --}}
    <main class="rightPanel">
        <h2 class="title">Lista de Matrículas</h2>

        <div class="tableWrapper">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Aluno</th>
                        <th>Turma</th>
                        <th>Status</th>
                        <th>Data da Matrícula</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($enrollments as $enrollment)
                        <tr>
                            <td>{{ $enrollment->id }}</td>
                            <td>{{ $enrollment->student->name ?? 'Aluno não informado' }}</td>
                            <td>{{ $enrollment->classRoom->name ?? 'Turma não informada' }}</td>
                            <td>{{ ucfirst($enrollment->status) }}</td>
                            <td>{{ \Carbon\Carbon::parse($enrollment->enrollment_date)->format('d/m/Y') }}</td>
                            <td class="actionsCell">
                                <a href="{{ route('enrollments.show', $enrollment->id) }}" class="btn btnInfo">Detalhes</a>
                                <a href="{{ route('enrollments.edit', $enrollment->id) }}" class="btn btnWarning">Editar</a>
                                <form action="{{ route('enrollments.destroy', $enrollment->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btnDanger"
                                        onclick="return confirm('Tem certeza que deseja excluir esta matrícula?')">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="noResults">Nenhuma matrícula encontrada.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Paginação --}}
            @if(method_exists($enrollments, 'links'))
                <div class="mt-4">
                    {{ $enrollments->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </main>

</div>
@endsection
