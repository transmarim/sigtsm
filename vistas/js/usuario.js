var tabla;
var bandera;

function init(){
    mostrarform(false);
    listar();
    $("#imagenmuestra").hide();

    //Mostramos los permisos
	$.post("controllers/usuario.php?op=permisos&id=",function(r){
	        $("#permisos").html(r);
	});
    
    validarimg();
    //validarinput('#login',/^[a-z\d_]{4,15}$/i);
    
    jQuery.validator.addMethod("pw", function(value, element){
        if (/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/.test(value)) {
            return true;  // FAIL validation when REGEX matches
        } else {
            return false;   // PASS validation otherwise
        };
    }, "La clave debe ser mayor a 8 caracteres, incluir minuscula, mayuscula o simbolo");

    jQuery.validator.addMethod("nombre", function(value, element){
        if (/^[a-zA-Z]+(\s*[a-zA-Z]*)*[a-zA-Z]+$/.test(value)) {
            return true;  // FAIL validation when REGEX matches
        } else {
            return false;   // PASS validation otherwise
        };
    }, "No se permiten numeros ni terminales en blanco");

    jQuery.validator.addMethod("usuario", function(value, element){
        if (/^[a-z\d_]{4,15}$/i.test(value)) {
            return true;  // FAIL validation when REGEX matches
        } else {
            return false;   // PASS validation otherwise
        };
    }, "Debe contener 4 caracteres minimos, sin espacios");    

    $("#formulario").validate({
        rules: {
            nombre: {
                required: true,
                nombre: true
            },
            login: {
                required: true,
                usuario:true
            },
            clave: {
                required: true,
                pw: true
            },
            email: {
                required: true,
                email: true
            },
            'permiso[]': {
                required:true,
                minlength:1
            }
        },
        messages: {
            nombre: {
                required: "Campo requerido"
            },
            login: {
                required: "Campo requerido"
            },
            clave: {
                required: "Campo requerido"
            },
            email: {
                required: "Campo requerido",
                email: "Por favor ingrese un email valido"
            },
            'permiso[]': {
                required: "Campo requerido",
                minlength: "Debe seleccionar 1 permiso como minimo"
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

    $("#formulario").on("submit",function(e){
        if ($("#formulario").validate().form() == true){
            guardaryeditar(e);
        }
    });
    
}

function limpiar(){
    $("#idusuario").val("");
    $("#nombre").val("");
    $("#login").val("");
    $("#clave").val("");
    $("#email").val("");
    $("#idchofer").selectpicker("val","");
    $("#imagenmuestra").attr("src","");
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
        
        /*PEDIMOS QUE ACTUALIC EL SELECT CADA VEZ QUE ABRE EL FORM*/
        $.post("controllers/usuario.php?op=selectChofer",function(respuesta){
        $("#idchofer").html(respuesta);
        $("#idchofer").find("option[value='0']").remove();
        $("#idchofer").append('<option value="0" selected="selected">NADIE</option>');    
        $("#idchofer").selectpicker('refresh');
        });
        
    }else{
        $("#listadoregistros").show();
        $("#formulario").hide();
        $("#btnagregar").show();
    }
}

function listar(){
    tabla=$('#tbllistado').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginacion y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: 'controllers/usuario.php?op=listar',
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

function cancelarform(){
    mostrarform(false);
    limpiar();
}

function guardaryeditar(e){
    e.preventDefault();
    var formData = new FormData($("#formulario")[0]);
    $.ajax({
       url:"controllers/usuario.php?op=guardaryeditar",
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

 function mostrar(idusuario){
     var chofer;
     $.post("controllers/usuario.php?op=mostrar",{idusuario:idusuario},function(data,status){
          // Convertir la cadena enviada desde PHP a un vector de objetos en JavaScript
         data = JSON.parse(data);
         /*LLAMO MOSTRAR FORM*/
         mostrarform(true);
         $("#idusuario").val(data.idusuario);
         $("#nombre").val(data.nombre);
         $("#login").val(data.login);
         $("#email").val(data.email);
         chofer = data.idchofer;
         
         if(chofer != 0){
          $.post("controllers/chofer.php?op=mostrar",{idchofer:chofer},function(dato,status){
            dato = JSON.parse(dato);
            $("#idchofer").find("option[value='"+dato.idchofer+"']").remove();
            $("#idchofer").append('<option value="'+dato.idchofer+'">'+dato.nombre+'</option>');

            $("#idchofer").val(dato.idchofer);
            $("#idchofer").selectpicker('refresh');
            });
         } else {
            $("#idchofer").val(chofer);
            $("#idchofer").selectpicker('refresh');
         }
         /*MOSTRAMOS IMG DE MUESTRA*/
         $("#imagenmuestra").show();
         $("#imagenmuestra").attr("src","vistas/img/usuarios/"+data.imagen);
         $("#imagenactual").val(data.imagen);
     });

     $.post('controllers/usuario.php?op=permisos&id='+idusuario,function(respuesta){
         $("#permisos").html(respuesta);
     });
 }

 function desactivar(idusuario){
    swal({
        title: "Esta seguro..?"
        , text: "Al desactivar este usuario, no podra ingresar al sistema"
        , type: "warning"
        , showCancelButton: true
        , confirmButtonColor: "#da4f49"
        , confirmButtonText: "Si, deseo desactivarlo!"
        , closeOnConfirm: false
        }, function () {
            $.post('controllers/usuario.php?op=desactivar',{idusuario:idusuario},function(e){
            swal("Desactivado!", e , "success");  
            tabla.ajax.reload();
            });
        });
 }

 function activar(idusuario){
    swal({
        title: "Esta seguro..?"
        , text: "Al activar este usuario, podra reingresar al sistema"
        , type: "warning"
        , showCancelButton: true
        , confirmButtonColor: "#da4f49"
        , confirmButtonText: "Si, deseo activarlo!"
        , closeOnConfirm: false
        }, function () {
            $.post('controllers/usuario.php?op=activar',{idusuario:idusuario},function(e){
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
         if(Number(imagenSize)<500000 && (imagenType == "image/jpeg" || imagenType == "image/png")){
             swal('Excelente!','La imagen cumple con los parametros permitidos.','success');
         }else{
             swal('Error!','El archivo que intenta subir no cumple con los parametros permitidos.','error');
             $("#imagen").val("");
         }
    });
}

init();
