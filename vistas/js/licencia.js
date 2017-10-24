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
    $("#idlicencia").val("");
    $("#fechaven").val("");
    $("#grado").selectpicker("val","");
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
					url: 'controllers/licencia.php?op=listar',
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
       url:"controllers/licencia.php?op=guardaryeditar",
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

function mostrar(idlicencia){
     $.post("controllers/licencia.php?op=mostrar",{idlicencia:idlicencia},function(data,status){
          /*Convertir la cadena enviada desde PHP a un vector de objetos en JavaScript*/
         data = JSON.parse(data);
         mostrarform(true);
         $("#idlicencia").val(data.idlicencia);
         $("#grado").val(data.grado);
         $("#grado").selectpicker('refresh');
         $("#fechaven").val(data.fechaven);
         /*MOSTRAMOS IMG DE MUESTRA*/
         $("#imagenmuestra").show();
         $("#imagenmuestra").attr("src","vistas/img/licencias/"+data.imagen);
         $("#imagenactual").val(data.imagen);
     });
    }

 function desactivar(idlicencia){
    swal({
        title: "Esta seguro..?"
        , text: "Al desactivar esta licencia, no podra utilizarse en el sistema"
        , type: "warning"
        , showCancelButton: true
        , confirmButtonColor: "#da4f49"
        , confirmButtonText: "Si, deseo desactivarlo!"
        , closeOnConfirm: false
        }, function () {
            $.post('controllers/licencia.php?op=desactivar',{idlicencia:idlicencia},function(e){
            swal("Desactivado!", e , "success");  
            tabla.ajax.reload();
            });
        });
 }

 function activar(idlicencia){
    swal({
        title: "Esta seguro..?"
        , text: "Al activar esta licencia, podra utilizarse en el sistema"
        , type: "warning"
        , showCancelButton: true
        , confirmButtonColor: "#da4f49"
        , confirmButtonText: "Si, deseo activarla!"
        , closeOnConfirm: false
        }, function () {
            $.post('controllers/licencia.php?op=activar',{idlicencia:idlicencia},function(e){
            swal("Activado!", e , "success");  
            tabla.ajax.reload();
            });
        });
 }


init();
