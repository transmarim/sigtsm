<?php
require_once("conexion.php");

class Permiso{
    function __construct(){
        
    }
    
    public static function listar(){
        $sql = "SELECT * FROM permiso";
        return Consulta($sql);
    }
}