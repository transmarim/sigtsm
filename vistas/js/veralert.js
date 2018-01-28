var tabla;
var bandera;

function init(){
    /*USAR ESTO PARA MANDAR A VER ALERTAS POR POST*/
   $.post("controllers/alerta.php?op=verAlertlicencia",function(respuesta){
       /*CONVERTIMOS EL JSON EN UN ARREGLO*/
       var parsed = JSON.parse(respuesta);
       for (var i=0;i<parsed.length;i++){
            $("#licenciaVencida").append("<li>"+parsed[i]['nombre']+"</li>");
       }
       /*FORMA DE PASAR UN JSON A UN ARRAGLO CON PUSH DENTRO DEL FORM NO SE USO POR NO HACER FALTA 
       console.log("valores",parsed);
       var arr = [];
       for(var x in parsed){
       arr.push(parsed[x]);
       }
       for (i=0;i<arr.length;i++){
          console.log("respuesta",arr[i]);
       }
       */
   });

}

init();
