<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropiedadCaracteristica;

class PropiedadCaracteristicaController extends Controller
{
    public function __construct()
    {
        //
    }

    public function getPaginated(Request $request){
        $query = PropiedadCaracteristica::where('id_propiedad',$request->id_propiedad)
            ->orderBy('id','asc');

        $total = $query->count();

        if ($request->start != 0){
            $query = $query->skip($request->start * $request->length);
        }

        $data = $query->take($request->length)->get();

        return response()->json(['draw' => $request->draw, 'recordsTotal' => $total, 'recordsFiltered' => $total, 'data' => $data]);
    }

    public function procesar(Request $request){
        switch ($request->transaccion){
            case '1':
                $propiedadCaracteristica = new PropiedadCaracteristica();
                $propiedadCaracteristica->id_propiedad = $request->id_propiedad;
                $propiedadCaracteristica->descripcion = $request->caracteristica;
                $propiedadCaracteristica->save();
                break;

            case '3':
                PropiedadCaracteristica::find($request->id)->delete();
                break;
        }
    }
}
