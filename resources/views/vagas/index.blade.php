@extends('layouts.app')

@section('content')
<h1>Vagas</h1>
<ul>
@foreach ($vagas as $vaga)
    <li>{{ $vaga->titulo }} - {{ $vaga->descricao }}</li>
@endforeach
</ul>
@endsection
