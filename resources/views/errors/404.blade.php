@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Errore 404</h1>

        <h4>{{ $exception->getMessage() }}</h4>   
    </div>
@endsection

@section('title')
    404
@endsection