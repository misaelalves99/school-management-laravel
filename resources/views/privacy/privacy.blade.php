<!-- resources/views/privacy/privacy.blade.php -->

@extends('layouts.app')

@section('title', 'Privacy Policy')

@push('styles')
    @vite(['resources/css/privacy/privacy.css'])
@endpush

@section('content')
<link rel="stylesheet" href="{{ asset('css/privacy.css') }}">

<div class="container">
    <h1>Privacy Policy</h1>
    <p>Use this page to detail your site's privacy policy.</p>
</div>
@endsection
