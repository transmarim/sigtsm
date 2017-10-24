<?php
session_start();
require_once("../modelos/Seguro.php");

$seguro = new Seguro();

/*INICIALIZO VARIABLES*/

$idseguro=isset($_POST['idseguro'])? limpiarCadena($_POST['idseguro']):"";

$numero=isset($_POST["numero"])? limpiarCadena($_POST["numero"]):"";

$fechaven=isset($_POST['fechaven'])? limpiarCadena($_POST['fechaven']):"";

$tipo_seguro=isset($_POST['tipo_seguro'])? limpiarCadena($_POST['tipo_seguro']):"";


switch ($_GET["op"]){
    case 'guardaryeditar':
		if (empty($idseguro)){
            $rspta=$seguro->insertar($numero,$fechaven,$tipo_seguro);
            echo $rspta ? "Seguro registrado con exito":"No se pudieron registrar todos los datos";
		}
		else {
            $rspta=$seguro->editar($idseguro,$numero,$fechaven,$tipo_seguro);
			echo $rspta ? "Seguro actualizado con exito":"No se pudieron actualizar los datos";
		}
    break;

    case 'listar':
        $rspta = $seguro->listar();
        $data = Array();
        while($reg = $rspta->fetch_object()){
           $data[]=array(
               "0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idseguro.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idseguro.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning" onclick="mostrar('.$reg->idseguro.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idseguro.')"><i class="fa fa-check"></i></button>',
               "1"=>$reg->numero,
               "2"=>$reg->fechaven,
               "3"=>$reg->tipo_seguro,
               "4"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
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
        $rspta = $seguro->mostrar($idseguro);
        echo json_encode($rspta);
    break;

    case 'desactivar':
      $rspta = $seguro->desactivar($idseguro);
      echo $rspta ? "Seguro desativado": "El seguro no se puede desactivar";
    break;

    case 'activar':
    $rspta = $seguro->activar($idseguro);
    echo $rspta ? "Seguro activado": "El seguro no se puede activar";
    break;

}
