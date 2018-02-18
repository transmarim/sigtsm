function init(){
    /*VARIABLES PARA ALERTAS DE LICENCIAS*/
    var w = 0;
    var d = 0;
    /*VARIABLES PARA ALERTAS DE CEDULAS*/
    var w1 = 0;
    var d1 = 0;
    /*VARIABLES PARA ALERTAS DE CERTIFICADOS*/
    var w2 = 0;
    var d2 = 0;
    /*VARIABLES PARA ALERTAS DE SEGUROS*/
    var w3 = 0;
    var d3 = 0;
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
       mostrarAlertLicencia();
   });
    
    $.post("controllers/alerta.php?op=verAlertlicenciaV",function(respuesta){
       /*CONVERTIMOS EL JSON EN UN ARREGLO*/
       var parsed = JSON.parse(respuesta);
       for (var i=0;i<parsed.length;i++){
            $("#licenciaVencida").append("<li>"+parsed[i]['nombre']+"</li>");
           d = 1;
       }
       mostrarAlertLicencia();
   });

    function mostrarAlertLicencia(){
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
    
    /*ALERTAS DE SEGUROS*/
    
    $.post("controllers/alerta.php?op=verAlertSeguro",function(respuesta){
       /*CONVERTIMOS EL JSON EN UN ARREGLO*/
       var parsed = JSON.parse(respuesta);
       for (var i=0;i<parsed.length;i++){
            $("#seguroPorVencer").append("<li>"+parsed[i]['placa']+" - <b><span style='color:red;font-size:16px;'>"+parsed[i]['vencimiento']+"</span></b> Dias Restantes </li>");
           w3 = 1;
       }
       mostrarAlertSeguro();
   });
    
     $.post("controllers/alerta.php?op=verAlertSeguroV",function(respuesta){
       /*CONVERTIMOS EL JSON EN UN ARREGLO*/
       var parsed = JSON.parse(respuesta);
       for (var i=0;i<parsed.length;i++){
            $("#seguroVencida").append("<li>"+parsed[i]['placa']+"</li>");
           d3 = 1;
       }
       mostrarAlertSeguro();
   });
    
        function mostrarAlertSeguro(){
        if(w3 == 0 && d3 == 0){
            $("#lsuccess3").show();$("#ldanger3").hide();$("#lwarning3").hide();
        } else if (w3 == 1 && d3 == 0){
            $("#lsuccess3").hide();$("#ldanger3").hide();$("#lwarning3").show();
        } else if (w3 == 0 && d3 == 1){
            $("#lsuccess3").hide();$("#ldanger3").show();$("#lwarning3").hide();
        } else {
            $("#lsuccess3").hide();$("#ldanger3").show();$("#lwarning3").show();
        }
    }
    
    /*ALERTAS DE CERTIFICADOS*/
    
    $.post("controllers/alerta.php?op=verAlertCertificado",function(respuesta){
       /*CONVERTIMOS EL JSON EN UN ARREGLO*/
       var parsed = JSON.parse(respuesta);
       for (var i=0;i<parsed.length;i++){
            $("#certificadoPorVencer").append("<li>"+parsed[i]['nombre']+" - <b><span style='color:red;font-size:16px;'>"+parsed[i]['vencimiento']+"</span></b> Dias Restantes </li>");
           w2 = 1;
       }
       mostrarAlertCertificado();
   });
    
    $.post("controllers/alerta.php?op=verAlertCertificadoV",function(respuesta){
       /*CONVERTIMOS EL JSON EN UN ARREGLO*/
       var parsed = JSON.parse(respuesta);
       for (var i=0;i<parsed.length;i++){
            $("#certificadoVencida").append("<li>"+parsed[i]['nombre']+"</li>");
           d2 = 1;
       }
       mostrarAlertCertificado();
   });

    function mostrarAlertCertificado(){
        if(w2 == 0 && d2 == 0){
            $("#lsuccess2").show();$("#ldanger2").hide();$("#lwarning2").hide();
        } else if (w2 == 1 && d2 == 0){
            $("#lsuccess2").hide();$("#ldanger2").hide();$("#lwarning2").show();
        } else if (w2 == 0 && d2 == 1){
            $("#lsuccess2").hide();$("#ldanger2").show();$("#lwarning2").hide();
        } else {
            $("#lsuccess2").hide();$("#ldanger2").show();$("#lwarning2").show();
        }
    }
    
}


init();
