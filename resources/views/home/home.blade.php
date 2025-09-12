<!-- resources/views/home/home.blade.php -->

@extends('layouts.app')

@section('title', 'Home')

@push('styles')
    @vite(['resources/css/home/home.css'])
@endpush

@section('content')
<div class="container">
    <h1 class="title">Bem-vindo ao Sistema de Gestão Escolar</h1>
    <p class="lead">
        Gerencie facilmente alunos, professores, disciplinas, matrículas,
        presenças e notas em um único lugar.
    </p>

    <ul class="features">
        <li class="featureCard">
            <a href="{{ route('students.index') }}" class="cardLink">Gerenciar Alunos</a>
        </li>
        <li class="featureCard">
            <a href="{{ route('teachers.index') }}" class="cardLink">Gerenciar Professores</a>
        </li>
        <li class="featureCard">
            <a href="{{ route('subjects.index') }}" class="cardLink">Gerenciar Disciplinas</a>
        </li>
        <li class="featureCard">
            <a href="{{ route('classrooms.index') }}" class="cardLink">Gerenciar Salas</a>
        </li>
        <li class="featureCard">
            <a href="{{ route('enrollments.index') }}" class="cardLink">Gerenciar Matrículas</a>
        </li>
    </ul>
</div>
@endsection
