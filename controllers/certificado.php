<?php
session_start();
require_once("../modelos/Certificado.php");

$certificado = new Certificado();

/*INICIALIZO VARIABLES*/

$idcertificado=isset($_POST['idcertificado'])? limpiarCadena($_POST['idcertificado']):"";

$numero=isset($_POST["numero"])? limpiarCadena($_POST["numero"]):"";

$fechaven=isset($_POST['fechaven'])? limpiarCadena($_POST['fechaven']):"";


switch ($_GET["op"]){
    case 'guardaryeditar':
		if (empty($idcertificado)){
            $rspta=$certificado->insertar($numero,$fechaven);
            echo $rspta ? "Certificado registrado con exito":"No se pudieron registrar todos los datos del certificado";
		}
		else {
            $rspta=$certificado->editar($idcertificado,$numero,$fechaven);
			echo $rspta ? "Certificado actualizado con exito":"No se pudieron actualizar los datos del certificado";
		}
    break;

    case 'listar':
        $rspta = $certificado->listar();
        $data = Array();
        while($reg = $rspta->fetch_object()){
           $data[]=array(
               "0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idcertificado.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idcertificado.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning" onclick="mostrar('.$reg->idcertificado.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idcertificado.')"><i class="fa fa-check"></i></button>',
               "1"=>$reg->numero,
               "2"=>$reg->fechaven,
               "3"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
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
        $rspta = $certificado->mostrar($idcertificado);
        echo json_encode($rspta);
    break;

    case 'desactivar':
      $rspta = $certificado->desactivar($idcertificado);
      echo $rspta ? "Certificado desativado": "El certificado no se puede desactivar";
    break;

    case 'activar':
    $rspta = $certificado->activar($idcertificado);
    echo $rspta ? "Certificado activado": "El certificado no se puede activar";
    break;

}
