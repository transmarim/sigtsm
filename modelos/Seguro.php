<?php
require_once("conexion.php");

class Seguro{
    function __construct(){
        
    }
    public static function insertar($numero,$fechaven,$tipo_seguro){
        $sql = "INSERT INTO seguro (numero,fechaven,tipo_seguro,condicion) VALUES ('$numero','$fechaven','$tipo_seguro',1)";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }
    
    public static function editar($idseguro,$numero,$fechaven,$tipo_seguro){
        $sql = "UPDATE seguro SET numero='$numero',fechaven='$fechaven',tipo_seguro='$tipo_seguro' WHERE idseguro = '$idseguro'";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }
    
    public static function desactivar($idseguro){
        $sql = "UPDATE seguro SET condicion='0' WHERE idseguro='$idseguro'";
        return Consulta($sql);
    }
    
    public static function activar($idseguro){
        $sql = "UPDATE seguro SET condicion='1' WHERE idseguro='$idseguro'";
        return Consulta($sql);
    }
    
    public static function mostrar($idseguro){
        $sql = "SELECT * FROM seguro WHERE idseguro='$idseguro'";
        return ConsultaFila($sql);
    }
    
    public static function listar(){
        $sql = "SELECT * FROM seguro";
        return Consulta($sql);
    }
    
     public static function listarc(){
        $sql = "SELECT idseguro, numero FROM seguro WHERE condicion=1";
        return Consulta($sql);
    }
    
}
