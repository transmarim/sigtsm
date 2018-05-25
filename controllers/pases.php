<?php
session_start();
require_once("../modelos/Pases.php");
require_once("../modelos/Imprimir.php");
require_once("fpdf/fpdf.php");
require_once("fpdf/config-nh.php");

$pases = new Pases();

/*INICIALIZO VARIABLES*/

$tipo_pase=isset($_POST['tipo_pase'])? limpiarCadena($_POST['tipo_pase']):"";

$startDate=isset($_POST["startDate"])? limpiarCadena($_POST["startDate"]):"";

$endDate=isset($_POST["endDate"])? limpiarCadena($_POST["endDate"]):"";

// $choferes=isset($_POST['choferes'])? limpiarCadena($_POST['choferes']):"";

switch ($_GET["op"]){
    case 'guardaryeditar':
		if ($tipo_pase != "" || $startDate != "" || $endDate != "" ){
            $pdf = new PDF();
            $pdf->AddPage();
            $X=5;
            $Y=5;
            $pdf->SetFont('Arial','',11);
            
            switch($tipo_pase){
                case 1: $nombreEmp='INTT'; break;
                case 2: $nombreEmp='Gerencia de Prevención y Control de Pérdidas'; break;}

            $pdf->SetXY($X+90,$Y+20);
            $pdf->Cell(100,5,'Puerto La Cruz - '.utf8_decode($pdf->obFecha($startDate)),0,0,'R');
            $pdf->SetXY($X+90,$Y+25);
            $pdf->Cell(100,5,utf8_decode('Señores:'),0,0,'R');
            $pdf->SetFont('Arial','B',11);
            $pdf->SetXY($X+90,$Y+30);
            $pdf->Cell(100,5,utf8_decode($nombreEmp),0,0,'R');
            $pdf->SetXY($X+90,$Y+35);
            $pdf->SetFont('Arial','',11);
            $pdf->Cell(100,5,utf8_decode('Departamento de P.B.I.P'),0,0,'R');
            $pdf->SetXY($X+90,$Y+40);
            $pdf->Cell(100,5,utf8_decode('Cc:  Sr. Juan Ivimas (Oficial de P.B.I.P).'),0,0,'R');
            $pdf->SetXY($X+15,$Y+55);
            $pdf->MultiCell(175,5,utf8_decode("Mediante la presente nos dirigimos a usted para solicitarle su autorización para el ingreso provisional de nuestro personal y unidades a las instalaciones del Terminal Marino de PVDSA JOSE, con la única finalidad de prestar el Servicio de Transporte de Personal de las Agencias Navieras a las cuales prestamos nuestros servicios tales como Seaport, Navieramar, Poseidon, entre otros. Este servicio se prestará en horario diurno, nocturno, feriados y fines de semana. Siempre y cuando tengamos buques en operaciones en sus muelles."),0,'J');
            $pdf->SetXY($X+15,$Y+85);
            $pdf->SetFont('Arial','B',11);
            $pdf->Cell(100,5,utf8_decode('Desde el '.date("d/m/Y",strtotime($startDate)).' Al '.date("d/m/Y",strtotime($startDate))),0,0,'L');
            $header = array('NOMBRE / APELLIDO', 'C.I','VEHICULO','COLOR','PLACA', 'TLF');
            $pdf->Ln(10);
            $pdf->SetX($X+15);
            //IMPRIMO HEADER DE LA TABLA DEBIDO A REGISTROS INDIVIDUALES
            // Anchuras de las columnas
            $w = array(35, 25, 35, 25, 27, 27);
            //Cabeceras
            $pdf->SetFont('Courier','B',8);
            for($i=0;$i<count($header);$i++)
                $pdf->Cell($w[$i],7,$header[$i],1,0,'C');
            $pdf->Ln();
            $pdf->SetFont('Courier','',8);
            //RECORRO LOS CHOFERES MARCADOS
            $choferes = $_POST['choferes'];
            $num = 0;
            while($num < count($choferes)){
                $rspta = $pases->mostrarChofer($choferes[$num]);
                $pdf->SetX($X+15);
                $pdf->tablaChoferes($rspta);
                $num = $num + 1;
            }
       
            $pdf->AliasNbPages();
            $narchivo = 'PASE_'.round(microtime(true));
            $pdf->Output('F','../vistas/reportes/pf/'.$narchivo.'.pdf',true);
            $ruta = 'vistas/reportes/pf/'.$narchivo.'.pdf';
            echo $ruta;
		}
		else {
			echo "Error faltan datos basicos";
		}
    break;

    case 'chofer':
        $rspta = $pases->listarChofer();
        while ($reg = $rspta->fetch_object())
        {
            echo '<li> <input type="checkbox" name="choferes[]" value="'.$reg->idchofer.'"> '.$reg->nombre.'</li>';
        }
    break;

}
