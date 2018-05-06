var tabla;
var bandera;
function init(){
    mostrarform(false);
    
     $("#formulario").on("submit",function(e){
       guardaryeditar(e);
       var startDate = $("#fechaprepago").data("daterangepicker").startDate.format('YYYY-MM-DD');
       var endDate = $("#fechaprepago").data("daterangepicker").endDate.format('YYYY-MM-DD');
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
    var formData = new FormData($("#formulario")[0]);
    $.ajax({
       url:"controllers/tarifas.php?op=guardaryeditar",
       type:"POST",
       data: formData,
       contentType: false,
	   processData: false,
       success: function(respuesta){
         swal(respuesta, "Presione OK para continuar");
         mostrarform(false);
	     tabla.ajax.reload();
       }
    });
}

init();
