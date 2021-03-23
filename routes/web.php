<?php

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

Route::get('/', [App\Http\Controllers\WebController::class, 'index'])->name('web.home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/tipo/{id?}', [App\Http\Controllers\TipoController::class, 'index'])
        ->where('id','[0-9]+')
        ->name('tipo.index');

    Route::post('/tipo/formulario', [App\Http\Controllers\TipoController::class, 'formulario'])->name('tipo.formulario');

    Route::get('/ubigeo/{id?}', [App\Http\Controllers\UbigeoController::class, 'index'])
        ->where('id','[0-9]+')
        ->name('ubigeo.index');

    Route::post('/ubigeo/formulario', [App\Http\Controllers\UbigeoController::class, 'formulario'])->name('ubigeo.formulario');

    Route::get('/propiedad', [App\Http\Controllers\PropiedadController::class, 'index'])->name('propiedad.index');

    Route::post('/propiedad/formulario', [App\Http\Controllers\PropiedadController::class, 'formulario'])->name('propiedad.formulario');
});

Route::get('/propiedadFoto/getImage/{id}', [App\Http\Controllers\PropiedadFotoController::class, 'getImage'])
    ->name('propiedadFoto.getImage');

Route::get('/propiedad/mostrarImagen/{id}', [App\Http\Controllers\PropiedadController::class, 'mostrarImagen'])
    ->name('propiedad.mostrarImagen');

Route::get('/web/verPropiedad/{id}', [App\Http\Controllers\WebController::class, 'verPropiedad'])
    ->name('web.verPropiedad');

Route::get('/web/buscador/', [App\Http\Controllers\WebController::class, 'buscador'])
    ->name('web.buscador');
