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
    $("#idvehiculo").val("");
    $("#placa").val("");
    $("#modelo").val("");
    $("#anovehiculo").val("");
    $("#idseguro").selectpicker("val","");
    $("#idseguro").selectpicker('refresh');
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
     $.post("controllers/vehiculo.php?op=mostrar",{idvehiculo:idvehiculo},function(data,status){
          /*Convertir la cadena enviada desde PHP a un vector de objetos en JavaScript*/
         data = JSON.parse(data);
         mostrarform(true);
         $("#idvehiculo").val(data.idvehiculo);
         $("#placa").val(data.placa);
         $("#modelo").val(data.modelo);
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
         $("#imagenmuestra").attr("src","vistas/img/vehiculos/"+data.imagen);
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


init();
