<?php
require_once("conexion.php");

class Cliente{
    function __construct(){
        
    }
    public static function insertar($nombre,$codigo,$tipo_documento,$direccion,$telefono,$email){
        $sql = "INSERT INTO cliente (nombre,codigo,tipo_documento,direccion,telefono,email,condicion) VALUES ('$nombre','$codigo','$tipo_documento','$direccion','$telefono','$email',1)";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }
    
    public static function editar($idcliente,$nombre,$codigo,$tipo_documento,$direccion,$telefono,$email){
        $sql = "UPDATE cliente SET nombre='$nombre',codigo='$codigo',tipo_documento='$tipo_documento',direccion='$direccion',telefono='$telefono',email='$email' WHERE idcliente = '$idcliente'";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }
    
    public static function desactivar($idcliente){
        $sql = "UPDATE cliente SET condicion='0' WHERE idcliente='$idcliente'";
        return Consulta($sql);
    }
    
    public static function activar($idcliente){
        $sql = "UPDATE cliente SET condicion='1' WHERE idcliente='$idcliente'";
        return Consulta($sql);
    }
    
    public static function mostrar($idcliente){
        $sql = "SELECT * FROM cliente WHERE idcliente='$idcliente'";
        return ConsultaFila($sql);
    }
    
    public static function listar(){
        $sql = "SELECT * FROM cliente";
        return Consulta($sql);
    }
    
     public static function listarc(){
        $sql = "SELECT idcliente, nombre FROM cliente WHERE condicion=1";
        return Consulta($sql);
    }
    
}
