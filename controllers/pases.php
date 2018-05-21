<?php
session_start();
require_once("../modelos/Pases.php");
require_once("../modelos/Imprimir.php");
require_once("fpdf/fpdf.php");
require_once("fpdf/config.php");

$pases = new Pases();

/*INICIALIZO VARIABLES*/

$tipo_pase=isset($_POST['tipo_pase'])? limpiarCadena($_POST['tipo_pase']):"";

$fecha=isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]):"";

$choferes=isset($_POST['choferes'])? limpiarCadena($_POST['choferes']):"";

switch ($_GET["op"]){
    case 'guardaryeditar':
		if ($tipo_pase != "" || $fecha != "" || $choferes != ""){
            $pdf = new PDF();
            $pdf->AddPage();
            $X=5;
            $Y=5;
            $pdf->SetFont('Courier','B',12);
            $pdf->SetXY($X+5,$Y+20);
            switch($tipo_pase){
                case 1: $nombreEmp='INTT'; break;
                case 2: $nombreEmp='PDVSA'; break;}

            $pdf->MultiCell(200,5,'PASES PARA INGRESO DE INSTALACIONES',0,'C');
            $pdf->SetXY($X+5,$Y+35);
            $pdf->SetFont('Courier','',11);
            $pdf->MultiCell(185,5,"Estimado, mediante la presente solicitamos su coordial aprobacion",0,'L');
            //$pases->funcion();
            $pdf->Output('I','Pases/'.$fecha,true);

		}
		else {
			echo "Error faltan datos basicos";
		}
    break;

    case 'chofer':
        $rspta = $pases->listarChofer();
        while ($reg = $rspta->fetch_object())
        {
            echo '<li> <input type="checkbox" name="permiso[]" value="'.$reg->idchofer.'"> '.$reg->nombre.'</li>';
        }
    break;

}
