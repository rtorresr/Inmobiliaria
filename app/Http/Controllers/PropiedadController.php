<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Propiedad;
use App\Models\Ubigeo;
use App\Helpers\Enum;
use stdClass;
use Illuminate\Support\Facades\Storage;
use Auth;

class PropiedadController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index(){
        return view('propiedad.index');
    }

    public function getPaginated(Request $request){
        $query = Propiedad::with('tipo:id,descripcion')
            ->with('tipo_venta:id,descripcion')
            ->with('tipo_estado:id,descripcion')
            ->orderBy('id','asc');

        $total = $query->count();

        if ($request->start != 0){
            $query = $query->skip($request->start * $request->length);
        }

        $preData = $query->take($request->length)->get();

        $data = [];
        foreach($preData as $item){
            $o = new stdClass();
            $o = $item;
            $o->ubigeo =  Ubigeo::obtenerUbigeo($o->id_distrito,Enum::getValue('ubigeo.departamento'));
            $data[] = $o;

        }

        return response()->json(['draw' => $request->draw, 'recordsTotal' => $total, 'recordsFiltered' => $total, 'data' => $data]);
    }

    public function formulario(Request $request){
        $model = new Propiedad();
        if($request->transaccion == 2){
            $model = Propiedad::find($request->id);
            $model->ubigeo = Ubigeo::obtenerUbigeo($model->id_distrito,Enum::getValue('ubigeo.departamento'));
        }

        return view('propiedad.formulario', [
            'transaccion' => $request->transaccion,
            'model' => $model
        ]);
    }

    public function getImage(Request $request){
        $file = Storage::disk('images')->get($request->image_path);
        return response(base64_encode($file), 200);
    }

    public function procesar(Request $request){
        $image_path = '';
        if ($request->hasFile('image_principal')) {
            $image = $request->image_principal;
            $image_name = time().$image->getClientOriginalName();
            $path = date("Y").'/'.date("m").'/'.date("d").'/'.Auth::user()->id;
            $image_path = $image->storeAs($path, $image_name, 'images');
        }

        switch ($request->transaccion){
            case '1':
                $propiedad = new Propiedad();
                $data = $request->only($propiedad->getFillable());
                $propiedad->fill($data);
                $propiedad->id = $request->id;
                $propiedad->id_agente = Auth::user()->id;
                $propiedad->image_path = strlen($image_path) > 0 ? $image_path : $propiedad->image_path;
                $propiedad->save();
                break;
            case '2':
                $propiedad = Propiedad::find($request->id);
                $propiedad->getFillable();
                $data = $request->only($propiedad->getFillable());
                $propiedad->fill($data);
                $propiedad->image_path = strlen($image_path) > 0 ? $image_path : $propiedad->image_path;
                $propiedad->save();
                break;
            case '3':
                Propiedad::find($request->id)->delete();
                break;
        }
    }

    public function mostrar(Request $request){
        $query = Propiedad::with('tipo:id,descripcion')
            ->with('tipo_venta:id,descripcion')
            ->where('id_estado',Enum::getValue('estado-propiedad.disponible'));

        if ($request->id_tipo != null && $request->id_tipo != '' && $request->id_tipo != '0'){
            $query->where('id_tipo',$request->id_tipo);
        }

        if ($request->id_venta != null && $request->id_venta != '' && $request->id_venta != '0'){
            $query->where('id_venta',$request->id_venta);
        }

        if ($request->nro_habitaciones != null && $request->nro_habitaciones != ''){
            $query->where('nro_habitaciones',$request->nro_habitaciones);
        }

        if ($request->nro_banos != null && $request->nro_banos != ''){
            $query->where('nro_habitaciones',$request->nro_banos);
        }

        if ($request->id_distrito != null && $request->id_distrito != '' && $request->id_distrito != '0'){
            $query->where('id_distrito',$request->id_distrito);
        }

        if ($request->order == 1){
            $query->orderBy('precio_soles','asc');
        } else {
            $query->orderBy('created_at','desc');
        }

        $total = $query->count();

        if ($request->start != 0){
            $query = $query->skip($request->start * $request->length);
        }

        $preData = $query->take($request->length)->get();

        $data = [];
        foreach($preData as $item){
            $o = new stdClass();
            $o = $item;
            $o->ubigeo =  Ubigeo::obtenerUbigeo($o->id_distrito,Enum::getValue('ubigeo.departamento'));
            $data[] = $o;

        }

        return response()->json(['recordsTotal' => $total, 'recordsFiltered' => $total, 'data' => $data]);
    }

    public function mostrarImagen($id){
        $propiedad =  Propiedad::find($id);
        $file = Storage::disk('images')->get($propiedad->image_path);
        return response($file, 200);
    }
}
