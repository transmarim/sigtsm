<?php
session_start();
require_once("../modelos/Descuento.php");

$descuento = new Descuento();

/*INICIALIZO VARIABLES*/

$iddescuento=isset($_POST['iddescuento'])? limpiarCadena($_POST['iddescuento']):"";

$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";


switch ($_GET["op"]){
    case 'guardaryeditar':
		if (empty($iddescuento)){
            $rspta=$descuento->insertar($nombre);
            echo $rspta ? "Descuento registrado con exito":"No se pudo registrar el descuento";
		}
		else {
            $rspta=$descuento->editar($iddescuento,$nombre);
			echo $rspta ? "Descuento actualizado con exito":"No se pudieron actualizar los datos del descuento";
		}
    break;

    case 'listar':
        $rspta = $descuento->listar();
        $data = Array();
        while($reg = $rspta->fetch_object()){
           $data[]=array(
               "0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->iddescuento.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->iddescuento.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning" onclick="mostrar('.$reg->iddescuento.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->iddescuento.')"><i class="fa fa-check"></i></button>',
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
        $rspta = $descuento->mostrar($iddescuento);
        echo json_encode($rspta);
    break;

    case 'desactivar':
      $rspta = $descuento->desactivar($iddescuento);
      echo $rspta ? "Descuento desactivado": "El descuento no se puede desactivar";
    break;

    case 'activar':
    $rspta = $descuento->activar($iddescuento);
    echo $rspta ? "Descuento activado": "El descuento no se puede activar";
    break;
    
    case 'listarc':
    $rspta = $descuento->listarc();
    while ($reg = $rspta->fetch_object())
        {
            echo '<option value=' .$reg->iddescuento. '>' .$reg->nombre. '</option>';
        }
    break;

}
