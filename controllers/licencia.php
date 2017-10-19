<?php
session_start();
require_once("../modelos/Licencia.php");

$licencia = new Licencia();

/*INICIALIZO VARIABLES*/

$grado=isset($_POST['grado'])? limpiarCadena($_POST['grado']):"";

$fechaven=isset($_POST['fechaven'])? limpiarCadena($_POST['fechaven']):"";

$idlicencia=isset($_POST['idlicencia'])? limpiarCadena($_POST['idlicencia']):"";


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

		if (empty($idlicencia)){
            $rspta=$licencia->insertar($idvehiculo,$idlicencia,$idcertificado,$nombre,$cedula,$email,$imagen,$telefono,$fechanac,$direccion);
            echo $rspta ? "Chofer registrado con exito":"No se pudieron registrar todos los datos del chofer";
		}
		else {
            $rspta=$licencia->editar($idchofer,$idvehiculo,$idlicencia,$idcertificado,$nombre,$cedula,$email,$imagen,$telefono,$fechanac,$direccion);
			echo $rspta ? "Chofer actualizado con exito":"No se pudieron actualizar los datos del chofer";
		}
    break;

    case 'listar':
        $rspta = $licencia->listar();
        $data = Array();
        while($reg = $rspta->fetch_object()){
           $data[]=array(
               "0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idchofer.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idchofer.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning" onclick="mostrar('.$reg->idchofer.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idchofer.')"><i class="fa fa-check"></i></button>',
               "1"=>$reg->nombre,
               "2"=>$reg->cedula,
               "3"=>$reg->telefono,
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
        $rspta = $licencia->mostrar($idlicencia);
        echo json_encode($rspta);
    break;

    case 'desactivar':
      $rspta = $licencia->desactivar($idlicencia);
      echo $rspta ? "Chofer desativado": "El chofer no se puede desactivar";
    break;

    case 'activar':
    $rspta = $licencia->activar($idlicencia);
    echo $rspta ? "Chofer activado": "El chofer no se puede activar";
    break;

    case 'selectLicencia':
    $rspta = $licencia->select();
    while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' .$reg->idchofer. '>' .$reg->idnombre. '</option>';
				}
    break;

}
