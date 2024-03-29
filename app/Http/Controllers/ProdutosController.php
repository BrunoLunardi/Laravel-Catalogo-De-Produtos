<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
//import do model Produto
use App\Produto;
//import para usar sessão (para mensagens, por exemplo)
use Session;
//import para trabalhar com a autenticação de usuários
use Illuminate\Support\Facades\Auth;

class ProdutosController extends Controller
{

    //acessado por http://127.0.0.1:8000/produtos/
    public function index(){
        /*
        //retorna todos os produtos cadastrados no BD, através da model Produto
        $produtos = Produto::all();
        echo "<pre>";
        print_r($produtos);
        echo "</pre>";
        */
        //retorna todos os produtos cadastrados no BD, através da model Produto
        //$produtos = Produto::all();
        //realiza paginação dos produtos, apresenta 4 produtos por página
        $produtos = Produto::paginate(4);
        //retorna a view resources/views/produto/index.blade.php e passa o array de todos os produtos cadastrados no bd
        //'busca'=>null serve para inicializar a variavel busca da view resouces/views/produto/index.blade.php
            //senão dará erro na variável $busca no index.blade.php
        return view('produto.index', array('produtos' => $produtos, 'busca'=>null));
    }
    //se a url tiver id, então esta função é chamada
    //acessado por http://127.0.0.1:8000/produtos/{$id}
    public function show($id){
        //retorna um produto cadastrado no bd, pela id fornecida url
        $produto = Produto::find($id);

        //envia o produto localizado pela id para a view resources/views/produto/show.blade.php
        return view('produto.show', array('produto' => $produto));
/*
        echo "<pre>";
        print_r($produto);
        echo "</pre>";
*/        
    }

    //método para chamar o fomulário de criação de um novo produto
    //acessado por http://127.0.0.1:8000/produtos/create
    public function create(){
        //verifica se usuário está logado
        if(Auth::check()){
            //Carrega view de resources/views/produto/create.blade.php
            return view('produto.create');            
        }else{
            //se usuário não estiver logado, redireciona para a página de login
            return redirect('login');
        }

    }

    //método para salvar o produto cadastrado no banco de dados (enviado do form do resourcers/views/produto/create.blade.php)
    //Request é necessário para acessar dados do formulário
    public function store(Request $request){
        //verifica se usuário está logado
        if(Auth::check()){
            //validação de formulário utilizando o trait
                //required -> dado obrigatório
                //unique:produtos -> referencia não pode repetir na tabela produtos
                //min3 -> tamanho mínimo do texto (caracteres)
                //se não for valido os dados, será apresentado erro em resources/views/produtos/create.blade.php
            $this->validate($request, [
                'referencia' => 'required|unique:produtos|min:3',
                'titulo' => 'required|min:3',
            ]);

            $produto = new Produto();

            //pega cada informação do formulario para colocar no objeto produto (da model Produto)
            $produto->referencia = $request->input('referencia');
            $produto->titulo = $request->input('titulo');
            $produto->descricao = $request->input('descricao');
            $produto->preco = $request->input('preco');

            //se deu certo a gravação dos dados no BD
            //método save() é herdado da model Produto
            if($produto->save()){
                //retorna para o index de resources/views/produto/index.blade.php
                return redirect('produtos');
            }
        }else{
            return redirect ('login');
        }
    }

    //função para editar produtos
    //acessado por rota 127.0.0.1:8000/produtos/1/edit
    public function edit($id){
        //verifica se usuário está logado
        if(Auth::check()){
            //localiza produto pela id fornecida
                //utiliza a model Produto (app/Produto.php)
            $produto = Produto::find($id);
            //retorna a view e edição (resources/views/produto/edit.blade.php)
                //passa produto para a view via array
            return view('produto.edit', array('produto' => $produto));
        }else{
            return redirect ('login');
        }
    }

    //dados fornecidos via PUT do formulário (resources/views/produto/edit.blade.php)
    //função será acessada pela rota produtos.update passada pelo formulário
    public function update($id, Request $request){
        //verifica se usuário está logado
        if(Auth::check()){
            //localiza o produto via id fornecida
            $produto = Produto::find($id);
            //validação dos dados fornecidos
                //tanto referencia, quanto titulo, terão caracteres maior que três e são obrigatórios
            $this->validate($request, [
                'referencia' => 'required|min:3',
                'titulo' => 'required|min:3',
            ]);

            //tratamento de envio de imagem (foto) do produto
            if($request->hasFile('fotoproduto')){
                //recebe arquivo (requisição para upload do arquivo)
                $imagem = $request->file('fotoproduto');
                //nome = hash md5 da id do produto + extensão do arquivo
                $nomearquivo = md5($id) .".". $imagem->getClientOriginalExtension();
                //move a imagem (foto) para a pasta img/produtos/$nomearquivo que estará na pasta public do laravel(public/ img/produtos/$nomearquivo)
                $request->file('fotoproduto')->move(public_path('./img/produtos/'),
                    $nomearquivo);
            }

            //dados do produto
            $produto->referencia = $request->input('referencia');
            $produto->titulo = $request->input('titulo');
            $produto->descricao = $request->input('descricao');
            $produto->preco = $request->input('preco');

            //insere os dados no bd
            $produto->save();

            //sessão utilizada para informar que o produto foi alterado
                //será apresentada a mensagem em resources/views/produto/edit.blade.php @if(Session::has('mensagem'))
            Session::flash('mensagem', 'Produto alterado com sucesso.');

            //redireciona para a pagina anterior
            return redirect()->back();
        }else{
            return redirect ('login');
        }
    }

    //dados fornecidos via DELETE do formulário (resources/views/produto/index.blade.php)
    //função será acessada pela rota produtos.destroy passada pelo formulário
    public function destroy($id){
        //verifica se usuário está logado
        if(Auth::check()){
            //localiza produto pela id fornecida
            $produto = Produto::find($id);
            //deleta o produto localizado
            $produto->delete();
            //envia mensagem para o resources/views/produto/index.blade.php
            Session::flash('mensagem', 'Produto excluído com sucesso.');
            //redireciona para a página anterior (resources/views/produto/index.blade.php)
            return redirect()->back();
        }else{
            return redirect ('login');
        }
    }

    //método para buscar produtos
        //recebe dados do formulário de busca de (resources/views/produto/index.blade.php)
    //Request é necessário para acessar dados do formulário        
    public function buscar(Request $request){
        /*
        //busca produto pelo titulo ou descrição
        $produtos =  Produto::where('titulo', 'LIKE',
            '%'.$request->input('busca').'%')->orwhere('descricao', 'LIKE',
            '%'.$request->input('busca').'%')->get();
        */

        //busca produto pelo titulo ou descrição e realiza paginação dos produtos
        $produtos =  Produto::where('titulo', 'LIKE',
            '%'.$request->input('busca').'%')->orwhere('descricao', 'LIKE',
            '%'.$request->input('busca').'%')->paginate(4);        

        //retorna para a view o produto encontrado
            //resources/views/produto/index.blade.php
        return view('produto.index', array('produtos'=>$produtos,
            'busca'=>$request->input('busca')));
        
    }


    


}
