<!-- invoca o arquivo /resources/views/layout/app.blade.php -->
@extends('layout.app')
<!-- usa a seção title de /resources/views/layout/app.blade.php -->
@section('title', 'Alterar o produto:'. $produto->titulo)
<!-- usa a seção content de /resources/views/layout/app.blade.php -->
@section('content')

    <h1>Alterar o produto: {{$produto->titulo}}</h1>

    <!-- Verifica se houve erros de dados no formulário -->
    <!-- Verificação realizada no ProdutosController->store()->validate -->
    <!-- Pode trocar o nome do campo exibido em resources/lang/pt-br/validation.php atributes[] -->
    <!-- É possível adicionar mensagens de erro customizada em resources/lang/pt-br/validation.php custom[] -->
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <!-- Recebe mensagem de Session da Controller ProdutoController@update -->
    @if(Session::has('mensagem'))
        <div class="alert alert-success">
            {{Session::get('mensagem')}}
        </div>
    @endif
    
    <!-- Esta linha é o mesmo que form method = PUT, pois é edição de dados -->
    <!-- O Form::open aponta para uma rota, e não para um método dde ProdutosController -->
    <!-- Update requer um identificador no parâmetro (id) -->
    {{Form::open(['route'=>['produtos.update', $produto->id], 'method'=>'PUT'])}}

    {{Form::label('referencia', 'Referência', ['class'=>'prettyLabels'])}}
    {{Form::text('referencia', $produto->referencia, ['class' => 'form-control', 
        'required', 'placeholder' => 'Referência'])}}

    {{Form::label('titulo', 'Título')}}
    {{Form::text('titulo', $produto->titulo, ['class' => 'form-control', 
        'required', 'placeholder' => 'Título'])}}        

    {{Form::label('descricao', 'Descrição')}}
    {{Form::textarea('descricao', $produto->descricao, ['rows' => 3, 
        'class' => 'form-control', 'required', 'placeholder' => 'Descrição'])}}        

    {{Form::label('preco', 'Preço')}}
    {{Form::text('preco', $produto->preco, ['class' => 'form-control', 
        'required', 'placeholder' => 'Preço'])}}   

    <br/>
    {{Form::submit('Alterar!', ['class' => 'btn btn-default'])}}

    {{Form::close()}}

@endsection