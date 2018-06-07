/*JS PARA CONTROL DE IMPRIMIR, COLOCAR BOTONES EN EL MEDIO PARA QUE NO SE VEAN TODAS LAS OPCIONES Y USAR UN SHOW Y HIDE PARA QUE TODO ESTA FINO*/
var tabla;
var bandera;

function init(){
    mostrarform(false,0);

     $("#formulario").on("submit",function(e){
       guardaryeditar(e);
    });

    $("#formulario1").on("submit",function(e){
        e.preventDefault();
        var formData = new FormData($("#formulario1")[0]);
        var chofer = $("#idchofer2").val();
        var empresa = $("#idempresa2").val();
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
    
}


function limpiar(){

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
