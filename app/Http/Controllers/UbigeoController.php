<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ubigeo;
use App\Helpers\Enum;

class UbigeoController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index($id = null){
        return view('ubigeo.index',['model' => (object) ['id' => $id]]);
    }

    public function getPaginated(Request $request){
        $query = Ubigeo::with('tipo:id,descripcion')
            ->where('id_padre',$request->id)
            ->orderBy('id','asc');

        $total = $query->count();

        if ($request->start != 0){
            $query = $query->skip($request->start * $request->length);
        }

        $data = $query->take($request->length)->get();

        return response()->json(['draw' => $request->draw, 'recordsTotal' => $total, 'recordsFiltered' => $total, 'data' => $data]);
    }

    public function listar($idTipo, $idPadre = null){
        $query = Ubigeo::with('tipo:id,descripcion')->where('id_tipo', $idTipo);

        if ($idPadre != null){
            $query->where('id_padre',$idPadre);
        }

        $data = $query->orderBy('id','asc')->get();

        return response()->json($data);
    }

    public function formulario(Request $request){
        $model = new Ubigeo();

        if($request->transaccion == 2){
            $model = Ubigeo::with('tipo:id,descripcion')->find($request->id);

            if ($model->id_padre != null){
                $model->padre = Ubigeo::find($model->id_padre);
            }
        } else {
            if ($request->id_padre != null){
                $model->padre = Ubigeo::find($request->id_padre);
                $model->id_padre = $request->id_padre;
            }
        }

        return view('ubigeo.formulario', [
            'transaccion' => $request->transaccion,
            'model' => $model
        ]);
    }

    public function procesar(Request $request){
        switch ($request->transaccion){
            case '1':
                $ubigeo = new Ubigeo();
                $data = $request->only($ubigeo->getFillable());
                $ubigeo->fill($data);
                $ubigeo->id = $request->id;

                if ($request->id_padre == null){
                    $ubigeo->id_tipo = Enum::getValue('ubigeo.pais');
                } else {
                    $padre = Ubigeo::find($request->id_padre);

                    if ($padre->id_tipo == Enum::getValue('ubigeo.pais')){
                        $ubigeo->id_tipo = Enum::getValue('ubigeo.departamento');
                    } else if ($padre->id_tipo == Enum::getValue('ubigeo.departamento')){
                        $ubigeo->id_tipo = Enum::getValue('ubigeo.provincia');
                    } else if ($padre->id_tipo == Enum::getValue('ubigeo.provincia')){
                        $ubigeo->id_tipo = Enum::getValue('ubigeo.distrito');
                    }
                }

                $ubigeo->save();
                break;
            case '2':
                $ubigeo = Ubigeo::find($request->id);
                $ubigeo->getFillable();
                $data = $request->only($ubigeo->getFillable());
                $ubigeo->fill($data);
                $ubigeo->save();
                break;
            case '3':
                Ubigeo::find($request->id)->delete();
                break;
        }
    }
}
