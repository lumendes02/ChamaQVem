<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CardapioController;
use App\Http\Controllers\CarrinhoControler;
use App\Http\Controllers\CidadeController;
use App\Http\Controllers\LojaController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\TipoUsuarioController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//login
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/cadastro', [AuthController::class, 'cadastro']);

Route::get('/usuario/{id}', [UsuarioController::class, 'show']);
Route::put('/usuario/{id}', [UsuarioController::class, 'update']);
Route::delete('/usuario/{id}', [UsuarioController::class, 'desativar']);


Route::get('/tipousuario', [TipoUsuarioController::class, 'index']);
Route::get('/tipousuario/{id}', [TipoUsuarioController::class, 'show']);
Route::post('/tipousuario', [TipoUsuarioController::class, 'store']);
Route::put('/tipousuario/{id}', [TipoUsuarioController::class, 'update']);
Route::delete('/tipousuario/{id}', [TipoUsuarioController::class, 'destroy']);

Route::get('/loja', [LojaController::class, 'index']);
//Route::get('/loja/{id}', [LojaController::class, 'show']);
Route::get('/loja/{id}', [LojaController::class, 'especificoUsuario']);
Route::post('/loja', [LojaController::class, 'store']);
Route::put('/loja/{id}', [LojaController::class, 'update']);
Route::delete('/loja/{id}', [LojaController::class, 'destroy']);

Route::get('/cardapio', [CardapioController::class, 'index']);
Route::get('/cardapio/{id}', [CardapioController::class, 'show']);
Route::get('/cardapioverifica/{id}', [CardapioController::class, 'verifica']);
Route::get('/cardapioloja/{idloja}', [CardapioController::class, 'todosloja']);
Route::post('/cardapio', [CardapioController::class, 'store']);
Route::put('/cardapio/{id}', [CardapioController::class, 'update']);
Route::delete('/cardapio/{id}', [CardapioController::class, 'destroy']);

Route::get('/produto', [ProdutoController::class, 'index']);
Route::get('/produto/{id}', [ProdutoController::class, 'show']);
Route::get('/produtocardapio/{idcardapio}', [ProdutoController::class, 'todosproduto']);
Route::post('/produto', [ProdutoController::class, 'store']);
Route::put('/produto/{id}', [ProdutoController::class, 'update']);
Route::delete('/produto/{id}', [ProdutoController::class, 'destroy']);

Route::get('/cidade', [CidadeController::class, 'index']);
Route::get('/cidade/{id}', [CidadeController::class, 'show']);

Route::get('/carrinho/{idusuario}/{idloja}', [CarrinhoControler::class, 'todosusuario']);
Route::get('/carrinho/{idusuario}/{idloja}/{idproduto}', [CarrinhoControler::class, 'verificaProdutoIgual']);
Route::post('/carrinho', [CarrinhoControler::class, 'store']);
Route::put('/carrinho', [CarrinhoControler::class, 'update']);
Route::put('/carrinho/{idusuario}/{idloja}', [CarrinhoControler::class, 'ativar']);
Route::delete('/carrinho/{id}', [CarrinhoControler::class, 'destroy']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    

    

    
    
});