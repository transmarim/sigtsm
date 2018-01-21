var tabla;
var bandera;

function init(){
    /*USAR ESTO PARA MANDAR A VER ALERTAS POR POST*/
   $.post("controllers/alerta.php?op=verAlertlicencia",function(data,status){

       $("#licenciaVencida").html(data);
       //data = JSON.parse(data);
       /*RECORREMOS LISTADO POR VENCER*/
//       for (x=0;x<data.length;x++){
//           $("#licenciaVencida").append(data.nombre);
//       }
       
//       $("#idcliente").html(respuesta);
//       $("#idcliente").selectpicker('refresh');
   });

}

init();
