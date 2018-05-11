<?php
require_once("conexion.php");

class Descuentochofer{
    function __construct(){
        
    }
    public static function insertar($iddescuento,$idchofer,$montodesc,$porcentaje,$fecha){
        $sql = "INSERT INTO chofer_descuento (iddescuento,idchofer,montodesc,porcentaje,estado,fecha) VALUES ('$iddescuento','$idchofer','$montodesc','$porcentaje',0,'$fecha')";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }
    
    public static function editar($idchofer_descuento,$iddescuento,$idchofer,$montodesc,$porcentaje,$fecha){
        $sql = "UPDATE chofer_descuento SET iddescuento='$iddescuento', idchofer='$idchofer', montodesc='$montodesc', porcentaje='$porcentaje', fecha='$fecha' WHERE idchofer_descuento = '$idchofer_descuento'";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }
    
    public static function mostrar($idchofer_descuento){
        $sql = "SELECT * FROM chofer_descuento WHERE idchofer_descuento='$idchofer_descuento'";
        return ConsultaFila($sql);
    }
    
    public static function listar(){
        $sql = "SELECT T1.idchofer_descuento, T3.nombre AS nombredesc, T2.nombre, T1.montodesc, T1.porcentaje, T1.fecha FROM chofer_descuento AS T1 LEFT JOIN chofer AS T2 ON T1.idchofer = T2.idchofer LEFT JOIN descuento AS T3 ON T3.iddescuento = T1.iddescuento WHERE T1.estado=0";
        return Consulta($sql);
    }
    
     public static function validarmes($fechainicio,$fechafin,$iddescuento,$idchofer){
         $sql = "SELECT idchofer_descuento FROM chofer_descuento WHERE idchofer='$idchofer' AND iddescuento='$iddescuento' AND fecha BETWEEN '$fechainicio' AND '$fechafin'";
         return Consulta_num($sql);
    }
    
    public static function eliminar($idchofer_descuento){
        $sql = "DELETE FROM chofer_descuento WHERE idchofer_descuento='$idchofer_descuento'";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }
    
}
