<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropiedadFoto;
use Illuminate\Support\Facades\Storage;
use Auth;

class PropiedadFotoController extends Controller
{
    public function __construct()
    {
        //
    }

    public function getPaginated(Request $request){
        $query = PropiedadFoto::where('id_propiedad',$request->id_propiedad)
            ->orderBy('id','asc');

        $total = $query->count();

        if ($request->start != 0){
            $query = $query->skip($request->start * $request->length);
        }

        $data = $query->take($request->length)->get();

        return response()->json(['draw' => $request->draw, 'recordsTotal' => $total, 'recordsFiltered' => $total, 'data' => $data]);
    }

    public function getImage($id){
        $propiedadFoto =  PropiedadFoto::find($id);
        $file = Storage::disk('images')->get($propiedadFoto->image_path);
        return response($file, 200);
    }

    public function procesar(Request $request){
        switch ($request->transaccion){
            case '1':
                if ($request->hasFile('image_propiedad_foto')) {
                    $image = $request->image_propiedad_foto;
                    $image_name = time().$image->getClientOriginalName();
                    $path = date("Y").'/'.date("m").'/'.date("d").'/'.Auth::user()->id;
                    $image_path = $image->storeAs($path, $image_name, 'images');

                    $propiedadFoto = new PropiedadFoto();
                    $propiedadFoto->id_propiedad = $request->id_propiedad;
                    $propiedadFoto->image_path = $image_path;
                    $propiedadFoto->save();
                }
                break;

            case '3':
                PropiedadFoto::find($request->id)->delete();
                break;
        }
    }
}
