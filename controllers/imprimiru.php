<?php
require_once("../modelos/Imprimir.php");
require_once("fpdf/fpdf.php");
require_once("fpdf/config.php");

/*INICIALIZO VARIABLES*/

$idchofer=isset($_POST['idchofer'])? limpiarCadena($_POST['idchofer']):"";

$idempresa=isset($_POST["idempresa"])? limpiarCadena($_POST["idempresa"]):"";

$startDate=isset($_POST["startDate"])? limpiarCadena($_POST["startDate"]):"";

$endDate=isset($_POST["endDate"])? limpiarCadena($_POST["endDate"]):"";

switch ($_GET["op"]){
    case 'reporteProntoP':
		if ($idchofer != "" || $idempresa != "" || $startDate != "" || $endDate != "" ){

            $pdf = new PDF();
            $pdf->AddPage();
            $X=5;
		    $Y=5;
            $pdf->SetFont('Courier','B',10);
            $pdf->SetXY($X+5,$Y+13);
            switch($idempresa){
                case 1: $nombreEmp='TRANSPORT AND SERVICES MARINE, C.A'; $tablaemp='tickettsm'; break;
                case 2: $nombreEmp='CARIBBEAN OCEAN'; $tablaemp='ticketcaribe'; break;}
            $pdf->MultiCell(200,5,'RELACION DE SERVICIOS POR '.$nombreEmp,0,'L'); 

            /*TRAEMOS EL NOMBRE DEL CHOFER POR EL MODELO */
            require_once("../modelos/Chofer.php");
            $chofer = new Chofer();
            $rspta = $chofer->mostrar($idchofer);
            $pdf->SetFont('Courier','',8);
            $pdf->SetXY($X+5,$Y+20);
            $pdf->MultiCell(60,5,'Chofer:   '.$rspta['nombre'],1,'L'); 
            /*FIN DEL RSPTA*/
            
            $pdf->SetXY($X+5,$Y+25);
            $pdf->MultiCell(60,5,'Semana del:    '.date('d-m-Y',strtotime($startDate)),1,'L');
            $pdf->SetXY($X+5,$Y+30);
            $pdf->MultiCell(60,5,'Al:            '.date('d-m-Y',strtotime($endDate)),1,'L');

            /*NOMBRE ARCHIVO*/
            $narchivo = 'PP'.$idempresa.'_C'.$idchofer.'_'.round(microtime(true));
            /*IMPRIMO LOS ITEMS DE PRONTOP*/
            if($idempresa == 1){
                $itemprontop = new Imprimir();
                $rsptaitem = $itemprontop->mostrarProntoPago($idchofer,$startDate,$endDate,$tablaemp);
                $rsptadctos = $itemprontop->dctosPP($idchofer,$startDate,$endDate);
                $header = array('FECHA', 'AGENCIA','TICKET','BUQUE','MONTO');
                $pdf->SetXY($X+5,$Y+40);
                $pdf->tablaTSMPP($header,$rsptaitem,$rsptadctos);
                $pdf->AliasNbPages();
                $pdf->Output('F','../vistas/reportes/pp/'.$narchivo.'.pdf',true);
                $ruta = 'vistas/reportes/pp/'.$narchivo.'.pdf';
                /*IMPRIMIR LA RUTA*/
                echo $ruta;
            }else{
                $itemprontop = new Imprimir();
                $rsptaitem = $itemprontop->mostrarProntoPago($idchofer,$startDate,$endDate,$tablaemp);
                $header = array('FECHA', 'AGENCIA','TICKET','BUQUE','MONTO');
                $pdf->SetXY($X+5,$Y+40);
                $pdf->tablaCBPP($header,$rsptaitem);
                $pdf->AliasNbPages();
                $pdf->Output('F','../vistas/reportes/pp/'.$narchivo.'.pdf',true);
                $ruta = 'vistas/reportes/pp/'.$narchivo.'.pdf';
                /*IMPRIMIR LA RUTA*/
                echo $ruta;
            }
		}
		else {
			echo "No se puede generar el reporte solicitado, faltan datos por completar";
		}
    break;

    case 'resumenProntoP':
    if ($idempresa != "" || $startDate != "" || $endDate != "" ){

        $pdf = new PDF();
        $pdf->AddPage('L');
        $X=5;
        $Y=5;
        $pdf->SetFont('Courier','B',10);
        $pdf->SetXY($X+5,$Y+13);
        switch($idempresa){
            case 1: $nombreEmp='TRANSPORT AND SERVICES MARINE, C.A'; $tablaemp='tickettsm'; break;
            case 2: $nombreEmp='CARIBBEAN OCEAN'; $tablaemp='ticketcaribe'; break;}
        $pdf->MultiCell(200,5,'RESUMEN PRONTO-PAGO POR '.$nombreEmp,0,'L'); 

        $pdf->SetXY($X+5,$Y+20);
        $pdf->MultiCell(60,5,'Semana del:    '.date('d-m-Y',strtotime($startDate)),1,'L');
        $pdf->SetXY($X+65,$Y+20);
        $pdf->MultiCell(60,5,'Hasta:         '.date('d-m-Y',strtotime($endDate)),1,'L');

        /*NOMBRE ARCHIVO*/
        $narchivo = 'RP'.$idempresa.'_'.round(microtime(true));
        
        
        /*IMPRIMO LOS RESUMEN POR EMPRESA*/
        if($idempresa == 1){
            $itemresumenp = new Imprimir();
            $rsptaitem = $itemresumenp->mostrarResumenPp($startDate,$endDate,$tablaemp);
            $rsptadctos = $itemresumenp->resumenDctosPP($startDate,$endDate);
            $header = array('NOMBRE', 'MONTO','RET ISLR','TOTAL');
            $pdf->SetXY($X+5,$Y+35);
            $pdf->tablaTSMRP($header,$rsptaitem,$rsptadctos);
            $pdf->AliasNbPages();
            $pdf->Output('F','../vistas/reportes/rp/'.$narchivo.'.pdf',true);
            $ruta = 'vistas/reportes/rp/'.$narchivo.'.pdf';
            /*IMPRIMIR LA RUTA*/
            echo $ruta;
        }
    //     /*IMPRIMO LOS ITEMS DE PRONTOP*/
    //     if($idempresa == 1){
    //         $itemprontop = new Imprimir();
    //         $rsptaitem = $itemprontop->mostrarProntoPago($idchofer,$startDate,$endDate,$tablaemp);
    //         $rsptadctos = $itemprontop->dctosPP($idchofer,$startDate,$endDate);
    //         $header = array('FECHA', 'AGENCIA','TICKET','BUQUE','MONTO');
    //         $pdf->SetXY($X+5,$Y+40);
    //         $pdf->tablaTSMPP($header,$rsptaitem,$rsptadctos);
    //         $pdf->AliasNbPages();
    //         $pdf->Output('F','../vistas/reportes/pp/'.$narchivo.'.pdf',true);
    //         $ruta = 'vistas/reportes/pp/'.$narchivo.'.pdf';
    //         /*IMPRIMIR LA RUTA*/
    //         echo $ruta;
    //     }else{
    //         $itemprontop = new Imprimir();
    //         $rsptaitem = $itemprontop->mostrarProntoPago($idchofer,$startDate,$endDate,$tablaemp);
    //         $header = array('FECHA', 'AGENCIA','TICKET','BUQUE','MONTO');
    //         $pdf->SetXY($X+5,$Y+40);
    //         $pdf->tablaCBPP($header,$rsptaitem);
    //         $pdf->AliasNbPages();
    //         $pdf->Output('F','../vistas/reportes/pp/'.$narchivo.'.pdf',true);
    //         $ruta = 'vistas/reportes/pp/'.$narchivo.'.pdf';
    //         /*IMPRIMIR LA RUTA*/
    //         echo $ruta;
    //     }
    }
    else {
        echo "No se puede generar el reporte solicitado, faltan datos por completar";
    }
    break;

    case 'mostrar':
        /*ID USUARIO SE ENVIA POR POST ESTA DECLARADO EN LA INICIALIACION*/
        $rspta = $tarifa->mostrar($idtarifa);
        echo json_encode($rspta);
    break;

    case 'eliminar':
      $rspta = $tarifa->eliminar($idtarifa);
      echo $rspta ? "Tarifa eliminada": "La tarifa no se puede eliminar";
    break;

}
