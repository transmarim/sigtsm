<?php
require_once("../modelos/Imprimir.php");
require_once("fpdf/fpdf.php");
require_once("fpdf/config.php");

/*INICIALIZO VARIABLES*/

$idchofer=isset($_POST['idchofer'])? limpiarCadena($_POST['idchofer']):"";

$idempresa=isset($_POST["idempresa"])? limpiarCadena($_POST["idempresa"]):"";

$startDate=isset($_POST["startDate"])? limpiarCadena($_POST["startDate"]):"";

$endDate=isset($_POST["endDate"])? limpiarCadena($_POST["endDate"]):"";

$idtalonario=isset($_POST["idtalonario"])? limpiarCadena($_POST["idtalonario"]):"";

$ticket=isset($_POST["ticket"])? limpiarCadena($_POST["ticket"]):"";

$idcliente=isset($_POST['idcliente'])? limpiarCadena($_POST['idcliente']):"";

switch ($_GET["op"]){
    case 'reporteProntoP':
		if ($idchofer != "" || $idempresa != "" || $startDate != "" || $endDate != ""){

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
            $header = array('NOMBRE', 'MONTO','RET ISLR','TOTAL');
            $pdf->SetXY($X+5,$Y+35);
            $pdf->tablaTSMRP($header,$rsptaitem,$startDate,$endDate);
            $pdf->AliasNbPages();
            $pdf->Output('F','../vistas/reportes/rp/'.$narchivo.'.pdf',true);
            $ruta = 'vistas/reportes/rp/'.$narchivo.'.pdf';
            /*IMPRIMIR LA RUTA*/
            echo $ruta;
        } else{
            $itemresumenp = new Imprimir();
            $rsptaitem = $itemresumenp->mostrarResumenPp($startDate,$endDate,$tablaemp);
            $header = array('NOMBRE', 'MONTO','DESCUENTOS','TOTAL');
            $pdf->SetXY($X+5,$Y+35);
            $pdf->tablaCARIBRP($header,$rsptaitem,$startDate,$endDate);
            $pdf->AliasNbPages();
            $pdf->Output('F','../vistas/reportes/rp/'.$narchivo.'.pdf',true);
            $ruta = 'vistas/reportes/rp/'.$narchivo.'.pdf';
            /*IMPRIMIR LA RUTA*/
            echo $ruta;
        }
    }
    else {
        echo "No se puede generar el reporte solicitado, faltan datos por completar";
    }
    break;

    case 'reporteTalonario':
        /*ID USUARIO SE ENVIA POR POST ESTA DECLARADO EN LA INICIALIACION*/
        if ($idtalonario != ""){
            $pdf = new PDF();
            $pdf->AddPage();
            $X=5;
            $Y=5;
            $pdf->SetFont('Courier','B',12);
            $pdf->SetXY($X+5,$Y+20);
            $pdf->MultiCell(200,5,'CONSTANCIA DE ENTREGA DE TALONARIO',0,'C');
            $talonario = new Imprimir();
            $rsptaitem = $talonario->mostrarTalonario($idtalonario);
            $pdf->SetXY($X+5,$Y+35);
            $pdf->SetFont('Courier','',11);
            $pdf->MultiCell(185,5,"Mediante la presente, se hace constar que el dia ".date('d-m-Y',strtotime($rsptaitem['fecha']))." se entrega de manera formal el Talonario correspondiente a la serie: ".$rsptaitem['desde']."-".$rsptaitem["hasta"].", Al Chofer o Proveedor ".$rsptaitem['nombre']." portador de la C.I: ".$rsptaitem['cedula'].", quien acepta bajo este documento, las politicas internas para el uso del o los talonarios las cuales se expresan a continuacion:",0,'L');
            $pdf->SetFont('Courier','B',10);
            $pdf->SetXY($X+5,$Y+65);
            $pdf->Cell(10,4,'Politicas de uso del talonario:');
            $pdf->SetXY($X+20,$Y+130);
            $pdf->Cell(10,4,'__________________________');
            $pdf->SetXY($X+20,$Y+135);
            $pdf->Cell(10,4,'     Recibe Conforme      ');
            $pdf->SetXY($X+120,$Y+130);
            $pdf->Cell(10,4,'__________________________');
            $pdf->SetXY($X+120,$Y+135);
            $pdf->Cell(10,4,'          Entrega         ');

            /*NOMBRE ARCHIVO*/
            $narchivo = 'RT_'.round(microtime(true));
            
            $pdf->AliasNbPages();
            $pdf->Output('F','../vistas/reportes/rt/'.$narchivo.'.pdf',true);
            $ruta = 'vistas/reportes/rt/'.$narchivo.'.pdf';
            echo $ruta;
            
        }
        else {
            echo "No se puede generar el reporte solicitado, faltan datos por completar";
        }
    break;

    case 'reporteTalonarioC':
    /*ID USUARIO SE ENVIA POR POST ESTA DECLARADO EN LA INICIALIACION*/
    if ($idtalonario != ""){
        $pdf = new PDF();
        $pdf->AddPage();
        $X=5;
        $Y=5;
        $pdf->SetFont('Courier','B',12);
        $pdf->SetXY($X+5,$Y+20);
        $pdf->MultiCell(200,5,'CONSTANCIA DE ENTREGA DE TALONARIO',0,'C');
        $talonario = new Imprimir();
        $rsptaitem = $talonario->mostrarTalonarioC($idtalonario);
        $pdf->SetXY($X+5,$Y+35);
        $pdf->SetFont('Courier','',11);
        $pdf->MultiCell(185,5,"Mediante la presente, se hace constar que el dia ".date('d-m-Y',strtotime($rsptaitem['fecha']))." se entrega de manera formal el Talonario correspondiente a la serie: ".$rsptaitem['desde']."-".$rsptaitem["hasta"].", Al Chofer o Proveedor ".$rsptaitem['nombre']." portador de la C.I: ".$rsptaitem['cedula'].", quien acepta bajo este documento, las politicas internas para el uso del o los talonarios las cuales se expresan a continuacion:",0,'L');
        $pdf->SetFont('Courier','B',10);
        $pdf->SetXY($X+5,$Y+65);
        $pdf->Cell(10,4,'Politicas de uso del talonario:');
        $pdf->SetXY($X+20,$Y+130);
        $pdf->Cell(10,4,'__________________________');
        $pdf->SetXY($X+20,$Y+135);
        $pdf->Cell(10,4,'     Recibe Conforme      ');
        $pdf->SetXY($X+120,$Y+130);
        $pdf->Cell(10,4,'__________________________');
        $pdf->SetXY($X+120,$Y+135);
        $pdf->Cell(10,4,'          Entrega         ');

        /*NOMBRE ARCHIVO*/
        $narchivo = 'RTC_'.round(microtime(true));
        $pdf->AliasNbPages();
        $pdf->Output('F','../vistas/reportes/rt/'.$narchivo.'.pdf',true);
        $ruta = 'vistas/reportes/rt/'.$narchivo.'.pdf';
        echo $ruta;
    }
    else {
        echo "No se puede generar el reporte solicitado, faltan datos por completar";
    }
