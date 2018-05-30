<?php
require_once("conexion.php");

class Chat{
    function __construct(){

    }
    public static function insertar($idusuario,$nombre,$date,$mensaje,$imagen){
        $sql = "INSERT INTO chat (idusuario,nombre,tiempo,comentario,imagen) VALUES ('$idusuario','$nombre','$date','$mensaje','$imagen')";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }

    public static function mostrar(){
        $sql = "SELECT * FROM chat ORDER BY idchat DESC LIMIT 5";
        return Consulta($sql);
    }
  
}
