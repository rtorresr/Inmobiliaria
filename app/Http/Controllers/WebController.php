<?php

namespace App\Http\Controllers;

use App\Models\Propiedad;
use App\Models\Ubigeo;
use App\Helpers\Enum;
use Illuminate\Http\Request;
use stdClass;


class WebController extends Controller
{
    public function index()
    {
        $model = new stdClass();

        $propiedad = new PropiedadController();
        $request = new Request();
        $request->start = 0;
        $request->length = 5;
        $carouselPrincipal = $propiedad->mostrar($request);

        $model->carouselPrincipal = $carouselPrincipal;
        return view('web.welcome', ['model' => $model]);
    }

    public function verPropiedad($id)
    {
        $model = new stdClass();

        $model->propiedad = new Propiedad();
        $model->propiedad = Propiedad::find($id);
        $model->propiedad->ubigeo = Ubigeo::obtenerUbigeo($model->propiedad->id_distrito,Enum::getValue('ubigeo.departamento'));

        $propiedadFoto = new PropiedadFotoController();
        $requestFoto = new Request();
        $requestFoto->start = 0;
        $requestFoto->length = 1000;
        $requestFoto->id_propiedad = $id;
        $model->propiedadFoto = $propiedadFoto->getPaginated($requestFoto);

        $propiedadCaracteristica = new PropiedadCaracteristicaController();
        $requestCaracteristica = new Request();
        $requestCaracteristica->start = 0;
        $requestCaracteristica->length = 1000;
        $requestCaracteristica->id_propiedad = $id;
        $model->propiedadCaracteristica = $propiedadCaracteristica->getPaginated($requestCaracteristica);

        return view('web.verPropiedad', ['model' => $model]);
    }

    public function buscador()
    {
        return view('web.buscador');
    }

    public function buscar(Request $request)
    {
        $propiedad = new PropiedadController();
        $resultado = $propiedad->mostrar($request);

        return response()->json($resultado);
    }
}
