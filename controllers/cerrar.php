<?php
session_start();
require_once("../modelos/Cerrar.php");

$cerrar = new Cerrar();

/*INICIALIZO VARIABLES*/

$startDate=isset($_POST["startDate"])? limpiarCadena($_POST["startDate"]):"";

$endDate=isset($_POST["endDate"])? limpiarCadena($_POST["endDate"]):"";


switch ($_GET["op"]){

    case 'cerrarS':
    //TRAER LOS ARRAYS
    $rspta = $cerrar->listartsm($startDate,$endDate);
    $rspta2 = $cerrar->listarcaribe($startDate,$endDate);
    $rspta3 = $cerrar->listardsctos($startDate,$endDate);

    //LEER EL ARRAY Y AL MISMO TIEMPO DARLE UPDATE
    foreach($rspta as $row){
        $cerrar->cerrarTSM($row['idtickettsm']);
    }
    foreach($rspta2 as $row){
        $cerrar->cerrarCaribe($row['idticketcaribe']);
    }
    foreach($rspta3 as $row){
        $cerrar->cerrarDscto($row['idchofer_descuento']);
    }
    
    echo "Cierre realizado con exito";
    break;

}
