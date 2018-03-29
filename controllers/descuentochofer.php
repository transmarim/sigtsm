<?php
session_start();
require_once("../modelos/Descuentochofer.php");

$descuentochofer = new Descuentochofer();

/*INICIALIZO VARIABLES*/

$idchofer_descuento=isset($_POST['idchofer_descuento'])? limpiarCadena($_POST['idchofer_descuento']):"";

$iddescuento=isset($_POST['iddescuento'])? limpiarCadena($_POST['iddescuento']):"";

$idchofer=isset($_POST["idchofer"])? limpiarCadena($_POST["idchofer"]):"";

$montodesc=isset($_POST['montodesc'])? limpiarCadena($_POST['montodesc']):"";

$porcentaje=isset($_POST['porcentaje'])? limpiarCadena($_POST['porcentaje']):"";

$fecha=isset($_POST['fecha'])? limpiarCadena($_POST['fecha']):"";


switch ($_GET["op"]){
    case 'guardaryeditar':
		if (empty($idchofer_descuento)){
            
            if($iddescuento == 1){
                
                $fecha_array = explode("-",$fecha);
                $fechainicio = $fecha_array[0]."-".$fecha_array[1]."-01";
                $fechafin = $fecha_array[0]."-".$fecha_array[1]."-31";

                $sw = $descuentochofer->validarmes($fechainicio,$fechafin,$iddescuento,$idchofer);
                
                if($sw == 0){
                    
                $rspta=$descuentochofer->insertar($iddescuento,$idchofer,$montodesc,$porcentaje,$fecha);
                echo $rspta ? "Sustraendo registrado con exito":"No se pudo registrar el sustraendo";
                    
                }else{
                    
                echo "Este chofer ya posee un sustraendo en el mes";
                    
                }

            }else{

                $rspta=$descuentochofer->insertar($iddescuento,$idchofer,$montodesc,$porcentaje,$fecha);
                echo $rspta ? "Descuento registrado con exito":"No se pudo registrar el descuento";
                
            }
		}else{
            if($iddescuento == 1){
                
                $fecha_array = explode("-",$fecha);
                $fechainicio = $fecha_array[0]."-".$fecha_array[1]."-01";
                $fechafin = $fecha_array[0]."-".$fecha_array[1]."-31";

                $sw = $descuentochofer->validarmes($fechainicio,$fechafin,$iddescuento,$idchofer);
                
                if($sw == 0){
                    
                $rspta=$descuentochofer->editar($idchofer_descuento,$iddescuento,$idchofer,$montodesc,$porcentaje,$fecha);
			    echo $rspta ? "Descuento actualizado con exito":"No se pudieron actualizar los datos del descuento";
                    
                }else{
                    
                echo "Este chofer ya posee un sustraendo en el mes";
                    
                }

            }else{

                $rspta=$descuentochofer->editar($idchofer_descuento,$iddescuento,$idchofer,$montodesc,$porcentaje,$fecha);
			    echo $rspta ? "Descuento actualizado con exito":"No se pudieron actualizar los datos del descuento";
                
            }
		}
    break;

    case 'listar':
        $rspta = $descuentochofer->listar();
        $data = Array();
        while($reg = $rspta->fetch_object()){
           $data[]=array(
               "0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->idchofer_descuento.')"><i class="fa fa-pencil"></i></button>'.' <button class="btn btn-danger" onclick="eliminar('.$reg->idchofer_descuento.')"><i class="fa fa-trash"></i></button>',
               "1"=>$reg->nombredesc,
               "2"=>$reg->nombre,
               "3"=>($reg->porcentaje)? $reg->porcentaje.'%' : $reg->montodesc,
               "4"=>$reg->fecha
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
        $rspta = $descuentochofer->mostrar($idchofer_descuento);
        echo json_encode($rspta);
    break;

    case 'eliminar':
      $rspta = $descuentochofer->eliminar($idchofer_descuento);
      echo $rspta ? "Descuento eliminado": "El descuento no se puede eliminar";
    break;

    
    case 'listarc':
    $rspta = $descuento->listarc();
    while ($reg = $rspta->fetch_object())
        {
            echo '<option value=' .$reg->iddescuento. '>' .$reg->nombre. '</option>';
        }
    break;

}
