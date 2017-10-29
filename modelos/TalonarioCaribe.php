<?php
require_once("conexion.php");

class TalonarioCaribe{
    function __construct(){
        
    }
    public static function insertar($idchofer,$desde,$hasta,$fecha){
        $sql = "INSERT INTO talonariocaribe (idchofer,desde,hasta,fecha) VALUES ('$idchofer','$desde','$hasta','$fecha')";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }
    
    public static function editar($idtalonario,$idchofer,$desde,$hasta,$fecha){
        $sql = "UPDATE talonariocaribe SET idchofer='$idchofer',desde='$desde',hasta='$hasta',fecha='$fecha' WHERE idtalonario = '$idtalonario'";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }
    
    public static function eliminar($idtalonario){
        $sql = "DELETE FROM talonariocaribe WHERE idtalonario='$idtalonario'";
        return Consulta($sql);
    }
    
    public static function mostrar($idtalonario){
        $sql = "SELECT * FROM talonariocaribe WHERE idtalonario='$idtalonario'";
        return ConsultaFila($sql);
    }
    
    public static function listar(){
        $sql = "SELECT T1.idtalonario,T1.idchofer,T1.desde,T1.hasta,T1.fecha,T2.nombre FROM talonariocaribe as T1 LEFT JOIN chofer AS T2 ON T1.idchofer = T2.idchofer";
        return Consulta($sql);
    }
    
}
