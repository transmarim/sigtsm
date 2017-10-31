<?php
require_once("conexion.php");

class ProntoPago{
    function __construct(){

    }
    
    public static function listarAlert(){
        $sql = "SELECT idchofer,cedula,nombre FROM chofer WHERE condicion=1";
        return Consulta($sql);
    }
}
