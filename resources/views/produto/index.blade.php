<!-- invoca o arquivo /resources/views/layout/app.blade.php -->
@extends('layout.app')
<!-- usa a seção title de /resources/views/layout/app.blade.php -->
@section('title', 'Listagem de produtos')
<!-- usa a seção content de /resources/views/layout/app.blade.php -->
@section('content')

    <h1>Produtos</h1>

    <!-- Formulário para pesquisar produtos -->
    <!-- Acessa a rota criada em web.php - Route::post('produtos/buscar', 'ProdutosController@buscar') -->
        <!-- Por isso foi passado uma url no open() -->
    {{Form::open(['url'=>['produtos/buscar']])}}
        <div class="row">
            <div class="col-lg-12">
                <div class="input-group">
                    {{Form::text('busca', $busca, ['class'=>'form-control', 'required',
                        'placeholder'=>'Buscar'])}}
                    <span class="input-group-btn">
                        {{Form::submit('Buscar', ['class'=>'btn btn-default'])}}
                    </span>
                </div>
            </div>
        </div>
    {{Form::close()}}

    <!-- Verifica se o controller ProdutosController enviou uma mensagem, via Session -->
    @if(Session::has('mensagem'))
        <div class="alert alert-success">{{Session::get('mensagem')}}</div>
    @endif
    <div class="row">
        <!-- Lista todos os produtos cadastrados no BD -->
        <!-- Cria um link para acessar um produto, através do id fornecido -->
        @foreach ($produtos as $produto)
        <div class="col-md-3">
            <h4>{{$produto->titulo}}</h4>
            @if(file_exists("./img/produtos/" . md5($produto->id) . ".jpg"))
                <!-- função url adiciona o domínio ao link -->
                <a class='thumbnail' href="{{url('produtos/'.$produto->id)}}">
                    <!-- asset ajusta o caminho adicionando domínio e corrigindo níveis de nevagação se necessário --> 
                    {{Html::image(asset("img/produtos/" . md5($produto->id) . 
                        ".jpg"))}}
                </a>
            @else
                <!-- função url adiciona o domínio ao link -->
                <a class='thumbnail' href="{{url('produtos/'.$produto->id) }}">
                    {{$produto->titulo}}
                </a>
            @endif
            
            <!-- Formulário com method DELETE -->
            <!-- Rota para deletar produto -->
            {{Form::open(['route'=>['produtos.destroy', $produto->id],
                'method'=>'DELETE'])}}
                <!-- função url adiciona o domínio ao link -->
                <a class='btn btn-default'
                    href="{{url('produtos/'.$produto->id.'/edit')}}">Editar</a>
                {{Form::submit('Excluir', ['class'=>'btn btn-default'])}}
            {{Form::close()}}
        </div>
        @endforeach
    </div>

<!-- Navegação dos produtos (paginate()) -->
{{$produtos->links()}}

@endsection
<!-- fecha conteúdo de @section('content') -->