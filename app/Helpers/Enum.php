<?php
namespace App\Helpers;

class Enum {

    private static $initVariables = [
        "tipo" => [
            "venta" => 1,
            "estado-propiedad" => 4,
            "propiedad" => 7
        ],
        "ubigeo" => [
            "pais" => 11,
            "departamento" => 12,
            "provincia" => 13,
            "distrito" => 14
        ],
        "estado-propiedad" => [
            "disponible" => 5,
            "entregado" => 6
        ]
    ];

    public static function getValue(String $ruta = null){
        $resultado = self::$initVariables;

        if ($ruta != null){
            foreach(explode('.',$ruta) as $property){
                $resultado = $resultado[$property];
            }
        }

        return $resultado;
    }
}
?>
