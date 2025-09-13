<!-- resources/views/classrooms/index.blade.php -->

@extends('layouts.app')

@section('title', 'Lista de Salas')

@push('styles')
    @vite(['resources/css/classrooms/index.css'])
@endpush

@section('content')
<div class="pageContainer">

  <!-- Painel esquerdo: busca e criação -->
  <aside class="leftPanel">
    <h2 class="title">Buscar Salas</h2>
    <form method="GET" action="{{ route('classrooms.index') }}" class="searchForm">
      <input
        type="text"
        name="search"
        value="{{ request('search') }}"
        placeholder="Digite nome, horário ou capacidade..."
        class="input"
      />
      <button type="submit" class="btn btnPrimary">Buscar</button>
    </form>

    <a href="{{ route('classrooms.create') }}" class="btn btnSuccess">Cadastrar Nova Sala</a>
  </aside>

  <!-- Painel direito: lista -->
  <main class="rightPanel">
    <h2 class="title">Lista de Salas</h2>

    <div class="tableWrapper">
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Capacidade</th>
            <th>Horário</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          @forelse($classRooms as $room)
            @php
              $search = strtolower(request('search', ''));
              $matchesSearch = !$search || 
                               str_contains(strtolower($room->name), $search) || 
                               str_contains(strtolower($room->schedule), $search) || 
                               str_contains((string)$room->capacity, $search);
            @endphp

            @if(!$matchesSearch)
              @continue
            @endif

            <tr>
              <td>{{ $room->id }}</td>
              <td>{{ $room->name }}</td>
              <td>{{ $room->capacity }}</td>
              <td>{{ $room->schedule }}</td>
              <td class="actionsCell">
                  <a href="{{ route('classrooms.show', $room->id) }}" class="btn btnInfo">Detalhes</a>
                  <a href="{{ route('classrooms.edit', $room->id) }}" class="btn btnWarning">Editar</a>
                  <a href="{{ route('classrooms.delete', $room->id) }}" class="btn btnDanger">Excluir</a>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="noResults">Nenhuma sala encontrada.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

  </main>
</div>
@endsection
