<?php
session_start();
require_once("../modelos/Centro.php");

$centro = new Centro();

/*INICIALIZO VARIABLES*/

$idcentro=isset($_POST['idcentro'])? limpiarCadena($_POST['idcentro']):"";

$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";

switch ($_GET["op"]){
    case 'guardaryeditar':
		if (empty($idcliente)){
            $rspta=$centro->insertar($nombre);
            echo $rspta ? "Buque registrado con exito":"No se pudieron registrar todos los datos del Buque";
		}
		else {
            $rspta=$centro->editar($idcentro,$nombre);
			echo $rspta ? "Buque actualizado con exito":"No se pudieron actualizar los datos del Buque";
		}
    break;

    case 'listar':
        $rspta = $centro->listar();
        $data = Array();
        while($reg = $rspta->fetch_object()){
           $data[]=array(
               "0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idcentro.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idcentro.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning" onclick="mostrar('.$reg->idcentro.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idcentro.')"><i class="fa fa-check"></i></button>',
               "1"=>$reg->nombre,
               "2"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
           );
        }
        /*CARGAMOS LA DATA EN LA VARIABLE USADA PARA EL DATATABLE*/
        $results = array(
 			"sEcho"=>1, //Informacion para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
        echo json_encode($results);
    break;

    case 'mostrar':
        /*ID USUARIO SE ENVIA POR POST ESTA DECLARADO EN LA INICIALIACION*/
        $rspta = $centro->mostrar($idcentro);
        echo json_encode($rspta);
    break;

    case 'desactivar':
      $rspta = $centro->desactivar($idcentro);
      echo $rspta ? "Buque desativado": "El buque no se puede desactivar";
    break;

    case 'activar':
    $rspta = $centro->activar($idcentro);
    echo $rspta ? "Buque activado": "El buque no se puede activar";
    break;

}
