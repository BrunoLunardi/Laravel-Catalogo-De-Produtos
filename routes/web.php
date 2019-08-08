<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    //return view('welcome');
    return view('layout.app');
});
*/

Route::get('/', 'ProdutosController@index');
Route::get('contato', 'ContatoController@index');
Route::post('contato/enviar', 'ContatoController@enviar');

///////////////////////////
//rota para produtos
///////////////////////////
Route::resource('produtos', 'ProdutosController');
//rota para pesquisar produtos (rota POST)
    //rota aponta diretamente para um método do Controller
    //os métodos create, edit, show e destroy não são criados rotas para eles, pois já estão em resouce
Route::post('produtos/buscar', 'ProdutosController@buscar');
Route::get('adicionar-produto', 'ProdutosController@create');
Route::get('produtos/{id}/editar', 'ProdutosController@edit');

//rotas adicionadas pelo sistema de autenticação laravel (php artisan make:auth)
Auth::routes(); //inclui caminhos de login e logout
Route::get('/home', 'HomeController@index')->name('home');///raiz da aplicação

///////////////////////////
//Rotas para contato
///////////////////////////
    //Não foi criado rota tipo resource, pois não precisa implementar um CRUD
//Route::get('contato', 'ContatoController@index');
//Envio de dados do formulário para o método enviar do controller ContatoController
//Route::post('contato/enviar', 'ContatoController@enviar');

/*
//rota para logout do sistema
Route::get('/logout', function() {
    Auth::logout();
    return view('welcome');
});*/