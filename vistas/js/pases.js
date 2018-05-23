var tabla;
var bandera;
function init(){
    mostrarform(true);

    $.post('controllers/pases.php?op=chofer',function(respuesta){
        $("#choferes").html(respuesta);
    });
    
    $("#formulario").validate({
        rules:{
            tipo_pase:{
                required: true
            },
            fecha:{
                required: true
            },
            "choferes[]":{
                required: true
            }
        },
        messages: {
            tipo_pase:{
                required: "Campo requerido"
            },
            fecha:{
                required: "Campo requerido"
            },
            "choferes[]":{
                required: "Debe seleccionar 1 permiso como mínimo"
            }
        },
        errorElement: "em",
        errorPlacement: function ( error, element ) {
            // Add the `help-block` class to the error element
            error.addClass( "help-block" );

            if ( element.prop( "type" ) === "checkbox" ) {
                error.insertAfter( element.parent( "label" ) );
            } else {
                error.insertAfter( element );
            }
        },
        highlight: function ( element, errorClass, validClass ) {
            $( element ).parents( ".col-sm-12" ).addClass( "has-error" ).removeClass( "has-success" );
        },
        unhighlight: function (element, errorClass, validClass) {
            $( element ).parents( ".col-sm-12" ).addClass( "has-success" ).removeClass( "has-error" );
        }
       });

    $("#formulario").on("submit",function(e){
        if ($("#formulario").validate().form() == true){
            guardaryeditar(e);
        }
    });
    
}

function limpiar(){
    $("#tipo_pase").selectpicker("val","");
    $("#fecha").val("");
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
}

function guardaryeditar(e){
    e.preventDefault();
    var startDate = $("#fecha").data("daterangepicker").startDate.format('YYYY-MM-DD');
    var endDate = $("#fecha").data("daterangepicker").endDate.format('YYYY-MM-DD');

    var formData = new FormData($("#formulario")[0]);
    formData.append("startDate",startDate);
    formData.append("endDate",endDate);
    $.ajax({
       url:"controllers/pases.php?op=guardaryeditar",
       type:"POST",
       data: formData,
       contentType: false,
	   processData: false,
       success: function(respuesta){
        window.open(respuesta,"_blank");
        //alert(respuesta);
       }
    });
}

init();
