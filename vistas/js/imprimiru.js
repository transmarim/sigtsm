/*JS PARA CONTROL DE IMPRIMIR, COLOCAR BOTONES EN EL MEDIO PARA QUE NO SE VEAN TODAS LAS OPCIONES Y USAR UN SHOW Y HIDE PARA QUE TODO ESTA FINO*/
var tabla;
var bandera;

function init(){
/*TRAEMOS LOS CHOFERES POR POST*/
    $.post("controllers/chofer.php?op=selectc",function(respuesta){
        $("#idchofer").html(respuesta);
        $("#idchofer").selectpicker('refresh');
        });

    mostrarform(false,0);
    
    /*USAR ESTO PARA MANDAR A IMPRIMIR POR POST*/
//    $.post("controllers/cliente.php?op=listarc",function(respuesta){
//    $("#idcliente").html(respuesta);
//    $("#idcliente").selectpicker('refresh');
//    });

     $("#formulario1").on("submit",function(e){
        e.preventDefault();
        var formData = new FormData($("#formulario")[0]);
        /*var chofer = $("#idchofer").val();
        var empresa = $("#idempresa").val();*/
        var startDate = $("#fechaprepago").data("daterangepicker").startDate.format('YYYY-DD-MM');
        var endDate = $("#fechaprepago").data("daterangepicker").endDate.format('YYYY-DD-MM');
        formData.append("startDate",startDate);
        formData.append("endDate",endDate);
         $.ajax({
            url:"controllers/imprimiru.php?op=reporteProntoP",
            type:"POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(respuesta){
              /*swal(respuesta, "Presione OK para continuar");*/
              alert(respuesta);
              window.open(respuesta,"_blank");
            }
         });
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
    $("#numeroform").val("");
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
