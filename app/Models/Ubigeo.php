<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use stdClass;

class Ubigeo extends Model
{
    use HasFactory ,SoftDeletes;

    protected $table = 'ubigeos';

    protected $fillable = [
        'id_tipo',
        'descripcion',
        'codigo',
        'id_padre'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function hijos(){
        return $this->hasMany('App\Models\Ubigeo','id_padre');
    }

    public function padre(){
        return $this->belongsTo('App\Models\Ubigeo','id_padre');
    }

    public function tipo(){
        return $this->belongsTo('App\Models\Tipo','id_tipo');
    }

    public static function obtenerUbigeo(int $id ,int $maxTipo = 0){
        $ubigeo = Ubigeo::find($id);

        $id_tipo = $ubigeo->id_tipo;
        $id_padre = $ubigeo->id_padre;

        $item = new stdClass();
        $item->id = $ubigeo->id;
        $item->descripcion = $ubigeo->descripcion;
        $lista[] = $item;

        $padre = $ubigeo->padre;

        while ($id_tipo != $maxTipo && $id_padre != null){
            $id_tipo = $padre->id_tipo;
            $id_padre = $padre->id_padre;

            $item = new stdClass();
            $item->id = $padre->id;
            $item->descripcion = $padre->descripcion;
            $lista[] = $item;
            $padre = $padre->padre;
        }

        return array_reverse($lista);
    }
}
