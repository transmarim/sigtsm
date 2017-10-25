<?php
require_once("conexion.php");

class Tarifas{
    function __construct(){
        
    }
    public static function insertar($nombre,$montotsmp,$montotsmc,$montocaribec){
        $sql = "INSERT INTO tarifa (nombre,montotsmp,montotsmc,montocaribec) VALUES ('$nombre','$montotsmp','$montotsmc','$montocaribec')";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }
    
    public static function editar($idtarifa,$nombre,$montotsmp,$montotsmc,$montocaribec){
        $sql = "UPDATE tarifa SET nombre='$nombre',montotsmp='$montotsmp',montotsmc='$montotsmc',montocaribec='$montocaribec' WHERE idtarifa = '$idtarifa'";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }
    
    public static function eliminar($idtarifa){
        $sql = "DELETE FROM tarifa WHERE idtarifa='$idtarifa'";
        return Consulta($sql);
    }
    
    public static function mostrar($idtarifa){
        $sql = "SELECT * FROM tarifa WHERE idtarifa='$idtarifa'";
        return ConsultaFila($sql);
    }
    
    public static function listar(){
        $sql = "SELECT * FROM tarifa";
        return Consulta($sql);
    }
    
}
