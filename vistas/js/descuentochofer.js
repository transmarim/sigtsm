var tabla;

function init() {
    mostrarform(false);
    listar();
    //mostrartipo(); DESACTIVADA VER FINAL DE JS
    //$("#porcentajeform").hide();
    $("#montodescform").show();

    $("#formulario").validate({
        rules:{
            idchofer:{
                required: true
            },
            fecha:{
                required: true
            },
            montodesc:{
                required: true,
                number: true,
                min:1
            },
            iddescuento:{
                required: true
            }
        },
        messages: {
            idchofer:{
                required: "Campo requerido"
            },
            fecha:{
                required: "Campo requerido"
            },
            montodesc:{
                required: "Campo requerido",
                min: "No se aceptan numeros negativos"
            },
            iddescuento:{
                required: "Campo requerido"
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

    $.post("controllers/chofer.php?op=selectc", function (respuesta) {
        $("#idchofer").html(respuesta);
        $("#idchofer").selectpicker('refresh');
    });

    $.post("controllers/descuento.php?op=listarc", function (respuesta) {
        $("#iddescuento").html(respuesta);
        $("#iddescuento").selectpicker('refresh');
    });

    $("#formulario").on("submit",function(e){
        if ($("#formulario").validate().form() == true){
            guardaryeditar(e);
        }
    });

}

function limpiar() {
    $("#idchofer_descuento").val("");
    $("#tipodemonto").val("");
    $("#tipodemonto").selectpicker('refresh');
    $("#montodesc").val("");
    $("#porcentaje").val("");
    /*QUITAR CLASES A LOS ELEMENTOS*/
    $(".form-group").removeClass('has-success has-error');
}

function mostrarform(flag) {
    limpiar();
    if (flag) {
        $("#listadoregistros").hide();
        $("#formulario").show('fast');
        $("#btnGuardar").prop("disabled", false);
        $("#btnagregar").hide();

    } else {
        $("#listadoregistros").show();
        $("#formulario").hide();
        $("#btnagregar").show();
    }
}

function cancelarform(){
    mostrarform(false);
    limpiar();
}

function listar(){
    tabla=$('#tbllistado').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//PaginaciÔö£Ôöén y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: 'controllers/descuentochofer.php?op=listar',
					type : "get",
					dataType : "json",
					error: function(e){
						console.log(e.responseText);
					}
				},
		"bDestroy": true,
		"iDisplayLength": 10,//Paginacion
	    "order": [[ 2, "asc" ]]//Ordenar (columna,orden)
	}).DataTable();
}

function guardaryeditar(e){
    e.preventDefault();
    var formData = new FormData($("#formulario")[0]);
    $.ajax({
       url:"controllers/descuentochofer.php?op=guardaryeditar",
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

function mostrar(idchofer_descuento){
     $.post("controllers/descuentochofer.php?op=mostrar",{idchofer_descuento:idchofer_descuento},function(data,status){
          /*Convertir la cadena enviada desde PHP a un vector de objetos en JavaScript*/
         data = JSON.parse(data);
         mostrarform(true);
         $("#idchofer_descuento").val(data.idchofer_descuento);
         $("#idchofer").val(data.idchofer);
         $("#idchofer").selectpicker('refresh');
         var flag = data.porcentaje;
         if(flag != 0){
             $("#tipodemonto").val(1);
             $("#tipodemonto").selectpicker('refresh');
             $("#porcentaje").val(data.porcentaje);
             $("#porcentajeform").show();
             $("#montodescform").hide();
         }else{
             $("#tipodemonto").val(0);
             $("#tipodemonto").selectpicker('refresh');
             $("#montodesc").val(data.montodesc);
             $("#porcentajeform").hide();
             $("#montodescform").show();
         }
         $("#iddescuento").val(data.iddescuento);
         $("#iddescuento").selectpicker('refresh');
         $("#fecha").val(data.fecha);
     });
    }

 function eliminar(idchofer_descuento){
    swal({
        title: "Esta seguro..?"
        , text: "Al eliminar este descuento no se vera reflejado en los reportes"
        , type: "warning"
        , showCancelButton: true
        , confirmButtonColor: "#da4f49"
        , confirmButtonText: "Si, deseo elimnarlo!"
        , closeOnConfirm: false
        }, function () {
            $.post('controllers/descuentochofer.php?op=eliminar',{idchofer_descuento:idchofer_descuento},function(e){
            swal("Eliminado!", e , "success");  
            tabla.ajax.reload();
            });
        });
 }

/*DESACTIVADA POR PROBLEMAS AL APLICAR % */
/*
function mostrartipo(){
    $("#tipodemonto").change(function(){
        $("#porcentaje").val("");
        $("#montodesc").val("");
        var tipo = $(this).selectpicker("val");
        if(tipo == 1){
            $("#porcentajeform").show();
            $("#montodescform").hide();
        } else if(tipo == 0){
            $("#porcentajeform").hide();
            $("#montodescform").show();
        }else{
            $("#porcentajeform").hide();
            $("#montodescform").hide();
        }
    });
}
*/


init();
