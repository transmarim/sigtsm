<?php
session_start();
require_once("../modelos/Chofer.php");

$chofer = new Chofer();

/*INICIALIZO VARIABLES*/

$idchofer=isset($_POST['idchofer'])? limpiarCadena($_POST['idchofer']):"";

$idvehiculo=isset($_POST['idvehiculo'])? limpiarCadena($_POST['idvehiculo']):"";

$idlicencia=isset($_POST['idlicencia'])? limpiarCadena($_POST['idlicencia']):"";

$idcertificado=isset($_POST['idcertificado'])? limpiarCadena($_POST['idcertificado']):"";

$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";

$cedula=isset($_POST["cedula"])? limpiarCadena($_POST["cedula"]):"";

$email=isset($_POST["email"])? limpiarCadena($_POST["email"]):"";

$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";

$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";

$fechanac=isset($_POST["fechanac"])? limpiarCadena($_POST["fechanac"]):"";

$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";

switch ($_GET["op"]){
    case 'guardaryeditar':
    if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name']))
		{
			$imagen=$_POST["imagenactual"];
		}
		else
		{
			$ext = explode(".", $_FILES["imagen"]["name"]);
			if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png")
			{
                if($_FILES["imagen"]["size"]<500000){
				$imagen = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../vistas/img/choferes/". $imagen);
                }
			}
		}

		if (empty($idusuario)){
            $rspta=$chofer->insertar($idvehiculo,$idlicencia,$idcertificado,$nombre,$cedula,$email,$imagen,$telefono,$fechanac,$direccion);
            echo $rspta ? "Chofer registrado con exito":"No se pudieron registrar todos los datos del chofer";
		}
		else {
            $rspta=$chofer->editar($idchofer,$idvehiculo,$idlicencia,$idcertificado,$nombre,$cedula,$email,$imagen,$telefono,$fechanac,$direccion);
			echo $rspta ? "Chofer actualizado con exito":"No se pudieron actualizar los datos del chofer";
		}
    break;
        
    case 'listar':
        $rspta = $chofer->listar();
        $data = Array();
        while($reg = $rspta->fetch_object()){
           $data[]=array(
               "0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idusuario.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idusuario.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning" onclick="mostrar('.$reg->idusuario.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idusuario.')"><i class="fa fa-check"></i></button>',
               "1"=>$reg->nombre,
               "2"=>$reg->email,
               "3"=>$reg->login,
               "4"=>"<img src='vistas/img/choferes/".$reg->imagen."' height='50px' width='50px'>",
               "5"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
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
        $rspta = $chofer->mostrar($idusuario);
        echo json_encode($rspta);
    break;

    case 'desactivar':
      $rspta = $chofer->desactivar($idusuario);
      echo $rspta ? "Usuario desativado": "El usuario no se puede desactivar";
    break;

    case 'activar':
    $rspta = $chofer->activar($idusuario);
    echo $rspta ? "Usuario activado": "El usuario no se puede activar";
    break;

}
