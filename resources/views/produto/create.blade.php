<!-- invoca o arquivo /resources/views/layout/app.blade.php -->
@extends('layout.app')
<!-- usa a seção title de /resources/views/layout/app.blade.php -->
@section('title', 'Adicionar um produto')
<!-- usa a seção content de /resources/views/layout/app.blade.php -->
@section('content')

    <h1>Criar um novo produto</h1>

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

    <!-- Este Formulario enviará os dados para o controller ProdutosContoller e para o método store deste controller -->
    <!-- Esta linha é o mesmo que form method = POST -->
    {{Form::open(['action' => 'ProdutosController@store'])}}

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