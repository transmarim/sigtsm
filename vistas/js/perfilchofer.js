
function init(){
    mostrarform(false);
}

function mostrarform(flag){
    if(flag){
        $("#formulario").show('fast');
        
    }else{
        $("#formulario").hide();
    }
}

function mostrar(idchofer){
    mostrarform(true);
     $.post("controllers/chofer.php?op=mostrar",{idchofer:idchofer},function(data,status){
          /*Convertir la cadena enviada desde PHP a un vector de objetos en JavaScript*/
         data = JSON.parse(data);
 
         $.post("controllers/vehiculo.php?op=mostrar",{idvehiculo:data.idvehiculo},function(dato,status){
            dato = JSON.parse(dato);
            $("#vehiculo").attr("href","vistas/img/vehiculos/"+dato.imagen);
            });
         
         $.post("controllers/certificado.php?op=mostrar",{idcertificado:data.idcertificado},function(dato2,status){
            dato2 = JSON.parse(dato2);
            $("#certificado").attr("href","vistas/img/certificados/"+dato2.imagen);
            });

        $.post("controllers/licencia.php?op=mostrar",{idlicencia:data.idlicencia},function(dato3,status){
            dato3 = JSON.parse(dato3);
            $("#licencia").attr("href","vistas/img/licencias/"+dato3.imagen);
            });

         /*MODIFICAR SELECT*/
         $("#cedula").val(data.cedula);
         $("#telefono").val(data.telefono);
         $("#fechanac").val(data.fechanac);
         $("#email").val(data.email);
         /*MOSTRAMOS IMG DE MUESTRA*/
         $("#imagenmuestra").show();
         $("#imagenmuestra").attr("src","vistas/img/choferes/"+data.imagen);
         $("#imagenactual").val(data.imagen);
     });
    }


init();
