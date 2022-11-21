<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Produto\ProdutoController;

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

Route::post('/produto', [ProdutoController::class, 'store']);
Route::get('/produto', [ProdutoController::class, 'show']);
Route::get('/produtos', [ProdutoController::class, 'index']);
Route::get('/produtos/s', [ProdutoController::class, 'seach']);
Route::put('/produto', [ProdutoController::class, 'update']);
Route::delete('/produto', [ProdutoController::class, 'destroy']);





