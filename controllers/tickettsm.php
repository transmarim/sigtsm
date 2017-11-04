<?php
session_start();
require_once("../modelos/Tickettsm.php");

$tickettsm = new Tickettsm();

/*INICIALIZO VARIABLES*/

$idtickettsm=isset($_POST['idtickettsm'])? limpiarCadena($_POST['idtickettsm']):"";

$idcliente=isset($_POST['idcliente'])? limpiarCadena($_POST['idcliente']):"";

$idchofer=isset($_POST['idchofer'])? limpiarCadena($_POST['idchofer']):"";

$idcentro=isset($_POST['idcentro'])? limpiarCadena($_POST['idcentro']):"";

$codigo=isset($_POST["codigo"])? limpiarCadena($_POST["codigo"]):"";

$fecha=isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]):"";

$fechapago=isset($_POST["fechapago"])? limpiarCadena($_POST["fechapago"]):"";

$montop=isset($_POST["montop"])? limpiarCadena($_POST["montop"]):"";

$montoc=isset($_POST["montoc"])? limpiarCadena($_POST["montoc"]):"";

$montoret=isset($_POST["montoret"])? limpiarCadena($_POST["montoret"]):"";

$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";


switch ($_GET["op"]){
    case 'guardaryeditar':
        
		if (empty($idtickettsm)){
            $rspta=$tickettsm->insertar($idcliente,$idchofer,$idcentro,$codigo,$fecha,$fechapago,$montop,$montoret,$montoc,$descripcion);
            echo $rspta ? "Ticket ".$codigo." registrado con exito":"No se pudo registrar el Ticket verifique que no este duplicado";
		}
		else {
            $rspta=$tickettsm->editar($idtickettsm,$idcliente,$idchofer,$idcentro,$codigo,$fecha,$fechapago,$montop,$montoret,$montoc,$descripcion);
			echo $rspta ? "Ticket ".$codigo." actualizado con exito":"No se pudieron actualizar los datos del Ticket";
		}
    break;
        
    case 'listar':
        $rspta = $tickettsm->listar();
        $data = Array();
        while($reg = $rspta->fetch_object()){
           $data[]=array(
               "0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idtickettsm.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idtickettsm.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning" onclick="mostrar('.$reg->idtickettsm.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idtickettsm.')"><i class="fa fa-check"></i></button>',
               "1"=>$reg->fechapago,
               "2"=>$reg->codigo,
               "3"=>$reg->idcliente,
               "4"=>$reg->idcentro,
               "5"=>number_format($reg->montop,2,',','.'),
               "6"=>($reg->condicion)?'<span class="label bg-green">Activo</span>':'<span class="label bg-red">Inactivo</span>'
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
        $rspta = $tickettsm->mostrar($idtickettsm);
        echo json_encode($rspta);
    break;

    case 'desactivar':
      $rspta = $tickettsm->desactivar($idtickettsm);
      echo $rspta ? "Ticket desativado": "El Ticket no se puede desactivar";
    break;

    case 'activar':
    $rspta = $tickettsm->activar($idtickettsm);
    echo $rspta ? "Ticket activado": "El chofer no se puede activar";
    break;
    
    case 'selectc':
    $rspta = $tickettsm->selectc();
    while ($reg = $rspta->fetch_object())
        {
            echo '<option value=' .$reg->idtickettsm. '>' .$reg->codigo. '</option>';
        }
    break;

}
