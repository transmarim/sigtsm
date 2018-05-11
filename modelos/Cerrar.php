<?php
require_once("conexion.php");

class Cerrar{
    function __construct(){

    }

    public static function cerrarTSM($idtickettsm){
        $sql = "UPDATE tickettsm SET estado = 1 WHERE idtickettsm = $idtickettsm";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }

    public static function cerrarCaribe($idticketcaribe){
        $sql = "UPDATE ticketcaribe SET estado = 1 WHERE idticketcaribe = $idticketcaribe";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }

    public static function cerrarDscto($idchofer_descuento){
        $sql = "UPDATE chofer_descuento SET estado = 1 WHERE idchofer_descuento = $idchofer_descuento";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }

    public static function listartsm($startDate,$endDate){
        $sql = "SELECT idtickettsm FROM tickettsm WHERE fechapago BETWEEN '$startDate' AND '$endDate' AND estado=0";
        return Consulta($sql);
    }

    public static function listarcaribe($startDate,$endDate){
        $sql = "SELECT idticketcaribe FROM ticketcaribe WHERE fechapago BETWEEN '$startDate' AND '$endDate' AND estado=0";
        return Consulta($sql);
    }
    
    public static function listardsctos($startDate,$endDate){
        $sql = "SELECT idchofer_descuento FROM chofer_descuento WHERE fecha BETWEEN '$startDate' AND '$endDate' AND estado=0";
        return Consulta($sql);
    }

}
