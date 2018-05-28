<?php
require_once("conexion.php");

class Chat{
    function __construct(){

    }
    public static function insertar($idusuario,$nombre,$date,$mensaje){
        $sql = "INSERT INTO chat (idusuario,nombre,tiempo,comentario) VALUES ('$idusuario','$nombre','$date','$mensaje')";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }

    public static function mostrar($idlicencia){
        $sql = "SELECT * FROM licencia WHERE idlicencia='$idlicencia'";
        return ConsultaFila($sql);
    }
  
}
