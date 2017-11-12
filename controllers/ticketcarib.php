<?php
session_start();
require_once("../modelos/Ticketcarib.php");

$ticketcarib = new Ticketcarib();

/*INICIALIZO VARIABLES*/

$idticketcaribe=isset($_POST['idticketcaribe'])? limpiarCadena($_POST['idticketcaribe']):"";

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
        
		if (empty($idticketcaribe)){
            $rspta=$ticketcarib->insertar($idcliente,$idchofer,$idcentro,$codigo,$fecha,$fechapago,$montop,$montoret,$montoc,$descripcion);
            echo $rspta ? "Ticket ".$codigo." registrado con exito":"No se pudo registrar el Ticket verifique que no este duplicado";
		}
		else {
            $rspta=$ticketcarib->editar($idticketcaribe,$idcliente,$idchofer,$idcentro,$codigo,$fecha,$fechapago,$montop,$montoret,$montoc,$descripcion);
			echo $rspta ? "Ticket ".$codigo." actualizado con exito":"No se pudieron actualizar los datos del Ticket";
		}
    break;
        
    case 'listar':
        $rspta = $ticketcarib->listar();
        $data = Array();
        while($reg = $rspta->fetch_object()){
           $data[]=array(
               "0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->idticketcaribe.')"><i class="fa fa-pencil"></i></button>'.' <button class="btn btn-danger" onclick="eliminar('.$reg->idticketcaribe.')"><i class="fa fa-trash"></i></button>',
               "1"=>$reg->nombrech,
               "2"=>$reg->fechapago,
               "3"=>$reg->codigo,
               "4"=>$reg->nombre,
               "5"=>$reg->nombrec,
               "6"=>number_format($reg->montop,2,',','.'),
               "7"=>($reg->condicion)?'<span class="label bg-green">Activo</span>':'<span class="label bg-red">Inactivo</span>'
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
        $rspta = $ticketcarib->mostrar($idticketcaribe);
        echo json_encode($rspta);
    break;

    case 'eliminar':
      $rspta = $ticketcarib->eliminar($idticketcaribe);
      echo $rspta ? "Ticket eliminado": "El Ticket no se puede eliminar";
    break;
    
    case 'selectc':
    $rspta = $ticketcarib->selectc();
    while ($reg = $rspta->fetch_object())
        {
            echo '<option value=' .$reg->idticketcaribe. '>' .$reg->codigo. '</option>';
        }
    break;

}
