<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
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

Route::get('/regiones/listar',[Controller::class,'listarRegiones']); // recupera, muestra registro GET
Route::post('/regiones',[Controller::class,'guardarRegion']); // agrega nuevo registro, metodo POST
Route::put('/regiones/{id}',[Controller::class,'actualizarRegion']);
Route::get('/regiones/{id}',[Controller::class,'consultarRegion']);
Route::delete('/regiones/{id}',[Controller::class,'eliminarRegion']);

Route::get('/comuna/listar/{id}',[Controller::class,'listarComunaReg']); // va en region o comuna ???
Route::get('/comuna/listar',[Controller::class,'listarComuna']); 
Route::post('/comuna',[Controller::class,'guardarComuna']); 
Route::put('/comuna/{id}',[Controller::class,'actualizarComuna']);
Route::get('/comuna/{id}',[Controller::class,'consultarComuna']);
Route::delete('/comuna/{id}',[Controller::class,'eliminarComuna']);