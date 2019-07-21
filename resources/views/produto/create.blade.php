<!-- invoca o arquivo /resources/views/layout/app.blade.php -->
@extends('layout.app')
<!-- usa a seção title de /resources/views/layout/app.blade.php -->
@section('title', 'Adicionar um produto')
<!-- usa a seção content de /resources/views/layout/app.blade.php -->
@section('content')

    <h1>Criar um novo produto</h1>
    <!-- Este Formulario enviará os dados para o controller ProdutosContoller e para o método store deste controller -->
    {{Form::open(['action' => 'ProdutosContoller@store'])}}

    {{Form::label('referencia', 'Referência')}}
    {{Form::text('referencia', '', ['class' => 'form-control', 'required',
        'placeholder' => 'Referência'])}}

    {{Form::label('titulo', 'Título')}}
    {{Form::text('titulo', '', ['class' => 'form-control', 'required',
        'placeholder' => 'Título'])}}        

    {{Form::label('descricao', 'Descrição')}}
    {{Form::textarea('descricao', '', ['rows' => 3, 'class' => 'form-control', 'required',
        'placeholder' => 'Descrição'])}}        

    {{Form::label('preco', 'Preço')}}
    {{Form::text('preco', '', ['class' => 'form-control', 'required',
        'placeholder' => 'Preço'])}}   

    <br/>
    {{Form::submit('Cadastrar!', ['class' => 'btn btn-default'])}}

    {{Form::close()}}

@endsection