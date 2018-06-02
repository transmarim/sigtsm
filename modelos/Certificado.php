<?php
require_once("conexion.php");

class Certificado{
    function __construct(){
        
    }
    public static function insertar($numero,$fechaven,$imagen){
        $sql = "INSERT INTO certificado (numero,fechaven,imagen,condicion) VALUES ('$numero','$fechaven','$imagen',1)";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }
    
    public static function editar($idcertificado,$numero,$fechaven,$imagen){
        $sql = "UPDATE certificado SET numero='$numero',fechaven='$fechaven',imagen='$imagen' WHERE idcertificado = '$idcertificado'";
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
    
    public static function select(){
        $sql = "SELECT T1.idcertificado, T1.numero FROM certificado as T1 LEFT OUTER JOIN chofer as T2 ON T1.idcertificado = T2.idcertificado WHERE T2.idcertificado is null AND T1.condicion=1";
        return Consulta($sql);
    }
    
}
