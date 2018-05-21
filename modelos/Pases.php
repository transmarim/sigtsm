<?php
require_once("conexion.php");

class Pases{
    function __construct(){
        
    }
    
    public static function listarChofer(){
        $sql = "SELECT idchofer,nombre FROM chofer WHERE condicion= 1";
        return Consulta($sql);
    }

}
