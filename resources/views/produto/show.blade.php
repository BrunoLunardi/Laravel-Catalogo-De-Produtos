<!-- invoca o arquivo /resources/views/layout/app.blade.php -->
@extends('layout.app')
<!-- usa a seção title de /resources/views/layout/app.blade.php -->
<!-- Não precisa usa chaves dupla, pois $produto->titulo já está em uma marcação do blade -->
@section('title', $produto->titulo)
<!-- usa a seção content de /resources/views/layout/app.blade.php -->
@section('content')
    <h1>Produto {{$produto->titulo}}</h1>
    <!-- Lista de produtos -->
    <ul>
        <li>Referência: {{$produto->referencia}}</li>
        <li>Preço: {{$produto->preco}}</li>
        <li>Adicionado em: {{$produto->created_at}}</li>
    </ul>
    <p>{{$produto->descricao}}</p>
    <!-- JavaScript para voltar para a pagina de produtos -->
    <a href="javascript:history.go(-1)">Voltar</a>

@endsection