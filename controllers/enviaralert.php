<?php

require_once("../modelos/Enviaralert.php");

$alert = new Enviaralert();

/*INICIALIZAMOS VARIABLES*/

$idchofer=isset($_POST['idchofer'])? limpiarCadena($_POST['idchofer']):"";

$nombre=isset($_POST['nombre'])? limpiarCadena($_POST['nombre']):"";

$asunto=isset($_POST['asunto'])? limpiarCadena($_POST['asunto']):"";

$descripcion=isset($_POST['descripcion'])? limpiarCadena($_POST['descripcion']):"";

$email=isset($_POST['email'])? limpiarCadena($_POST['email']):"";

$t = time();

$fecha = date("d/m/Y",$t);

switch ($_GET["op"]){

    case 'enviaralert':
    $rspta = $alert->enviarEmailAlert($idchofer,$nombre,$asunto,$descripcion,$fecha,$email);
    echo $rspta ? "Su mensaje fue enviado!": "Su mensaje no pudo ser enviado!";
    break;

}
?>