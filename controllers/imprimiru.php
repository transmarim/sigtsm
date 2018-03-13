<?php
session_start();
require_once("fpdf/fpdf.php");

$pdf = new FPDF();

/*INICIALIZO VARIABLES*/

$idchofer=isset($_POST['idchofer'])? limpiarCadena($_POST['idchofer']):"";

$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";

$montotsmp=isset($_POST['montotsmp'])? limpiarCadena($_POST['montotsmp']):"";

$montotsmc=isset($_POST['montotsmc'])? limpiarCadena($_POST['montotsmc']):"";

$montocaribec=isset($_POST['montocaribec'])? limpiarCadena($_POST['montocaribec']):"";

switch ($_GET["op"]){
    case 'guardaryeditar':
		if (empty($idtarifa)){
            $rspta=$tarifa->insertar($nombre,$montotsmp,$montotsmc,$montocaribec);
            echo $rspta ? "Tarifa registrada con exito":"No se pudieron registrar todos los datos de la tarifa";
		}
		else {
            $rspta=$tarifa->editar($idtarifa,$nombre,$montotsmp,$montotsmc,$montocaribec);
			echo $rspta ? "Tarifa actualizada con exito":"No se pudieron actualizar los datos de la tarifa";
		}
    break;

    case 'listar':
        $rspta = $tarifa->listar();
        $data = Array();
        while($reg = $rspta->fetch_object()){
           $data[]=array(
 				"0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->idtarifa.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="eliminar('.$reg->idtarifa.')"><i class="fa fa-trash"></i></button>',
 				"1"=>$reg->nombre,
 				"2"=>$reg->montotsmp,
 				"3"=>$reg->montotsmc,
 				"4"=>$reg->montocaribec
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
        $rspta = $tarifa->mostrar($idtarifa);
        echo json_encode($rspta);
    break;

    case 'eliminar':
      $rspta = $tarifa->eliminar($idtarifa);
      echo $rspta ? "Tarifa eliminada": "La tarifa no se puede eliminar";
    break;

}
