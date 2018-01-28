
function init(){
    var w = 0;
    var d = 0;
    /*USAR ESTO PARA MANDAR A VER ALERTAS POR POST*/
   $.post("controllers/alerta.php?op=verAlertlicencia",function(respuesta){
       /*CONVERTIMOS EL JSON EN UN ARREGLO*/
       var parsed = JSON.parse(respuesta);
       for (var i=0;i<parsed.length;i++){
            $("#licenciaPorVencer").append("<li>"+parsed[i]['nombre']+" - <b><span style='color:red;font-size:16px;'>"+parsed[i]['vencimiento']+"</span></b> Dias Restantes </li>");
           w = 1;
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
       mostrarAlert();
   });
    
    $.post("controllers/alerta.php?op=verAlertlicenciaV",function(respuesta){
       /*CONVERTIMOS EL JSON EN UN ARREGLO*/
       var parsed = JSON.parse(respuesta);
       for (var i=0;i<parsed.length;i++){
            $("#licenciaVencida").append("<li>"+parsed[i]['nombre']+"</li>");
           d = 1;
       }
       mostrarAlert();
   });

    function mostrarAlert(){
        if(w == 0 && d == 0){
            $("#lsuccess").show();$("#ldanger").hide();$("#lwarning").hide();
        } else if (w == 1 && d == 0){
            $("#lsuccess").hide();$("#ldanger").hide();$("#lwarning").show();
        } else if (w == 0 && d == 1){
            $("#lsuccess").hide();$("#ldanger").show();$("#lwarning").hide();
        } else {
            $("#lsuccess").hide();$("#ldanger").show();$("#lwarning").show();
        }
    }
}


init();
