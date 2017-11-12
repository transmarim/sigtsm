<?php
require_once("conexion.php");

class Ticketcarib{
    function __construct(){
        
    }
    public static function insertar($idcliente,$idchofer,$idcentro,$codigo,$fecha,$fechapago,$montop,$montoret,$montoc,$descripcion){
        $sql = "INSERT INTO ticketcaribe (idcliente,idchofer,idcentro,codigo,fecha,fechapago,montop,montoret,montoc,descripcion,estado,condicion) VALUES ('$idcliente','$idchofer','$idcentro','$codigo','$fecha','$fechapago','$montop','$montoret','$montoc','$descripcion',0,1)";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }
    
    public static function editar($idticketcaribe,$idcliente,$idchofer,$idcentro,$codigo,$fecha,$fechapago,$montop,$montoret,$montoc,$descripcion){
        $sql = "UPDATE ticketcaribe SET idcliente='$idcliente',idchofer='$idchofer',idcentro='$idcentro',codigo='$codigo',fecha='$fecha',fechapago='$fechapago',montop='$montop',montoret='$montoret',montoc='$montoc',descripcion='$descripcion' WHERE idticketcaribe = '$idticketcaribe'";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }
    
    public static function eliminar($idticketcaribe){
        $sql = "DELETE FROM ticketcaribe WHERE idticketcaribe='$idticketcaribe'";
        return Consulta($sql);
    }
    
    public static function mostrar($idticketcaribe){
        $sql = "SELECT * FROM ticketcaribe WHERE idticketcaribe='$idticketcaribe'";
        return ConsultaFila($sql);
    }
    
    public static function listar(){
        $sql = "SELECT T1.idticketcaribe, T4.nombre AS nombrech, T1.fechapago, T1.codigo, T2.nombre, T3.nombre AS nombrec, T1.montop, T1.condicion FROM ticketcaribe AS T1 LEFT JOIN cliente AS T2 ON T2.idcliente = T1.idcliente LEFT JOIN centro AS T3 ON T3.idcentro=T1.idcentro LEFT JOIN chofer AS T4 ON T4.idchofer = T1.idchofer WHERE estado=0";
        return Consulta($sql);
    }
    
}
