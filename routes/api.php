<?php

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

Route::middleware('auth:api')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/tipo/paginate', [App\Http\Controllers\TipoController::class, 'getPaginated'])
        ->name('tipo.paginate');

    Route::post('/tipo/procesar', [App\Http\Controllers\TipoController::class, 'procesar'])
        ->name('tipo.procesar');

    Route::post('/ubigeo/paginate', [App\Http\Controllers\UbigeoController::class, 'getPaginated'])
        ->name('ubigeo.paginate');

    Route::post('/ubigeo/procesar', [App\Http\Controllers\UbigeoController::class, 'procesar'])
        ->name('ubigeo.procesar');

    Route::post('/propiedad/paginate', [App\Http\Controllers\PropiedadController::class, 'getPaginated'])
        ->name('propiedad.paginate');

    Route::post('/propiedad/getImage', [App\Http\Controllers\PropiedadController::class, 'getImage'])
        ->name('propiedad.getImage');

    Route::post('/propiedad/procesar', [App\Http\Controllers\PropiedadController::class, 'procesar'])
        ->name('propiedad.procesar');

    Route::post('/propiedadFoto/paginate', [App\Http\Controllers\PropiedadFotoController::class, 'getPaginated'])
        ->name('propiedadFoto.paginate');

    Route::post('/propiedadFoto/procesar', [App\Http\Controllers\PropiedadFotoController::class, 'procesar'])
        ->name('propiedadFoto.procesar');

    Route::post('/propiedadCaracteristica/paginate', [App\Http\Controllers\PropiedadCaracteristicaController::class, 'getPaginated'])
        ->name('propiedadCaracteristica.paginate');

    Route::post('/propiedadCaracteristica/procesar', [App\Http\Controllers\PropiedadCaracteristicaController::class, 'procesar'])
        ->name('propiedadCaracteristica.procesar');
});

Route::get('/ubigeo/listar/{idTipo}/{idpadre?}', [App\Http\Controllers\UbigeoController::class, 'listar'])
    ->name('ubigeo.listar');

Route::post('/propiedad/mostrar', [App\Http\Controllers\PropiedadController::class, 'mostrar'])
    ->name('propiedad.mostrar');

Route::post('/correo/enviarConsulta', [App\Http\Controllers\CorreoController::class, 'enviarCorreo'])
    ->name('correo.enviar');

Route::post('/web/buscar', [App\Http\Controllers\WebController::class, 'buscar'])
    ->name('web.buscar');
