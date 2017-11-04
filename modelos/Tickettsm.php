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
    
    public static function desactivar($idtickettsm){
        $sql = "UPDATE tickettsm SET condicion='0' WHERE idtickettsm='$idtickettsm'";
        return Consulta($sql);
    }
    
    public static function activar($idtickettsm){
        $sql = "UPDATE tickettsm SET condicion='1' WHERE idtickettsm='$idtickettsm'";
        return Consulta($sql);
    }
    
    public static function mostrar($idtickettsm){
        $sql = "SELECT * FROM tickettsm WHERE idtickettsm='$idtickettsm'";
        return ConsultaFila($sql);
    }
    
    public static function listar(){
        $sql = "SELECT * FROM tickettsm WHERE estado=0";
        return Consulta($sql);
    }
    
}
