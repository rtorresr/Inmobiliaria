<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropiedadCaracteristica extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'propiedades_caracteristicas';

    protected $fillable = [
        'id_propiedad',
        'descripcion'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function propiedad(){
        return $this->belongsTo('App\Models\Propiedad','id_propiedad');
    }
}
