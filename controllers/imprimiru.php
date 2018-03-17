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
		if (!empty($idchofer) || !empty($idempresa) || !empty($startDate) || !empty($endDate)){

            $pdf = new PDF();
            $pdf->AddPage();
            $X=5;
		    $Y=5;

            // // Títulos de las columnas
            // $header = array('País', 'Capital', 'Superficie (km2)', 'Pobl. (en miles)');
            // // Carga de datos
            // $data = $pdf->LoadData('paises.txt');
            // $pdf->SetFont('Arial','',14);
            // $pdf->AddPage();
            // $pdf->BasicTable($header,$data);
            // $pdf->AddPage();
            // $pdf->ImprovedTable($header,$data);
            // $pdf->AddPage();
            // $pdf->Output();
            $pdf->SetFont('Courier','B',10);
            $pdf->SetXY($X+5,$Y+13);
            $pdf->MultiCell(200,5,'RELACION DE SERVICIOS POR TRANSPORT AND SERVICES MARINE, C.A',0,'L'); 

            $pdf->SetFont('Courier','',8);
            $pdf->SetXY($X+5,$Y+20);
            $pdf->MultiCell(60,5,'Chofer:   '.$idchofer,1,'L');
            $pdf->SetXY($X+5,$Y+25);
            $pdf->MultiCell(60,5,'Semana del:    '.date('d-m-Y',strtotime($startDate)),1,'L');
            $pdf->SetXY($X+5,$Y+30);
            $pdf->MultiCell(60,5,'Al:            '.date('d-m-Y',strtotime($endDate)),1,'L');

            $pdf->AliasNbPages();
            $pdf->Output('F','../vistas/reportes/doc.pdf',true);
            $ruta = 'vistas/reportes/doc.pdf';
            echo $ruta;
		}
		else {
			echo "No se puede generar el reporte solicitado, faltan datos por completar";
		}
    break;

    case 'listar':
        $rspta = $tarifa->listar();
        $data = Array();
        while($reg = $rspta->fetch_object()){
           $data[]=array(
 				"0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->idtarifa.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="eliminar('.$reg->idtarifa.')"><i class="fa fa-trash"></i></button>',
 				"1"=>$reg->nombre,
 				"2"=>$reg->montotsmp,
 				"3"=>$reg->montotsmc,
 				"4"=>$reg->montocaribec
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
        $rspta = $tarifa->mostrar($idtarifa);
        echo json_encode($rspta);
    break;

    case 'eliminar':
      $rspta = $tarifa->eliminar($idtarifa);
      echo $rspta ? "Tarifa eliminada": "La tarifa no se puede eliminar";
    break;

}
