<?php
class EnlacesModels{

  public function __construct() { }

  public static function enlacesModels($enlaces){
    if($enlaces == "escritorio" ||
       $enlaces == "perfilchofer" ||
       $enlaces == "datosvc" ||
       $enlaces == "panel" ||
       $enlaces == "tickettsm" ||
       $enlaces == "ticketcarib" ||
       $enlaces == "cliente" ||
       $enlaces == "centro" ||
       $enlaces == "chofer" ||
       $enlaces == "licencia" ||
       $enlaces == "certificado" ||
       $enlaces == "descuentochofer" ||
       $enlaces == "seguro" ||
       $enlaces == "vehiculo" ||
       $enlaces == "descuento" ||
       $enlaces == "usuario" ||
       $enlaces == "imprimiru" ||
       $enlaces == "veralert" ||
       $enlaces == "pagoticket" ||
       $enlaces == "enviaralert" ||
       $enlaces == "imprimirc"){
       /*MODULO A CARGAR SERA*/
       $module = "vistas/modulos/".$enlaces.".php";
  } else if($enlaces == "index"){
      $module = "vistas/modulos/escritorio.php";
  } else if($enlaces == "admin"){
      $module = "admin/";
  } else {
    $module = "vistas/modulos/inicio.php";
  }
  return $module;
  }
}
