var tabla;
var bandera;
function init(){
    mostrarform(false);
    listar();
    $("#imagenmuestra").hide();
    validarimg();
    
    $("#formulario").validate({
        rules:{
            numero:{
                required: true,
                digits:true
            },
            fechaven:{
                required: true
            }
        },
        messages: {
            numero:{
                required: "Campo requerido",
                digits: "No se permiten decimales"
            },
            fechaven:{
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
    $("#idcertificado").val("");
    $("#numero").val("");
    $("#fechaven").val("");
    $("#imagenmuestra").attr("src","");
    $("#rutarchivo").attr("href","");
    $("#imagenactual").val("");
    $("#imagen").val("");
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
					url: 'controllers/certificado.php?op=listar',
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
       url:"controllers/certificado.php?op=guardaryeditar",
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

function mostrar(idcertificado){
    function getFileExtension(filename) {
        return (/[.]/.exec(filename)) ? /[^.]+$/.exec(filename)[0] : undefined;
    }
     $.post("controllers/certificado.php?op=mostrar",{idcertificado:idcertificado},function(data,status){
          /*Convertir la cadena enviada desde PHP a un vector de objetos en JavaScript*/
         data = JSON.parse(data);
         mostrarform(true);
         $("#idcertificado").val(data.idcertificado);
         $("#numero").val(data.numero);
         $("#fechaven").val(data.fechaven);

         /*MOSTRAMOS IMG DE MUESTRA*/
         $("#imagenmuestra").show();
         var ext = getFileExtension(data.imagen);
         if(ext != 'pdf'){
            $("#imagenmuestra").attr("src","vistas/img/certificados/"+data.imagen);
         }else{
            $("#imagenmuestra").attr("src","vistas/img/certificados/pdf.png");
            $("#rutarchivo").attr("href","vistas/img/certificados/"+data.imagen);
         }
         $("#imagenactual").val(data.imagen);
     });
    }

 function desactivar(idcertificado){
    swal({
        title: "Esta seguro..?"
        , text: "Al desactivar este certificado, no podra utilizarse en el sistema"
        , type: "warning"
        , showCancelButton: true
        , confirmButtonColor: "#da4f49"
        , confirmButtonText: "Si, deseo desactivarlo!"
        , closeOnConfirm: false
        }, function () {
            $.post('controllers/certificado.php?op=desactivar',{idcertificado:idcertificado},function(e){
            swal("Desactivado!", e , "success");  
            tabla.ajax.reload();
            });
        });
 }

 function activar(idcertificado){
    swal({
        title: "Esta seguro..?"
        , text: "Al activar este certificado, podra utilizarse en el sistema"
        , type: "warning"
        , showCancelButton: true
        , confirmButtonColor: "#da4f49"
        , confirmButtonText: "Si, deseo activarlo!"
        , closeOnConfirm: false
        }, function () {
            $.post('controllers/certificado.php?op=activar',{idcertificado:idcertificado},function(e){
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
