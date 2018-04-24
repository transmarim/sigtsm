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
        var chofer = $("#idchofer").val();
        var empresa = $("#idempresa").val();
        var startDate = $("#fechaprepago").data("daterangepicker").startDate.format('YYYY-MM-DD');
        var endDate = $("#fechaprepago").data("daterangepicker").endDate.format('YYYY-MM-DD');

        formData.append("idchofer",chofer);
        formData.append("idempresa",empresa);
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
              swal({
                title: "Reporte ProntoPago"
                , text: "Ha sido generado, continue para imprimir"
                , type: "info"
                , showCancelButton: true
                , confirmButtonColor: "#da4f49"
                , confirmButtonText: "Imprimir!"
                , closeOnConfirm: true
                }, function () {
                    window.open(respuesta,"_blank");
                });
            }
         });
    });
    
    $("#formulario2").on("submit",function(e){
        e.preventDefault();
        var formData = new FormData($("#formulario2")[0]);
        var empresa = $("#idempresa2").val();
        var startDate = $("#fechaprepago2").data("daterangepicker").startDate.format('YYYY-MM-DD');
        var endDate = $("#fechaprepago2").data("daterangepicker").endDate.format('YYYY-MM-DD');

        formData.append("idempresa",empresa);
        formData.append("startDate",startDate);
        formData.append("endDate",endDate);
         $.ajax({
            url:"controllers/imprimiru.php?op=resumenProntoP",
            type:"POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(respuesta){
              /*swal(respuesta, "Presione OK para continuar");*/
              swal({
                title: "Resumen ProntoPago"
                , text: "Ha sido generado, continue para imprimir"
                , type: "info"
                , showCancelButton: true
                , confirmButtonColor: "#da4f49"
                , confirmButtonText: "Imprimir!"
                , closeOnConfirm: true
                }, function () {
                    window.open(respuesta,"_blank");
                });
            }
         });
    });

    $("#formulario3").on("submit",function(e){
        e.preventDefault();
        var formData = new FormData($("#formulario3")[0]);
        var empresa = $("#idempresa3").val();
        var ticket = $("#ticket").val();

        formData.append("idempresa",empresa);
        formData.append("ticket",ticket);
         $.ajax({
            url:"controllers/imprimiru.php?op=detalleTicket",
            type:"POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(respuesta){
              /*swal(respuesta, "Presione OK para continuar");*/
              swal({
                title: "Detalle de Ticket"
                , text: "Ha sido generado, continue para imprimir"
                , type: "info"
                , showCancelButton: true
                , confirmButtonColor: "#da4f49"
                , confirmButtonText: "Imprimir!"
                , closeOnConfirm: true
                }, function () {
                    window.open(respuesta,"_blank");
                });
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
