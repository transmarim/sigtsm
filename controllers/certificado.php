<?php
session_start();
require_once("../modelos/Certificado.php");

$certificado = new Certificado();

/*INICIALIZO VARIABLES*/

$idcertificado=isset($_POST['idcertificado'])? limpiarCadena($_POST['idcertificado']):"";

$numero=isset($_POST["numero"])? limpiarCadena($_POST["numero"]):"";

$fechaven=isset($_POST['fechaven'])? limpiarCadena($_POST['fechaven']):"";

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
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../vistas/img/certificados/". $imagen);
                }
			}
		}

		if (empty($idcertificado)){
            $rspta=$certificado->insertar($numero,$fechaven,$imagen);
            echo $rspta ? "Certificado registrado con exito":"No se pudieron registrar todos los datos del certificado";
		}
		else {
            $rspta=$certificado->editar($idcertificado,$numero,$fechaven,$imagen);
			echo $rspta ? "Certificado actualizado con exito":"No se pudieron actualizar los datos del certificado";
		}
    break;

    case 'listar':
        $rspta = $certificado->listar();
        $data = Array();
        while($reg = $rspta->fetch_object()){
        /*OBTENER EXTENSION PDF PARA CAMBIAR A ANCLE*/
        $val = explode(".",$reg->imagen);
        $ext = $val[count($val)-1]; 
        if($ext != 'pdf'){
            $data[]=array(
                "0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idcertificado.')"><i class="fa fa-pencil"></i></button>'.
                      ' <button class="btn btn-danger" onclick="desactivar('.$reg->idcertificado.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning" onclick="mostrar('.$reg->idcertificado.')"><i class="fa fa-pencil"></i></button>'.
                      ' <button class="btn btn-primary" onclick="activar('.$reg->idcertificado.')"><i class="fa fa-check"></i></button>',
                "1"=>$reg->numero,
                "2"=>$reg->fechaven,
                "3"=>"<img src='vistas/img/certificados/".$reg->imagen."' height='50px' width='50px'>",
                "4"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
                );
            } else {
                $data[]=array(
                    "0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idcertificado.')"><i class="fa fa-pencil"></i></button>'.
                          ' <button class="btn btn-danger" onclick="desactivar('.$reg->idcertificado.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning" onclick="mostrar('.$reg->idcertificado.')"><i class="fa fa-pencil"></i></button>'.
                          ' <button class="btn btn-primary" onclick="activar('.$reg->idcertificado.')"><i class="fa fa-check"></i></button>',
                    "1"=>$reg->numero,
                    "2"=>$reg->fechaven,
                    "3"=>"<a href='vistas/img/certificados/".$reg->imagen."' target='_blank'><img src='vistas/img/certificados/pdf.png' height='50px' width='50px'></a>",
                    "4"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
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
    
    case 'selectCertificado':
    $rspta = $certificado->select();
    while ($reg = $rspta->fetch_object())
				{
					echo '<option value='.$reg->idcertificado.'>'.$reg->numero.'</option>';
				}
    break;    

}
