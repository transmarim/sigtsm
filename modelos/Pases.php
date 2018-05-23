<?php
require_once("conexion.php");

class Pases{
    function __construct(){
        
    }
    
    public static function listarChofer(){
        $sql = "SELECT idchofer,nombre FROM chofer WHERE condicion= 1";
        return Consulta($sql);
    }

    public static function mostrarChofer($idchofer){
        $sql = "SELECT T1.nombre, T1.cedula, T2.modelo, T2.placa, T1.telefono FROM chofer AS T1 LEFT JOIN vehiculo AS T2 ON T1.idvehiculo=T2.idvehiculo WHERE T1.condicion = 1 AND T1.idchofer = $idchofer";
        return Consulta($sql);
    }

}
