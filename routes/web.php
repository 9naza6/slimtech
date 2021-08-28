<?php

use App\Http\Controllers\CursoController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', 'InicioController@index')->name('inicion.index');

Route::resource('cursos.carritos', 'CursoCarritoController')->only(['store', 'destroy']);
Route::resource('carritos', 'CarritoController')->only(['index']);
Route::resource('ordens', 'OrdenController')->only(['create', 'store']);
Route::resource('ordens.pagos', 'OrdenPagoController')->only(['create', 'store']);

// Route::get('/cursos', 'CursoController@index')->name('cursos.index');
// Route::get('/cursos/create', 'CursoController@create')->name('cursos.create');
// Route::post('/cursos', 'CursoController@store')->name('cursos.store');
Route::get('/cursos/{curso}', 'CursoShowController@show')->name('cursosshow.show');
// Route::get('/cursos/{curso}/edit', 'CursoController@edit')->name('cursos.edit');
// Route::put('/cursos/{curso}', 'CursoController@update')->name('cursos.update');
// Route::delete('/cursos/{curso}', 'CursoController@destroy')->name('cursos.destroy');


Route::get('/categoria/{categoriaCurso}', 'CategoriasController@show')->name('categorias.show');
Route::get('/categorias', 'CategoriasController@index')->name('categorias.index');

Route::get('/perfiles/{perfil}', 'PerfilShowController@show')->name('perfilesshow.show');
Route::get('/perfiles/{perfil}/edit', 'PerfilShowController@edit')->name('perfilesedit.edit');
Route::put('/perfiles/{perfil}', 'PerfilShowController@update')->name('perfilesupdate.update');
Route::get('/buscar/perfiles', 'PerfilShowController@search')->name('search.show');

// Buscador de cursos 
Route::get('/buscar', 'CursoShowController@search')->name('buscar.show');

Route::post('/pagos/pay', 'PagoController@pay')->name('pay');
Route::get('/pagos/approval', 'PagoController@approval')->name('approval');
Route::get('/pagos/cancelled', 'PagoController@cancelled')->name('cancelled');

// Almacenar los likes de los cursos
Route::post('/cursos/{curso}', 'LikesController@update')->name('likes.update');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
