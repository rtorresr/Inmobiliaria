<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tipo;

class TipoController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index($id = null){
        return view('tipo.index',['model' => (object) ['id' => $id]]);
    }

    public function getPaginated(Request $request){
        $query = \App\Models\Tipo::where('id_padre',$request->id)->orderBy('id','asc');

        $total = $query->count();

        if ($request->start != 0){
            $query = $query->skip($request->start * $request->length);
        }

        $data = $query->take($request->length)->get();

        return response()->json(['draw' => $request->draw, 'recordsTotal' => $total, 'recordsFiltered' => $total, 'data' => $data]);
    }

    public function formulario(Request $request){
        $model = new Tipo();

        if($request->transaccion == 2){
            $model = Tipo::find($request->id);

            if ($model->id_padre != null){
                $model->padre = Tipo::find($model->id_padre);
            }
        } else {
            if ($request->id_padre != null){
                $model->padre = Tipo::find($request->id_padre);
                $model->id_padre = $request->id_padre;
            }
        }

        return view('tipo.formulario', [
            'transaccion' => $request->transaccion,
            'model' => $model
        ]);
    }

    public function procesar(Request $request){
        switch ($request->transaccion){
            case '1':
                $tipo = new Tipo();
                $data = $request->only($tipo->getFillable());
                $tipo->fill($data);
                $tipo->id = $request->id;
                $tipo->save();
                break;
            case '2':
                $tipo = Tipo::find($request->id);
                $tipo->getFillable();
                $data = $request->only($tipo->getFillable());
                $tipo->fill($data);
                $tipo->save();
                break;
            case '3':
                Tipo::find($request->id)->delete();
                break;
        }
    }
}
