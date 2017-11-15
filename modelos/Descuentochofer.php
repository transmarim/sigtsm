<?php
require_once("conexion.php");

class Descuentochofer{
    function __construct(){
        
    }
    public static function insertar($iddescuento,$idchofer,$montodesc,$porcentaje,$fecha){
        $sql = "INSERT INTO chofer_descuento (iddescuento,idchofer,montodesc,porcentaje,fecha) VALUES ('$iddescuento','$idchofer','$montodesc','$porcentaje','$fecha')";
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
        $sql = "SELECT * FROM chofer_descuento";
        return Consulta($sql);
    }
    
     public static function validarmes($fechainicio,$fechafin,$iddescuento,$idchofer){
         $sql = "SELECT idchofer_descuento FROM chofer_descuento WHERE idchofer='$idchofer' AND iddescuento='$iddescuento' AND fecha BETWEEN '$fechainicio' AND '$fechafin'";
         return Consulta_num($sql);
    }
    
}
