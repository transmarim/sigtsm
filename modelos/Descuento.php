<?php
require_once("conexion.php");

class Descuento{
    function __construct(){
        
    }
    public static function insertar($nombre){
        $sql = "INSERT INTO descuento (nombre,condicion) VALUES ('$nombre',1)";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }
    
    public static function editar($iddescuento,$nombre){
        $sql = "UPDATE descuento SET nombre='$nombre' WHERE iddescuento = '$iddescuento'";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }
    
    public static function desactivar($iddescuento){
        $sql = "UPDATE descuento SET condicion='0' WHERE iddescuento='$iddescuento'";
        return Consulta($sql);
    }
    
    public static function activar($iddescuento){
        $sql = "UPDATE descuento SET condicion='1' WHERE iddescuento='$iddescuento'";
        return Consulta($sql);
    }
    
    public static function mostrar($iddescuento){
        $sql = "SELECT * FROM descuento WHERE iddescuento='$iddescuento'";
        return ConsultaFila($sql);
    }
    
    public static function listar(){
        $sql = "SELECT * FROM descuento";
        return Consulta($sql);
    }
    
     public static function listarc(){
        $sql = "SELECT iddescuento, nombre FROM descuento WHERE condicion=1";
        return Consulta($sql);
    }
    
}
