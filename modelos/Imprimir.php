<?php
require_once("conexion.php");

class Imprimir{
    function __construct(){
        
    }
    
    public static function mostrarProntoPago($idchofer,$startDate,$endDate){
        $sql = "SELECT T2.nombre, T1.codigo, T1.fecha, T1.montop, T1.montoret, T3.nombre AS nombrec FROM tickettsm AS T1 LEFT JOIN cliente AS T2 ON T2.idcliente = T1.idcliente LEFT JOIN centro AS T3 ON T3.idcentro = T1.idcentro WHERE T1.condicion = 1 AND T1.fechapago BETWEEN '$startDate' AND '$endDate' AND T1.idchofer = $idchofer";
        return Consulta($sql);
    }
    
    public static function editar($idcliente,$nombre,$codigo,$tipo_documento,$direccion,$telefono,$email){
        $sql = "UPDATE cliente SET nombre='$nombre',codigo='$codigo',tipo_documento='$tipo_documento',direccion='$direccion',telefono='$telefono',email='$email' WHERE idcliente = '$idcliente'";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }
    
    public static function desactivar($idcliente){
        $sql = "UPDATE cliente SET condicion='0' WHERE idcliente='$idcliente'";
        return Consulta($sql);
    }
    
    public static function activar($idcliente){
        $sql = "UPDATE cliente SET condicion='1' WHERE idcliente='$idcliente'";
        return Consulta($sql);
    }
    
    public static function mostrar($idcliente){
        $sql = "SELECT * FROM cliente WHERE idcliente='$idcliente'";
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
