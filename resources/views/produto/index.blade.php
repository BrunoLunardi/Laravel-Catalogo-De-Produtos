<!-- invoca o arquivo /resources/views/layout/app.blade.php -->
@extends('layout.app')
<!-- usa a seção title de /resources/views/layout/app.blade.php -->
@section('title', 'Listagem de produtos')
<!-- usa a seção content de /resources/views/layout/app.blade.php -->
@section('content')

    <h1>Produtos</h1>
    <ul>
        <!-- Lista todos os produtos cadastrados no BD -->
        <!-- Cria um link para acessar um produto, através do id fornecido -->
        @foreach ($produtos as $produto)
        <li>
            <a href="http://127.0.0.1:8000/produtos/{{$produto->id}}"
            >{{ $produto->titulo}}</a>
        </li>
        @endforeach
    </ul>

@endsection
<!-- fecha conteúdo de @section('content') -->