<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tipo extends Model
{
    use HasFactory ,SoftDeletes;

    protected $table = 'tipos';

    protected $fillable = [
        'descripcion',
        'id_padre'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function hijos(){
        return $this->hasMany('App\Models\Tipo','id_padre');
    }

    public function padre(){
        return $this->belongsTo('App\Models\Tipo','id_padre');
    }

    public static function tipos($id){
        $tipo = new Tipo();
        $tipo->id = $id;
        return $tipo->hijos;;
    }
}
