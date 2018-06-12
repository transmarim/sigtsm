<?php
require_once("conexion.php");

class Licencia{
    function __construct(){

    }
    public static function insertar($grado,$fechaven,$imagen){
        $sql = "INSERT INTO licencia (grado,fechaven,imagen,condicion) VALUES ('$grado','$fechaven','$imagen',1)";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }

    public static function editar($idlicencia,$grado,$fechaven,$imagen){
        $sql = "UPDATE licencia SET grado='$grado',fechaven='$fechaven',imagen='$imagen' WHERE idlicencia = '$idlicencia'";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }

    public static function desactivar($idlicencia){
        $sql = "UPDATE licencia SET condicion='0' WHERE idlicencia='$idlicencia'";
        return Consulta($sql);
    }

    public static function activar($idlicencia){
        $sql = "UPDATE licencia SET condicion='1' WHERE idlicencia='$idlicencia'";
        return Consulta($sql);
    }

    public static function mostrar($idlicencia){
        $sql = "SELECT * FROM licencia WHERE idlicencia='$idlicencia'";
        return ConsultaFila($sql);
    }

    public static function listar(){
        $sql = "SELECT * FROM licencia";
        return Consulta($sql);
    }

    public static function select(){
        $sql = "SELECT T1.idlicencia, T1.fechaven FROM licencia as T1 LEFT OUTER JOIN chofer as T2 ON T1.idlicencia = T2.idlicencia WHERE T2.idlicencia is null AND T1.condicion=1";
        return Consulta($sql);
    }
    
}
