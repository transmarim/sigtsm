<?php
require_once("conexion.php");

class Imprimir{
    function __construct(){
        
    }
    
    public static function mostrarProntoPago($idchofer,$startDate,$endDate,$tablaemp){
        $sql = "SELECT T2.nombre, T1.codigo, T1.fecha, T1.montop, T1.montoret, T3.nombre AS nombrec FROM $tablaemp AS T1 LEFT JOIN cliente AS T2 ON T2.idcliente = T1.idcliente LEFT JOIN centro AS T3 ON T3.idcentro = T1.idcentro WHERE T1.condicion = 1 AND T1.fechapago BETWEEN '$startDate' AND '$endDate' AND T1.idchofer = $idchofer";
        $sw = true;
        Consulta($sql) or $sw = false;
        if($sw != false ){
            return Consulta($sql);
        } else {
            return $sw;
        }
    }
    
    public static function dctosPP($idchofer,$startDate,$endDate){
        $sql = "SELECT T2.nombre, T1.iddescuento, T1.montodesc, T1.porcentaje FROM chofer_descuento AS T1 LEFT JOIN descuento AS T2 ON T2.iddescuento = T1.iddescuento WHERE T1.idchofer = $idchofer AND T1.fecha BETWEEN '$startDate' AND '$endDate' ORDER BY T1.iddescuento DESC";
        return Consulta($sql);
    }
        
    public static function mostrarResumenPp($startDate,$endDate,$tablaemp){
        $sql = "SELECT T1.idchofer, T2.nombre, SUM(T1.montop) AS monto, SUM(T1.montoret) AS ret FROM $tablaemp AS T1 LEFT JOIN chofer AS T2 ON T2.idchofer = T1.idchofer WHERE T1.condicion=1 AND T1.fechapago BETWEEN '$startDate' AND '$endDate' GROUP BY T1.idchofer";
        $sw = true;
        Consulta($sql) or $sw = false;
        if($sw != false ){
            return Consulta($sql);
        } else {
            return $sw;
        }
    }
    
    public static function resumenDctosPP($startDate,$endDate){
        $sql = "SELECT idchofer, SUM(montodesc) AS montodesc FROM chofer_descuento WHERE fecha BETWEEN '$startDate' AND '$endDate' GROUP BY idchofer";
        return ConsultaFila($sql);
    }
    
    public static function listar(){
        $sql = "SELECT * FROM cliente";
        return Consulta($sql);
    }
    
     public static function listarc(){
        $sql = "SELECT idcliente, nombre FROM cliente WHERE condicion=1";
        return Consulta($sql);
    }
    
}
