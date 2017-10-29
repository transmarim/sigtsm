<?php
session_start();
require_once("../modelos/Talonario.php");

$talonario = new Talonario();

/*INICIALIZO VARIABLES*/

$idtalonario=isset($_POST['idtalonario'])? limpiarCadena($_POST['idtalonario']):"";

$idchofer=isset($_POST["idchofer"])? limpiarCadena($_POST["idchofer"]):"";

$fecha=isset($_POST['fecha'])? limpiarCadena($_POST['fecha']):"";

$desde=isset($_POST['desde'])? limpiarCadena($_POST['desde']):"";

$hasta=isset($_POST['hasta'])? limpiarCadena($_POST['hasta']):"";

switch ($_GET["op"]){
    case 'guardaryeditar':
		if (empty($idtalonario)){
            $rspta=$talonario->insertar($idchofer,$desde,$hasta,$fecha);
            echo $rspta ? "Talonario registrado con exito":"No se pudieron registrar todos los datos de la entrega del talonario";
		}
		else {
            $rspta=$talonario->editar($idtalonario,$nombre,$montotsmp,$montotsmc,$montocaribec);
			echo $rspta ? "Talonario registrado con exito":"No se pudieron actualizar los datos de la entrega talonario";
		}
    break;

    case 'listar':
        $rspta = $talonario->listar();
        $data = Array();
        while($reg = $rspta->fetch_object()){
           $data[]=array(
 				"0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->idtalonario.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="imprimir('.$reg->idtalonario.')"><i class="fa fa-print"></i></button>'.' <button class="btn btn-danger" onclick="eliminar('.$reg->idtalonario.')"><i class="fa fa-trash"></i></button>',
 				"1"=>$reg->nombre,
 				"2"=>$reg->desde,
 				"3"=>$reg->hasta,
 				"4"=>$reg->fecha
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
        $rspta = $talonario->mostrar($idtalonario);
        echo json_encode($rspta);
    break;

    case 'eliminar':
      $rspta = $talonario->eliminar($idtalonario);
      echo $rspta ? "Talonario eliminado": "El talonario no se puede eliminar";
    break;

}
