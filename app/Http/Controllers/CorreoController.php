<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\Consulta;
use Illuminate\Support\Facades\Mail;

class CorreoController extends Controller
{
    //
    public function enviarCorreo(Request $request){

        $mailabled = new Consulta($request->correo,$request->nombre,$request->asunto,$request->mensaje);

        Mail::to(env("MAIL_FROM_ADDRESS"))
            ->cc($request->correo)
            ->send($mailabled);

        if(count(Mail::failures()) > 0){
            return response()->json(['success' => false]);
        } else {
            return response()->json(['success' => true]);
        }
    }
}
