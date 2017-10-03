<?php
session_start();
require_once("../modelos/Usuario.php");

$usuario = new Usuario();

/*INICIALIZO VARIABLES*/
$idusuario=isset($_POST['idusuario'])? limpiarCadena($_POST['idusuario']):"";

$idchofer=isset($_POST['idchofer'])? limpiarCadena($_POST['idchofer']):"";

$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";

$login=isset($_POST["login"])? limpiarCadena($_POST["login"]):"";

$clave=isset($_POST["clave"])? limpiarCadena($_POST["clave"]):"";

$email=isset($_POST["email"])? limpiarCadena($_POST["email"]):"";

$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";

switch ($_GET["op"]){
    case 'guardaryeditar':
    if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name']))
		{
			$imagen=$_POST["imagenactual"];
		}
		else 
		{
			$ext = explode(".", $_FILES["imagen"]["name"]);
			if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png")
			{
				$imagen = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../vistas/img/usuarios/". $imagen);
			}
		}
		//Hash SHA256 en la contrasena
		$clavehash=hash("SHA256",$clave);

		if (empty($idusuario)){
            $rspta=$usuario->insertar($idchofer,$nombre,$login,$clave,$email,$imagen,$_POST['permiso']); 
            echo $rspta ? "Usuario registrado con exito":"No se pudieron registrar todos los datos del usuario";
		}
		else {
            $rspta=$usuario->editar($idusuario,$idchofer,$nombre,$login,$clave,$email,$imagen,$_POST['permiso']);
			echo $rspta ? "Usuario actualizado con exito":"No se pudieron registrar todos los datos del usuario";
		}
    break;
    case 'listar':
    
    break;
        
    case 'permisos':
        /*Obtenemos todos los permisos de la tabla permisos*/
		require_once "../modelos/Permiso.php";
		$permiso = new Permiso();
		$rspta = $permiso->listar();

		//Obtener los permisos asignados al usuario
		$id=$_GET['id'];
		$marcados = $usuario->listarmarcados($id);
		//Declaramos el array para almacenar todos los permisos marcados
		$valores=array();

		//Almacenar los permisos asignados al usuario en el array
		while ($per = $marcados->fetch_object())
			{
				array_push($valores, $per->idpermiso);
			}

		//Mostramos la lista de permisos en la vista y si estan o no marcados
		while ($reg = $rspta->fetch_object())
				{
					$sw=in_array($reg->idpermiso,$valores)?'checked':'';
					echo '<li> <input type="checkbox" '.$sw.'  name="permiso[]" value="'.$reg->idpermiso.'"> '.$reg->nombre.'</li>';
				}
    break;    
}