break;

case 'detalleTicket':
if ($idempresa != "" || $ticket != ""){

    $pdf = new PDF();
    $pdf->AddPage('L');
    $X=5;
    $Y=5;
    $pdf->SetFont('Courier','B',10);
    $pdf->SetXY($X+5,$Y+13);
    switch($idempresa){
        case 1: $nombreEmp='TRANSPORT AND SERVICES MARINE, C.A'; $tablaemp='tickettsm'; break;
        case 2: $nombreEmp='CARIBBEAN OCEAN'; $tablaemp='ticketcaribe'; break;}
    $pdf->MultiCell(200,5,'DETALLE DEL TICKET '.$ticket.' POR '.$nombreEmp,0,'L'); 

    /*NOMBRE ARCHIVO*/
    $narchivo = 'DT'.$idempresa.'_'.round(microtime(true));
    
    
    /*IMPRIMO LOS TICKET POR EMPRESA*/
    if($idempresa == 1){
        $detalleT = new Imprimir();
        $rsptaDetalle = $detalleT->detalleTicket($ticket,$tablaemp);
        $header = array('FECHA', 'CHOFER','CENTRO','DESCRIPCION','CLIENTE','MONTO.P','PAGADO');
        $pdf->SetXY($X+5,$Y+35);
        $pdf->tablaDetalleT($header,$rsptaDetalle);
        $pdf->AliasNbPages();
        $pdf->Output('F','../vistas/reportes/dt/'.$narchivo.'.pdf',true);
        $ruta = 'vistas/reportes/dt/'.$narchivo.'.pdf';
        /*IMPRIMIR LA RUTA*/
        echo $ruta;
    } else{
        $detalleT = new Imprimir();
        $rsptaDetalle = $detalleT->detalleTicket($ticket,$tablaemp);
        $header = array('FECHA', 'CHOFER','CENTRO','DESCRIPCION','CLIENTE','MONTO.P','PAGADO');
        $pdf->SetXY($X+5,$Y+35);
        $pdf->tablaDetalleT($header,$rsptaDetalle);
        $pdf->AliasNbPages();
        $pdf->Output('F','../vistas/reportes/dt/'.$narchivo.'.pdf',true);
        $ruta = 'vistas/reportes/dt/'.$narchivo.'.pdf';
        /*IMPRIMIR LA RUTA*/
        echo $ruta;
    }
}
else {
    echo "No se puede generar el reporte solicitado, faltan datos por completar";
}
break;

case 'SxCliente':
if ($idcliente != "" || $startDate != "" || $endDate != ""){

    $pdf = new PDF();
    $pdf->AddPage();
    $X=5;
    $Y=5;
    $pdf->SetFont('Courier','B',10);
    $pdf->SetXY($X+5,$Y+13);
    
    /*TRAEMOS EL NOMBRE DEL CLIENTE POR EL MODELO */
    require_once("../modelos/Cliente.php");
    $cliente = new Cliente();
    $rspta = $cliente->mostrar($idcliente);    
    $pdf->MultiCell(200,5,'DETALLE DE SERVICIOS PRESTADOS AL CLIENTE '.$rspta['nombre'],0,'L'); 

    /*NOMBRE ARCHIVO*/
    $narchivo = 'SXC'.$idcliente.'_'.round(microtime(true));
    
    /*IMPRIMO LOS TICKET POR EMPRESA*/
        $detalleT = new Imprimir();
        $rsptaDetalle = $detalleT->detalleTicket($ticket,$tablaemp);
        $header = array('FECHA', 'CHOFER','CENTRO','DESCRIPCION','CLIENTE','MONTO.P','PAGADO');
        $pdf->SetXY($X+5,$Y+35);
        $pdf->tablaDetalleT($header,$rsptaDetalle);
        $pdf->AliasNbPages();
        $pdf->Output('F','../vistas/reportes/sxc/'.$narchivo.'.pdf',true);
        $ruta = 'vistas/reportes/sxc/'.$narchivo.'.pdf';
        /*IMPRIMIR LA RUTA*/
        echo $ruta;
}
else {
    echo "No se puede generar el reporte solicitado, faltan datos por completar";
}
break;

    case 'eliminar':
      $rspta = $tarifa->eliminar($idtarifa);
      echo $rspta ? "Tarifa eliminada": "La tarifa no se puede eliminar";
    break;

}
