var tabla;
var bandera;

function init(){
    mostrarform(false);
    listar();
    $("#imagenmuestra").hide();
    
    /*MOSTRAR SELECT LICENCIA*/
    $.post("controllers/licencia.php?op=selectLicencia",function(respuesta){
    $("#idlicencia").html(respuesta);
    $("#idlicencia").selectpicker('refresh');
    });
    
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
        
    $.post("controllers/vehiculo.php?op=selectVehiculo",function(respuesta){
    $("#idvehiculo").html(respuesta);
    $("#idvehiculo").selectpicker('refresh');
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
         
         /*MODIFICAR SELECT*/
         $("#idlicencia").find("option[value='"+data.idlicencia+"']").remove();
         $("#idlicencia").append('<option value="'+data.idlicencia+'">'+data.idlicencia+'</option>');
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
