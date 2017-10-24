<?php
require_once("conexion.php");

class Certificado{
    function __construct(){
        
    }
    public static function insertar($numero,$fechaven){
        $sql = "INSERT INTO certificado (numero,fechaven,condicion) VALUES ('$numero','$fechaven',1)";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }
    
    public static function editar($idcertificado,$numero,$fechaven){
        $sql = "UPDATE certificado SET numero='$numero',fechaven='$fechaven' WHERE idcertificado = '$idcertificado'";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }
    
    public static function desactivar($idcertificado){
        $sql = "UPDATE certificado SET condicion='0' WHERE idcertificado='$idcertificado'";
        return Consulta($sql);
    }
    
    public static function activar($idcertificado){
        $sql = "UPDATE certificado SET condicion='1' WHERE idcertificado='$idcertificado'";
        return Consulta($sql);
    }
    
    public static function mostrar($idcertificado){
        $sql = "SELECT * FROM certificado WHERE idcertificado='$idcertificado'";
        return ConsultaFila($sql);
    }
    
    public static function listar(){
        $sql = "SELECT * FROM certificado";
        return Consulta($sql);
    }
    
     public static function listarc(){
        $sql = "SELECT idcertificado, numero FROM certificado WHERE condicion=1";
        return Consulta($sql);
    }
    
}
