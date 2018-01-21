/*JS PARA CONTROL DE IMPRIMIR, COLOCAR BOTONES EN EL MEDIO PARA QUE NO SE VEAN TODAS LAS OPCIONES Y USAR UN SHOW Y HIDE PARA QUE TODO ESTA FINO*/
var tabla;
var bandera;

function init(){
    mostrarform(false,0);
    
    /*USAR ESTO PARA MANDAR A IMPRIMIR POR POST*/
//    $.post("controllers/cliente.php?op=listarc",function(respuesta){
//    $("#idcliente").html(respuesta);
//    $("#idcliente").selectpicker('refresh');
//    });

     $("#formulario").on("submit",function(e){
       guardaryeditar(e);
    });
    
}

function limpiar(){
    $("#idtickettsm").val("");
    $("#codigo").val("");
    $("#fecha").val("");
    $("#montop").val("");
    $("#montoret").val("");
    $("#montoc").val("");
    $("#descripcion").val("");
    $("#idcentro").selectpicker("val","");
    /*QUITAR CLASES A LOS ELEMENTOS*/
    $(".form-group").removeClass('has-success has-error');
}

function mostrarform(flag,valor){
    limpiar();
    if(flag){
        $(".reportes").hide();
        $("#cuadro"+valor).show('fast');
        
    }else{
        $(".reportes").hide();
        $("#btnagregar").show();
    }
}

function cancelarform(){
    mostrarform(false);
    limpiar();
}


init();
