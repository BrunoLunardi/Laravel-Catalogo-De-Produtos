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
        echo "<pre>";
        print_r($produto);
        echo "</pre>";
    }

}
