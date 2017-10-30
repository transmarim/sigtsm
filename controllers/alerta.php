<?php
require_once("../modelos/Alerta.php");

$alerta = new Alerta();

/*INICIALIZO VARIABLES*/

//$grado=isset($_POST['grado'])? limpiarCadena($_POST['grado']):"";
//
//$fechaven=isset($_POST['fechaven'])? limpiarCadena($_POST['fechaven']):"";
//
//$idlicencia=isset($_POST['idlicencia'])? limpiarCadena($_POST['idlicencia']):"";


switch ($_GET["op"]){
        
    case 'listarAlert':
        $rspta = $alerta->listarAlert();
        $data = Array();
        while($reg = $rspta->fetch_object()){
           $data[]=array(
               "0"=>$reg->cedula,
               "1"=>$reg->nombre,
               "2"=>"<button onclick='mostrar(".$reg->idchofer.")' id='btnAgregarArt' type='button'class='btn btn-warning btn-block btn-social' style='text-align:center;'><span class='fa fa-exclamation'></span>Notificar Alerta</button>"
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

}
