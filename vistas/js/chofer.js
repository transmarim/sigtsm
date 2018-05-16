var tabla;
var bandera;

function init(){
    mostrarform(false);
    listar();
    $("#imagenmuestra").hide();

    jQuery.validator.addMethod("chofer", function(value, element){
        if (/^[a-zA-Z]+(\s*[a-zA-Z]*)*[a-zA-Z]+$/.test(value)) {
            return true;  // FAIL validation when REGEX matches
        } else {
            return false;   // PASS validation otherwise
        };
    }, "No se permiten numeros ni terminales en blanco");
    
    $("#formulario").validate({
        rules: {
            nombre: {
                required: true,
                chofer: true
            },
            idvehiculo: {
                required: true
            },
            idlicencia: {
                required: true
            },
            idcertificado: {
                required: true
            },
            cedula: {
                required: true,
                digits: true
            },
            telefono: {
                required: true,
                digits: true,
                minlength: 11,
                maxlength: 11
            },
            fechanac: {
                required: true
            },
            email: {
                required: true,
                email: true
            }
        },
        messages: {
            nombre: {
                required: "Campo requerido"
            },
            idvehiculo: {
                required: "Campo requerido"
            },
            idlicencia: {
                required: "Campo requerido"
            },
            idcertificado: {
                required: "Campo requerido"
            },
            cedula: {
                required: "Campo requerido",
                digits: "Introduzca un numero valido"
            },
            telefono: {
                required: "Campo requerido",
                minlength: "Minimo 11 Digitos / Ejem: 04249999999",
                maxlength: "Maximo 11 Digitos / Ejem: 04249999999"
            },
            fechanac: {
                required: "Campo requerido"
            },
            email: {
                required: "Campo requerido",
                email: "Por favor ingrese un email valido"
            }
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            // Add the `help-block` class to the error element
            error.addClass("help-block");

            if (element.prop("type") === "checkbox") {
                error.insertAfter(element.parent("label"));
            } else {
                error.insertAfter(element);
            }
        },
        highlight: function (element, errorClass, validClass) {
            $(element).parents(".col-sm-12").addClass("has-error").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents(".col-sm-12").addClass("has-success").removeClass("has-error");
        }
    });

    /*MOSTRAR SELECT LICENCIA*/
    $.post("controllers/licencia.php?op=selectLicencia",function(respuesta){
    $("#idlicencia").html(respuesta);
    $("#idlicencia").selectpicker('refresh');
    });
    
    $("#formulario").on("submit",function(e){
        if ($("#formulario").validate().form() == true){
            guardaryeditar(e);
        }
    });
    
}

function limpiar(){
    $("#idchofer").val("");
    $("#nombre").val("");
    $("#idvehiculo").selectpicker("val","");
    $("#idlicencia").selectpicker("val","");
    $("#idcertificado").selectpicker("val","");
    $("#cedula").val("");
    $("#telefono").val("");
    $("#fechanac").val("");
    $("#email").val("");
    $("#direccion").val("");
    $("#imagenmuestra").attr("src","");
	$("#imagenactual").val("");
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
        
    $.post("controllers/vehiculo.php?op=selectVehiculo",function(respuesta){
    $("#idvehiculo").html(respuesta);
    $("#idvehiculo").selectpicker('refresh');
    });
    
    $.post("controllers/certificado.php?op=selectCertificado",function(respuesta){
    $("#idcertificado").html(respuesta);
    $("#idcertificado").selectpicker('refresh');
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
					url: 'controllers/chofer.php?op=listar',
					type : "get",
					dataType : "json",
					error: function(e){
						console.log(e.responseText);
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5,//Paginacion
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}

function guardaryeditar(e){
    e.preventDefault();
    var formData = new FormData($("#formulario")[0]);
    $.ajax({
       url:"controllers/chofer.php?op=guardaryeditar",
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

function mostrar(idchofer){
     $.post("controllers/chofer.php?op=mostrar",{idchofer:idchofer},function(data,status){
          /*Convertir la cadena enviada desde PHP a un vector de objetos en JavaScript*/
         data = JSON.parse(data);
         mostrarform(true);
         $("#idchofer").val(data.idchofer);
         $("#nombre").val(data.nombre);
 
         $.post("controllers/vehiculo.php?op=mostrar",{idvehiculo:data.idvehiculo},function(dato,status){
            dato = JSON.parse(dato);
            $("#idvehiculo").find("option[value='"+dato.idvehiculo+"']").remove();
            $("#idvehiculo").append('<option value="'+dato.idvehiculo+'">'+dato.placa+' - '+dato.modelo+'</option>');
            $("#idvehiculo").val(dato.idvehiculo);
            $("#idvehiculo").selectpicker('refresh');
            });
         
         $.post("controllers/certificado.php?op=mostrar",{idcertificado:data.idcertificado},function(dato2,status){
            dato2 = JSON.parse(dato2);
            $("#idcertificado").find("option[value='"+dato2.idcertificado+"']").remove();
            $("#idcertificado").append('<option value="'+dato2.idcertificado+'">'+dato2.numero+'</option>');
            $("#idcertificado").val(dato2.idcertificado);
            $("#idcertificado").selectpicker('refresh');
            });
         
         /*MODIFICAR SELECT*/
         $("#idlicencia").find("option[value='"+data.idlicencia+"']").remove();
         $("#idlicencia").append('<option value="'+data.idlicencia+'">'+data.idlicencia+'</option>');
         $("#idlicencia").val(data.idlicencia);
         $("#idlicencia").selectpicker('refresh');
         $("#cedula").val(data.cedula);
         $("#telefono").val(data.telefono);
         $("#fechanac").val(data.fechanac);
         $("#email").val(data.email);
         $("#direccion").val(data.direccion);
         /*MOSTRAMOS IMG DE MUESTRA*/
         $("#imagenmuestra").show();
         $("#imagenmuestra").attr("src","vistas/img/choferes/"+data.imagen);
         $("#imagenactual").val(data.imagen);
     });
    }

 function desactivar(idchofer){
    swal({
        title: "Esta seguro..?"
        , text: "Al desactivar este chofer, no podra utilizarse en el sistema"
        , type: "warning"
        , showCancelButton: true
        , confirmButtonColor: "#da4f49"
        , confirmButtonText: "Si, deseo desactivarlo!"
        , closeOnConfirm: false
        }, function () {
            $.post('controllers/chofer.php?op=desactivar',{idchofer:idchofer},function(e){
            swal("Desactivado!", e , "success");  
            tabla.ajax.reload();
            });
        });
 }

 function activar(idchofer){
    swal({
        title: "Esta seguro..?"
        , text: "Al activar este chofer, podra utilizarse en el sistema"
        , type: "warning"
        , showCancelButton: true
        , confirmButtonColor: "#da4f49"
        , confirmButtonText: "Si, deseo activarlo!"
        , closeOnConfirm: false
        }, function () {
            $.post('controllers/chofer.php?op=activar',{idchofer:idchofer},function(e){
            swal("Activado!", e , "success");  
            tabla.ajax.reload();
            });
        });
 }


init();
