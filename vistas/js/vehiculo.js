var tabla;
var bandera;

function init(){
    mostrarform(false);
    listar();
    $("#imagenmuestra").hide();
    validarimg();
    
    jQuery.validator.addMethod("placa", function(value, element){
        if (/^[0-9-zA-Z]+$/.test(value)) {
            return true;  // FAIL validation when REGEX matches
        } else {
            return false;   // PASS validation otherwise
        };
    }, "Solo se aceptan mayusculas y sin espacios");

    jQuery.validator.addMethod("modelo", function(value, element){
        if (/^[a-zA-Z0-9]+(\s*[a-zA-Z0-9]*)*[a-zA-Z0-9]+$/.test(value)) {
            return true;  // FAIL validation when REGEX matches
        } else {
            return false;   // PASS validation otherwise
        };
    }, "No se aceptan caracteres especiales ni dobles espacios");

    $("#formulario").validate({
        rules:{
            placa:{
                required: true,
                placa:true
            },
            fecha:{
                required: true
            },
            idseguro:{
                required: true
            },
            color:{
                required: true
            },
            modelo:{
                required: true,
                modelo: true
            },
            anovehiculo:{
                required: true,
                number: true,
                min:1,
                digits: true
            }
        },
        messages: {
            placa:{
                required: "Campo requerido"
            },
            fecha:{
                required: "Campo requerido"
            },
            idseguro:{
                required: "Campo requerido"
            },
            color:{
                required: "Campo requerido"
            },
            modelo:{
                required: "Campo requerido"
            },
            anovehiculo:{
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

    $("#formulario").on("submit",function(e){
        if ($("#formulario").validate().form() == true){
            guardaryeditar(e);
        }
    });

    
}

function limpiar(){
    $("#idvehiculo").val("");
    $("#placa").val("");
    $("#modelo").val("");
    $("#anovehiculo").val("");
    $("#idseguro").selectpicker("val","");
    $("#idseguro").selectpicker('refresh');
    $("#color").selectpicker("val","");
    $("#color").selectpicker('refresh');
    $("#imagenmuestra").attr("src","");
    $("#rutarchivo").attr("href","");
    $("#imagenactual").val("");
    $("#imagen").val("");
    /*QUITAR CLASES A LOS ELEMENTOS*/
    $(".form-group").removeClass('has-success has-error');
}

function mostrarform(flag){
    limpiar();
    if(flag){
        $("#listadoregistros").hide();
        $("#formulario").show('fast');
        $("#btnGuardar").prop("disabled",false);
        $("#btnagregar").hide();
         /*MOSTRAR SELECT LICENCIA*/
        $.post("controllers/seguro.php?op=select",function(respuesta){
        $("#idseguro").html(respuesta);
        $("#idseguro").selectpicker('refresh');
        });
        
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
					url: 'controllers/vehiculo.php?op=listar',
					type : "get",
					dataType : "json",
					error: function(e){
						console.log(e.responseText);
					}
				},
		"bDestroy": true,
		"iDisplayLength": 10,//Paginacion
	    "order": [[ 1, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}

function guardaryeditar(e){
    e.preventDefault();
    var formData = new FormData($("#formulario")[0]);
    $.ajax({
       url:"controllers/vehiculo.php?op=guardaryeditar",
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

function mostrar(idvehiculo){
    var seguro;
    function getFileExtension(filename) {
        return (/[.]/.exec(filename)) ? /[^.]+$/.exec(filename)[0] : undefined;
    }
     $.post("controllers/vehiculo.php?op=mostrar",{idvehiculo:idvehiculo},function(data,status){
          /*Convertir la cadena enviada desde PHP a un vector de objetos en JavaScript*/
         data = JSON.parse(data);
         mostrarform(true);
         $("#idvehiculo").val(data.idvehiculo);
         $("#placa").val(data.placa);
         $("#modelo").val(data.modelo);
         $("#color").val(data.color);
         $("#color").selectpicker('refresh');
         $("#anovehiculo").val(data.anovehiculo);
         
         seguro = data.idseguro;
         /*TRAER OPCION SELECT*/
         $.post("controllers/seguro.php?op=mostrar",{idseguro:seguro},function(dato,status){
            dato = JSON.parse(dato);
            $("#idseguro").find("option[value='"+dato.idseguro+"']").remove();
            $("#idseguro").append('<option value="'+dato.idseguro+'">'+dato.numero+'</option>');
            $("#idseguro").val(dato.idseguro);
            $("#idseguro").selectpicker('refresh');
            });

         /*MOSTRAMOS IMG DE MUESTRA*/
         $("#imagenmuestra").show();
         var ext = getFileExtension(data.imagen);
         if(ext != 'pdf'){
            $("#imagenmuestra").attr("src","vistas/img/vehiculos/"+data.imagen);
         }else{
            $("#imagenmuestra").attr("src","vistas/img/vehiculos/pdf.png");
            $("#rutarchivo").attr("href","vistas/img/vehiculos/"+data.imagen);
         }
         $("#imagenactual").val(data.imagen);
     });
    }

 function desactivar(idvehiculo){
    swal({
        title: "Esta seguro..?"
        , text: "Al desactivar este vehiculo, no podra utilizarse en el sistema"
        , type: "warning"
        , showCancelButton: true
        , confirmButtonColor: "#da4f49"
        , confirmButtonText: "Si, deseo desactivarlo!"
        , closeOnConfirm: false
        }, function () {
            $.post('controllers/vehiculo.php?op=desactivar',{idvehiculo:idvehiculo},function(e){
            swal("Desactivado!", e , "success");  
            tabla.ajax.reload();
            });
        });
 }

 function activar(idvehiculo){
    swal({
        title: "Esta seguro..?"
        , text: "Al activar este vehiculo, podra utilizarse en el sistema"
        , type: "warning"
        , showCancelButton: true
        , confirmButtonColor: "#da4f49"
        , confirmButtonText: "Si, deseo activarlo!"
        , closeOnConfirm: false
        }, function () {
            $.post('controllers/vehiculo.php?op=activar',{idvehiculo:idvehiculo},function(e){
            swal("Activado!", e , "success");  
            tabla.ajax.reload();
            });
        });
 }

 function validarimg(){
    $("#imagen").change(function(){
        var imagen = this.files[0];
        var imagenType = imagen.type;
        var flag = false;
        var imagenSize = imagen.size;
         if(Number(imagenSize)<500000 && (imagenType == "image/jpeg" || imagenType == "image/png" || imagenType == "application/pdf")){
             swal('Excelente!','El archivo cumple con los parametros permitidos.','success');
         }else{
             swal('Error!','El archivo que intenta subir no cumple con los parametros permitidos.','error');
             $("#imagen").val("");
         }
    });
}


init();
