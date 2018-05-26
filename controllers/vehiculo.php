<?php
session_start();
require_once("../modelos/Vehiculo.php");

$vehiculo = new Vehiculo();

/*INICIALIZO VARIABLES*/

$idvehiculo=isset($_POST['idvehiculo'])? limpiarCadena($_POST['idvehiculo']):"";

$idseguro=isset($_POST['idseguro'])? limpiarCadena($_POST['idseguro']):"";

$placa=isset($_POST["placa"])? limpiarCadena($_POST["placa"]):"";

$modelo=isset($_POST["modelo"])? limpiarCadena($_POST["modelo"]):"";

$color=isset($_POST["color"])? limpiarCadena($_POST["color"]):"";

$anovehiculo=isset($_POST["anovehiculo"])? limpiarCadena($_POST["anovehiculo"]):"";

$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";

switch ($_GET["op"]){
    case 'guardaryeditar':
    if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name']))
		{
			$imagen=$_POST["imagenactual"];
		}
		else
		{
			$ext = explode(".", $_FILES["imagen"]["name"]);
			if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png" || $_FILES['imagen']['type'] == "application/pdf")
			{
                if($_FILES["imagen"]["size"]<500000){
				$imagen = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../vistas/img/vehiculos/". $imagen);
                }
			}
		}

		if (empty($idvehiculo)){
            $rspta=$vehiculo->insertar($idseguro,$placa,$modelo,$color,$anovehiculo,$imagen);
            echo $rspta ? "Vehiculo registrado con exito":"No se pudieron registrar todos los datos del vehiculo";
		}
		else {
            $rspta=$vehiculo->editar($idvehiculo,$idseguro,$placa,$modelo,$color,$anovehiculo,$imagen);
			echo $rspta ? "Vehiculo actualizado con exito":"No se pudieron actualizar los datos del vehiculo";
		}
    break;

    case 'listar':
        $rspta = $vehiculo->listar();
        $data = Array();
        while($reg = $rspta->fetch_object()){
            /*OBTENER EXTENSION PDF PARA CAMBIAR A ANCLE*/
           $val = explode(".",$reg->imagen);
           $ext = $val[count($val)-1];
           if($ext != 'pdf'){
           $data[]=array(
               "0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idvehiculo.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idvehiculo.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning" onclick="mostrar('.$reg->idvehiculo.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idvehiculo.')"><i class="fa fa-check"></i></button>',
               "1"=>$reg->placa,
               "2"=>$reg->modelo,
               "3"=>$reg->anovehiculo,
               "4"=>"<img src='vistas/img/vehiculos/".$reg->imagen."' height='50px' width='50px'>",
               "5"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
           );
          } else {
            $data[]=array(
                "0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idvehiculo.')"><i class="fa fa-pencil"></i></button>'.
                      ' <button class="btn btn-danger" onclick="desactivar('.$reg->idvehiculo.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning" onclick="mostrar('.$reg->idvehiculo.')"><i class="fa fa-pencil"></i></button>'.
                      ' <button class="btn btn-primary" onclick="activar('.$reg->idvehiculo.')"><i class="fa fa-check"></i></button>',
                "1"=>$reg->placa,
                "2"=>$reg->modelo,
                "3"=>$reg->anovehiculo,
                "4"=>"<a href='vistas/img/vehiculo/".$reg->imagen."' target='_blank'><img src='vistas/img/vehiculo/pdf.png' height='50px' width='50px'></a>",
                "5"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
            );
          }
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
        $rspta = $vehiculo->mostrar($idvehiculo);
        echo json_encode($rspta);
    break;

    case 'desactivar':
      $rspta = $vehiculo->desactivar($idvehiculo);
      echo $rspta ? "Vehiculo desativado": "El vehiculo no se puede desactivar";
    break;

    case 'activar':
    $rspta = $vehiculo->activar($idvehiculo);
    echo $rspta ? "Vehiculo activado": "El vehiculo no se puede activar";
    break;
    
    case 'selectVehiculo':
    $rspta = $vehiculo->select();
    while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' .$reg->idvehiculo. '>'.$reg->placa.' - '.$reg->modelo.'</option>';
				}
    break;
    
    case 'contador':
    $rspta = $vehiculo->contador();
    echo $rspta;
    break;
    
}
