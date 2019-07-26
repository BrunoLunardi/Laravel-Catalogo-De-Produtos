<!-- invoca o arquivo /resources/views/layout/app.blade.php -->
@extends('layout.app')
<!-- usa a seção title de /resources/views/layout/app.blade.php -->
<!-- Não precisa usa chaves dupla, pois $produto->titulo já está em uma marcação do blade -->
@section('title', $produto->titulo)
<!-- usa a seção content de /resources/views/layout/app.blade.php -->
@section('content')

<div class="container">

    <h1>Produto {{$produto->titulo}}</h1>

    <div class="row">

        <div class="col-md-6 col-md-3">

            <!-- Lista de produtos -->
            <ul>
                <li>Referência: {{$produto->referencia}}</li>
                <li>Preço: R${{ number_format($produto->preco,2,',','.')}}</li>
                <li>Adicionado em: {{ date("d/m/y", strtotime($produto->created_at))}}</li>
            </ul>
            <p>{{$produto->descricao}}</p>

        </div>

        <!-- Verifica se existe foto do produto no servidor (public/img/produtos/$nomearquivo) -->
        @if(file_exists("./img/produtos/" . md5($produto->id) . ".jpg"))
            <div class="col-md-6 col-md-3">
                <a href="{{asset("img/produtos/" . md5($produto->id) . ".jpg")}}" 
                    class="thumbnail">
                    <!-- asset ajusta o caminho adicionando domínio e corrigindo níveis de nevagação se necessário --> 
                    {{Html::image(asset("img/produtos/" . md5($produto->id) . ".jpg"))}}
                </a>            
            </div>
        @endif
</div>
    
<!-- JavaScript para voltar para a pagina de produtos -->
<a href="javascript:history.go(-1)">Voltar</a>

@endsection