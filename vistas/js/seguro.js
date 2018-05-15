var tabla;
var bandera;
function init(){
    mostrarform(false);
    listar();
    
    $("#formulario").validate({
        rules:{
            numero:{
                required: true,
                digits:true,
                minlength:5
            },
            fechaven:{
                required: true,
                date:true
            }
        },
        messages: {
            numero:{
                required: "Campo requerido",
                minlength: "5 numeros como minimo",
                digits: "Introduzca un numero valido",
                number: "Introduzca un numero valido"
            },
            fechaven:{
                required: "Campo requerido",
                date: "Introduzca una fecha valida"
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
    $("#idseguro").val("");
    $("#fechaven").val("");
    $("#numero").val("");
    $("#tipo_seguro").val("");
    $(".form-group").removeClass('has-success has-error');
}

function mostrarform(flag){
    limpiar();
    if(flag){
        $("#listadoregistros").hide();
        $("#formulario").show('fast');
        $("#btnGuardar").prop("disabled",false);
        $("#btnagregar").hide();
        
    }else{
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
					url: 'controllers/seguro.php?op=listar',
					type : "get",
					dataType : "json",
					error: function(e){
						console.log(e.responseText);
					}
				},
		"bDestroy": true,
		"iDisplayLength": 10,//Paginacion
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}

function guardaryeditar(e){
    e.preventDefault();
    var formData = new FormData($("#formulario")[0]);
    $.ajax({
       url:"controllers/seguro.php?op=guardaryeditar",
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

function mostrar(idseguro){
     $.post("controllers/seguro.php?op=mostrar",{idseguro:idseguro},function(data,status){
          /*Convertir la cadena enviada desde PHP a un vector de objetos en JavaScript*/
         data = JSON.parse(data);
         mostrarform(true);
         $("#idseguro").val(data.idseguro);
         $("#numero").val(data.numero);
         $("#tipo_seguro").val(data.tipo_seguro);
         $("#tipo_seguro").selectpicker('refresh');
         $("#fechaven").val(data.fechaven);
     });
    }

 function desactivar(idseguro){
    swal({
        title: "Esta seguro..?"
        , text: "Al desactivar este seguro, no podra utilizarse en el sistema"
        , type: "warning"
        , showCancelButton: true
        , confirmButtonColor: "#da4f49"
        , confirmButtonText: "Si, deseo desactivarlo!"
        , closeOnConfirm: false
        }, function () {
            $.post('controllers/seguro.php?op=desactivar',{idseguro:idseguro},function(e){
            swal("Desactivado!", e , "success");  
            tabla.ajax.reload();
            });
        });
 }

 function activar(idseguro){
    swal({
        title: "Esta seguro..?"
        , text: "Al activar este seguro, podra utilizarse en el sistema"
        , type: "warning"
        , showCancelButton: true
        , confirmButtonColor: "#da4f49"
        , confirmButtonText: "Si, deseo activarlo!"
        , closeOnConfirm: false
        }, function () {
            $.post('controllers/seguro.php?op=activar',{idseguro:idseguro},function(e){
            swal("Activado!", e , "success");  
            tabla.ajax.reload();
            });
        });
 }

init();
