<?php
session_start();
require_once("../modelos/Chat.php");

$chat = new Chat();

/*INICIALIZO VARIABLES*/

$mensaje=isset($_POST['mensaje'])? limpiarCadena($_POST['mensaje']):"";

$idusuario=isset($_POST['idusuario'])? limpiarCadena($_POST['idusuario']):"";

$nombre=isset($_POST['nombre'])? limpiarCadena($_POST['nombre']):"";

switch ($_GET["op"]){
    case 'guardaryeditar':
        $date = date('M. jS, Y');
        $rspta=$chat->insertar($idusuario,$nombre,$mensaje,$date);
        echo $rspta;
            
    break;

    case 'mostrar':
        /*ID USUARIO SE ENVIA POR POST ESTA DECLARADO EN LA INICIALIACION*/
        $rspta = $chat->mostrar($idlicencia);
        echo json_encode($rspta);
    break;

}
