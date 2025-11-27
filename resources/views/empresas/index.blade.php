@extends('layouts.app')

@section('content')
<h1>Empresas</h1>
<ul>
@foreach ($empresas as $empresa)
    <li>{{ $empresa->name }} - {{ $empresa->email }}</li>
@endforeach
</ul>
@endsection
