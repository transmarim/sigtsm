var tabla;
var bandera;
function init(){
    mostrarform(false);
    
     $("#formulario").on("submit",function(e){
       guardaryeditar(e);
    });
    
}

function limpiar(){
    $("#fechaprepago").val("");
    /*QUITAR CLASES A LOS ELEMENTOS*/
    $(".form-group").removeClass('has-success has-error');
}

function mostrarform(flag){
    limpiar();
    if(flag){
        $("#formulario").show('fast');
        $("#btnGuardar").prop("disabled",false);
        $("#btnagregar").hide();
        
    }else{
        $("#formulario").hide();
        $("#btnagregar").show();
    }
}

function cancelarform(){
    limpiar();
    mostrarform(false);
}

function guardaryeditar(e){
    e.preventDefault();
    var startDate = $("#fechaprepago").data("daterangepicker").startDate.format('YYYY-MM-DD');
    var endDate = $("#fechaprepago").data("daterangepicker").endDate.format('YYYY-MM-DD');

    swal({
        title: "¿Esta seguro de cerrar el sistema?"
        , text: "Desde "+startDate+" Hasta "+endDate
        , type: "warning"
        , showCancelButton: true
        , confirmButtonColor: "#da4f49"
        , showLoaderOnConfirm: true
        , confirmButtonText: "Si, cerrar!"
        , closeOnConfirm: false
        }, function() {
            var formData = new FormData($("#formulario")[0]);
            formData.append("startDate",startDate);
            formData.append("endDate",endDate);
            $.ajax({
                url:"controllers/cerrar.php?op=cerrarS",
                type:"POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(respuesta){
                  swal(respuesta, "Presione OK para continuar");
                  mostrarform(false);
                }
             });
        });
}

init();
