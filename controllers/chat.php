<?php
session_start();
require_once("../modelos/Chat.php");

$chat = new Chat();

/*INICIALIZO VARIABLES*/

$mensaje=isset($_POST['mensaje'])? limpiarCadena($_POST['mensaje']):"";

$idusuario=isset($_POST['idusuario'])? limpiarCadena($_POST['idusuario']):"";

$nombre=isset($_POST['nombre'])? limpiarCadena($_POST['nombre']):"";

$imagen=isset($_POST['imagen'])? limpiarCadena($_POST['imagen']):"";

switch ($_GET["op"]){
    case 'guardaryeditar':
        $date = date('h:i');
        $rspta=$chat->insertar($idusuario,$nombre,$date,$mensaje,$imagen);
        echo $rspta;
            
    break;

    case 'mostrar':
        /*TRAE LOS ULTIMOS 5 MENSAJES*/
        $rspta = $chat->mostrar();
        $data = Array();
        while($reg = $rspta->fetch_object()){
            $data[]=array("0"=>$reg->nombre,"1"=>$reg->tiempo,"2"=>$reg->comentario,"3"=>$reg->imagen,"4"=>$reg->comentario);
        }
        echo json_encode($data);
    break;

}
