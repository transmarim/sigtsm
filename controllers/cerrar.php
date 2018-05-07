<?php
session_start();
require_once("../modelos/Cerrar.php");

$cerrar = new Cerrar();

/*INICIALIZO VARIABLES*/

$startDate=isset($_POST["startDate"])? limpiarCadena($_POST["startDate"]):"";

$endDate=isset($_POST["endDate"])? limpiarCadena($_POST["endDate"]):"";


switch ($_GET["op"]){

    case 'listar':
        $rspta = $cerrar->listar();
        $data = Array();
        while($reg = $rspta->fetch_object()){
           $data[]=array(
               "0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idlicencia.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idlicencia.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning" onclick="mostrar('.$reg->idlicencia.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idlicencia.')"><i class="fa fa-check"></i></button>',
               "1"=>$reg->grado,
               "2"=>$reg->fechaven,
               "3"=>"<img src='vistas/img/licencias/".$reg->imagen."' height='50px' width='50px'>",
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
        $rspta = $cerrar->mostrar($idlicencia);
        echo json_encode($rspta);
    break;

    case 'cerrarS':
    //TRAER LOS ARRAYS
    $rspta = $cerrar->listartsm($startDate,$endDate);
    $rspta2 = $cerrar->listarcaribe($startDate,$endDate);

    //LEER EL ARRAY Y AL MISMO TIEMPO DARLE UPDATE
    foreach($rspta as $row){
        $cerrar->cerrarTSM($row['idtickettsm']);
    }
    foreach($rspta2 as $row){
        $cerrar->cerrarCaribe($row['idticketcaribe']);
    }
    //echo $rspta ? "Chofer activado": "El chofer no se puede activar";
    echo "Cierre realizado con exito";
    break;

}
