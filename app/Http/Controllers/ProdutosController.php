<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
//import do model Produto
use App\Produto;

class ProdutosController extends Controller
{

    public function index(){
        /*
        //retorna todos os produtos cadastrados no BD, através da model Produto
        $produtos = Produto::all();
        echo "<pre>";
        print_r($produtos);
        echo "</pre>";
        */
        //retorna todos os produtos cadastrados no BD, através da model Produto
        $produtos = Produto::all();
        //retorna a view resources/views/produto/index.blade.php e passa o array de todos os produtos cadastrados no bd
        return view('produto.index', array('produtos' => $produtos));
    }
    //se a url tiver id, então esta função é chamada
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
    public function create(){
        //Carrega view de resources/views/produto/create.blade.php
        return view('produto.create');
    }

    //método para salvar o produto cadastrado no banco de dados (enviado do resourcers/views/produto/create.blade.php)
    //Request é necessário para acessar dados do formulário
    public function store(Request $request){

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

    }

}
