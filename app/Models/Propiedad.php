<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Propiedad extends Model
{
    use HasFactory ,SoftDeletes;

    protected $table = 'propiedades';

    protected $fillable = [
        'id_tipo',
        'id_venta',
        'id_estado',
        'precio_soles',
        'precio_dolares',
        'area',
        'nro_habitaciones',
        'nro_banos',
        'descripcion',
        'image_path',
        'direccion',
        'id_distrito',
        'id_agente'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function tipo(){
        return $this->belongsTo('App\Models\Tipo','id_tipo');
    }

    public function tipo_venta(){
        return $this->belongsTo('App\Models\Tipo','id_venta');
    }

    public function tipo_estado(){
        return $this->belongsTo('App\Models\Tipo','id_estado');
    }

    public function distrito(){
        return $this->belongsTo('App\Models\Ubigeo','id_distrito');
    }

    public function agente(){
        return $this->belongsTo('App\Models\User','id_agente');
    }

    public function fotos(){
        return $this->hasMany('App\Models\PropiedadFoto','id_propiedad');
    }

    public function caracteristicas(){
        return $this->hasMany('App\Models\PropiedadCaracteristica','id_propiedad');
    }
}
