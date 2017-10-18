var tabla;
var bandera;

function init(){
    mostrarform(false);
    listar();
    $("#imagenmuestra").hide();

     $("#formulario").on("submit",function(e){
       guardaryeditar(e);
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
         $("#idvehiculo").val(data.idvehiculo);
         $("#idvehiculo").selectpicker('refresh');
         $("#idlicencia").val(data.idlicencia);
         $("#idlicencia").selectpicker('refresh');
         $("#idcertificado").val(data.idcertificado);
         $("#idcertificado").selectpicker('refresh');
         $("#cedula").val(data.cedula);
         $("#telefono").val(data.telefono);
         $("#fechanac").val(data.fechanac);
         $("#email").val(data.email);
         $("#direccion").val(data.direccion);
         /*MOSTRAMOS IMG DE MUESTRA*/
         $("#imagenmuestra").show();
         $("#imagenmuestra").attr("src","vistas/img/usuarios/"+data.imagen);
         $("#imagenactual").val(data.imagen);
     });
    }

init();
