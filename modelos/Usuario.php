<?php
require_once("conexion.php");

class Usuario{
    function __construct(){
        
    }
    public static function insertar($idchofer,$nombre,$login,$clave,$email,$imagen,$permisos){
        $sql = "INSERT INTO usuario (idchofer,nombre,login,clave,email,imagen,condicion) VALUES ('$idchofer','$nombre','$login','$clave','$email','$imagen',1)";
        
        $idusuarionew = Consulta_retornarID($sql);
        $num_elementos = 0;
        $sw = true;
        
        while($num_elementos < count($permisos) ){
            $sql_detalle = "INSERT INTO usuario_permiso(idusuario,idpermiso) VALUES ('$idusuarionew','$permisos[$num_elementos]')";
            Consulta($sql_detalle) or $sw = false;
            $num_elementos = $num_elementos+1;
        }
        return $sw;
    }
    
    public static function editar($idusuario,$idchofer,$nombre,$login,$clave,$email,$imagen,$permisos){
        $sql = "UPDATE usuario SET idchofer='$idchofer',nombre='$nombre',login='$login',clave='$clave',email='$email',imagen='$imagen' WHERE idusuario = '$idusuario'";
        Consulta($sql);
        /*ELIMINAMOS LOS PERMISOS ACTUALES*/
        
        $sqldel = "DELETE FROM usuario_permiso WHERE idusuario='$idusuario'";
        Consulta($sql);
        
        $num_elementos = 0;
        $sw = true;
        
        while($num_elementos < count($permisos) ){
            $sql_detalle = "INSERT INTO usuario_permiso (idusuario,idpermiso) VALUES ('$idusuarionew','$permisos[$num_elementos]')";
            Consulta($sql_detalle) or $sw = false;
            $num_elementos = $num_elementos+1;
        }
        return $sw;
    }
    
    public static function desactivar($idusuario){
        $sql = "UPDATE usuario SET condicion='0' WHERE idusuario='$idusuario'";
        return Consulta($sql);
    }
    
    public static function activar($idusuario){
        $sql = "UPDATE usuario SET condicion='1' WHERE idusuario='$idusuario'";
        return Consulta($sql);
    }
    
    public static function mostrar($idsuario){
        $sql = "SELECT * FROM usuario WHERE idusuario='$idusuario'";
        return ConsultaFila($sql);
    }
    public static function listar(){
        $sql = "SELECT * FROM usuario";
        return Consulta($sql);
    }
    public static function listarmarcados($idusuario){
        $sql = "SELECT * FROM usuario_permiso WHERE idusuario ='$idusuario'";
        return Consulta($sql);
    }
    public static function verificar($login,$clave){
        $sql = "SELECT idusuario,nombre,login,clave,email,imagen FROM usuario WHERE login='$login' AND clave='$clave' AND condicion='1'";
        return Consulta($sql);
    }
    
}
