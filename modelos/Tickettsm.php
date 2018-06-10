<?php
require_once("conexion.php");

class Tickettsm{
    function __construct(){
        
    }
    public static function insertar($idcliente,$idchofer,$idcentro,$codigo,$fecha,$fechapago,$montop,$montoret,$montoc,$descripcion){
        $sql = "INSERT INTO tickettsm (idcliente,idchofer,idcentro,codigo,fecha,fechapago,montop,montoret,montoc,descripcion,estado,condicion) VALUES ('$idcliente','$idchofer','$idcentro','$codigo','$fecha','$fechapago','$montop','$montoret','$montoc','$descripcion',0,1)";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }
    
    public static function editar($idtickettsm,$idcliente,$idchofer,$idcentro,$codigo,$fecha,$fechapago,$montop,$montoret,$montoc,$descripcion){
        $sql = "UPDATE tickettsm SET idcliente='$idcliente',idchofer='$idchofer',idcentro='$idcentro',codigo='$codigo',fecha='$fecha',fechapago='$fechapago',montop='$montop',montoret='$montoret',montoc='$montoc',descripcion='$descripcion' WHERE idtickettsm = '$idtickettsm'";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }
    
    public static function eliminar($idtickettsm){
        $sql = "DELETE FROM tickettsm WHERE idtickettsm='$idtickettsm'";
        return Consulta($sql);
    }
    
    public static function mostrar($idtickettsm){
        $sql = "SELECT * FROM tickettsm WHERE idtickettsm='$idtickettsm'";
        return ConsultaFila($sql);
    }
    
    public static function listar(){
        $sql = "SELECT T1.idtickettsm, T4.nombre AS nombrech, T1.fecha, T1.codigo, T2.nombre, T3.nombre AS nombrec, T1.montop, T1.condicion FROM tickettsm AS T1 LEFT JOIN cliente AS T2 ON T2.idcliente = T1.idcliente LEFT JOIN centro AS T3 ON T3.idcentro=T1.idcentro LEFT JOIN chofer AS T4 ON T4.idchofer = T1.idchofer WHERE estado=0";
        return Consulta($sql);
    }

    public static function contador(){
        $sql = "SELECT idtickettsm FROM tickettsm WHERE condicion=1";
        return Consulta_num($sql);
    }
    
}
