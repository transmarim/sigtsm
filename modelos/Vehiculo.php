<?php
require_once("conexion.php");

class Vehiculo{
    function __construct(){
        
    }
    public static function insertar($idseguro,$placa,$modelo,$anovehiculo,$imagen){
        $sql = "INSERT INTO vehiculo (idseguro,placa,modelo,anovehiculo,imagen,condicion) VALUES ('$idseguro','$placa','$modelo','$anovehiculo','$imagen',1)";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }
    
    public static function editar($idvehiculo,$idseguro,$placa,$modelo,$anovehiculo,$imagen){
        $sql = "UPDATE vehiculo SET idseguro='$idseguro', placa='$placa', modelo='$modelo', anovehiculo='$anovehiculo', imagen='$imagen' WHERE idvehiculo = '$idvehiculo'";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }
    
    public static function desactivar($idvehiculo){
        $sql = "UPDATE vehiculo SET condicion='0' WHERE idvehiculo='$idvehiculo'";
        return Consulta($sql);
    }
    
    public static function activar($idvehiculo){
        $sql = "UPDATE vehiculo SET condicion='1' WHERE idvehiculo='$idvehiculo'";
        return Consulta($sql);
    }
    
    public static function mostrar($idvehiculo){
        $sql = "SELECT * FROM vehiculo WHERE idvehiculo='$idvehiculo'";
        return ConsultaFila($sql);
    }
    
    public static function listar(){
        $sql = "SELECT * FROM vehiculo";
        return Consulta($sql);
    }
    
    public static function select(){
        $sql = "SELECT T1.idvehiculo, T1.placa, T1.modelo FROM vehiculo as T1 LEFT OUTER JOIN chofer as T2 ON T1.idvehiculo = T2.idvehiculo WHERE T2.idvehiculo is null";
        return Consulta($sql);
    }
    
    public static function contador(){
        $sql = "SELECT idvehiculo FROM vehiculo WHERE condicion=1";
        return Consulta_num($sql);
    }

}
