<?php
require_once("conexion.php");

class Alerta{
    function __construct(){

    }
    
    public static function listarAlert(){
        $sql = "SELECT idchofer,cedula,nombre FROM chofer WHERE condicion=1";
        return Consulta($sql);
    }
    
    public static function listAlertLicencia($hoy){
        $sql ="SELECT T1.idlicencia,DATEDIFF(t1.fechaven,'$hoy') AS vencimiento,T2.nombre FROM chofer AS T2 LEFT JOIN licencia AS T1 ON T2.idlicencia = T1.idlicencia WHERE DATEDIFF(t1.fechaven,'$hoy') >=0 AND DATEDIFF(t1.fechaven,'$hoy') <= 30";
        return Consulta($sql);
    }
    /* CONSULTA DE ALERTA DE LICENCIAS VENCIDAS*/
    public static function listAlertLicenciaV($hoy){
        $sql ="SELECT T1.idlicencia,T2.nombre FROM chofer AS T2 LEFT JOIN licencia AS T1 ON T2.idlicencia = T1.idlicencia WHERE DATEDIFF(t1.fechaven,'$hoy') <0";
        return Consulta($sql);
    }
    
}
