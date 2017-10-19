<?php
require_once("conexion.php");

class Licencia{
    function __construct(){

    }
    public static function insertar($idvehiculo,$idlicencia,$idcertificado,$nombre,$cedula,$email,$imagen,$telefono,$fechanac,$direccion){
        $sql = "INSERT INTO chofer (idvehiculo,idlicencia,idcertificado,nombre,cedula,email,imagen,telefono,fechanac,direccion,condicion) VALUES ('$idvehiculo','$idlicencia','$idcertificado','$nombre','$cedula','$email','$imagen','$telefono','$fechanac','$direccion',1)";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }

    public static function editar($idchofer,$idvehiculo,$idlicencia,$idcertificado,$nombre,$cedula,$email,$imagen,$telefono,$fechanac,$direccion){
        $sql = "UPDATE chofer SET idvehiculo='$idvehiculo',idlicencia='$idlicencia',idcertificado='$idcertificado',nombre='$nombre',cedula='$cedula',email='$email',imagen='$imagen',telefono='$telefono',fechanac='$fechanac',direccion='$direccion' WHERE idchofer = '$idchofer'";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }

    public static function desactivar($idchofer){
        $sql = "UPDATE chofer SET condicion='0' WHERE idchofer='$idchofer'";
        return Consulta($sql);
    }

    public static function activar($idchofer){
        $sql = "UPDATE chofer SET condicion='1' WHERE idchofer='$idchofer'";
        return Consulta($sql);
    }

    public static function mostrar($idchofer){
        $sql = "SELECT * FROM chofer WHERE idchofer='$idchofer'";
        return ConsultaFila($sql);
    }

    public static function listar(){
        $sql = "SELECT * FROM chofer";
        return Consulta($sql);
    }

    public static function select(){
        $sql = "SELECT l.idlicencia FROM licencia as l , chofer AS c WHERE l.idlicencia != c.idlicencia";
        return Consulta($sql);
    }

}
