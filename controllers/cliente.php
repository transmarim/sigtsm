<?php
session_start();
require_once("../modelos/Cliente.php");

$cliente = new Cliente();

/*INICIALIZO VARIABLES*/

$idcliente=isset($_POST['idcliente'])? limpiarCadena($_POST['idcliente']):"";

$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";

$telefono=isset($_POST['telefono'])? limpiarCadena($_POST['telefono']):"";

$tipo_documento=isset($_POST['tipo_documento'])? limpiarCadena($_POST['tipo_documento']):"";

$codigo=isset($_POST['codigo'])? limpiarCadena($_POST['codigo']):"";

$email=isset($_POST["email"])? limpiarCadena($_POST["email"]):"";

$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";

switch ($_GET["op"]){
    case 'guardaryeditar':
		if (empty($idcliente)){
            $rspta=$cliente->insertar($nombre,$codigo,$tipo_documento,$direccion,$telefono,$email);
            echo $rspta ? "Cliente registrado con exito":"No se pudieron registrar todos los datos del cliente";
		}
		else {
            $rspta=$cliente->editar($idcliente,$nombre,$codigo,$tipo_documento,$direccion,$telefono,$email);
			echo $rspta ? "Cliente actualizado con exito":"No se pudieron actualizar los datos del cliente";
		}
    break;

    case 'listar':
        $rspta = $cliente->listar();
        $data = Array();
        while($reg = $rspta->fetch_object()){
           $data[]=array(
               "0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idcliente.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idcliente.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning" onclick="mostrar('.$reg->idcliente.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idcliente.')"><i class="fa fa-check"></i></button>',
               "1"=>$reg->nombre,
               "2"=>$reg->tipo_documento.$reg->codigo,
               "3"=>$reg->telefono,
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
        $rspta = $cliente->mostrar($idcliente);
        echo json_encode($rspta);
    break;

    case 'desactivar':
      $rspta = $cliente->desactivar($idcliente);
      echo $rspta ? "Cliente desativado": "El cliente no se puede desactivar";
    break;

    case 'activar':
    $rspta = $cliente->activar($idcliente);
    echo $rspta ? "Cliente activado": "El cliente no se puede activar";
    break;

}
