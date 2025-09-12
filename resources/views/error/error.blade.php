<!-- resources/views/error.blade.php -->

@extends('layouts.app')

@section('title', 'Erro')

@push('styles')
    @vite(['resources/css/error/error.css'])
@endpush

@section('content')
<div class="errorContainer">
    <h1 class="errorTitle">Ops! Algo deu errado.</h1>

    <p class="errorDescription">
        Desculpe, ocorreu um erro inesperado enquanto processávamos sua requisição.
    </p>

    @isset($error)
        <div class="errorDetails">
            <h3>Detalhes do Erro:</h3>
            <p><strong>Mensagem:</strong> {{ $error->message }}</p>
            <pre>{{ $error->stack }}</pre>
        </div>
    @endisset

    <a href="{{ route('home') }}" class="btnReturn">⬅ Voltar para o Início</a>
</div>
@endsection
