<!-- resources/views/components/navbar.blade.php -->

@push('styles')
    @vite(['resources/css/components/navbar.css'])
@endpush

<nav class="navbar">
    <div class="navbar-container">
        {{-- Logo --}}
        <a href="{{ route('home') }}" class="logo-link">
            <span class="logo-text">Minha Escola</span>
        </a>

        {{-- Menu --}}
        <ul class="navbar-menu">
            <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Início</a></li>
            <li><a href="{{ route('students.index') }}" class="{{ request()->routeIs('students.*') ? 'active' : '' }}">Alunos</a></li>
            <li><a href="{{ route('teachers.index') }}" class="{{ request()->routeIs('teachers.*') ? 'active' : '' }}">Professores</a></li>
            <li><a href="{{ route('subjects.index') }}" class="{{ request()->routeIs('subjects.*') ? 'active' : '' }}">Disciplinas</a></li>
            <li><a href="{{ route('classrooms.index') }}" class="{{ request()->routeIs('classrooms.*') ? 'active' : '' }}">Salas</a></li>
            <li><a href="{{ route('enrollments.index') }}" class="{{ request()->routeIs('enrollments.*') ? 'active' : '' }}">Matrículas</a></li>
        </ul>
    </div>
</nav>

