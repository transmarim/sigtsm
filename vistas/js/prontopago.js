var tabla;
var bandera;

function init(){
    mostrarform(false);
    listar();

    $("#formulario").on("submit",function(e){
        $("#nombre").prop('disabled', false);
       guardaryeditar(e);
    });
    
}

function limpiar(){
    $("#idchofer").val("");
    $("#nombre").val("");
    $("#email").val("");
    $("#descripcion").val("");
    $("#asunto").selectpicker("val","");
    $("#idempresa").selectpicker("val","");
    /*QUITAR CLASES A LOS ELEMENTOS*/
    $(".form-group").removeClass('has-success has-error');
}

function mostrarform(flag){
    limpiar();
    if(flag){
        $("#myModal").modal('show');
        
    }else{
        $("#myModal").modal('hide');
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
	    buttons: [],
		"ajax":
				{
					url: 'controllers/prontopago.php?op=listarAlert',
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
    var startDate = $("#fechaprepago").data("daterangepicker").startDate.format('YYYY-MM-DD');
    var endDate = $("#fechaprepago").data("daterangepicker").endDate.format('YYYY-MM-DD');

    formData.append("startDate",startDate);
    formData.append("endDate",endDate);

    $.ajax({
       url:"controllers/imprimiru.php?op=reporteProntoP",
       type:"POST",
       data: formData,
       contentType: false,
	   processData: false,
       success: function(respuesta){
         window.open(respuesta,"_blank");
         //PREGUNTA SI LO ENVIA O NO
         var str = respuesta.substr(19,17);

         swal({
            title: "¿Desea enviar el reporte?"
            , text: ""+str
            , type: "warning"
            , showCancelButton: true
            , confirmButtonColor: "#da4f49"
            , confirmButtonText: "Enviar!"
            , closeOnConfirm: true
            }, function () {
                //EJECUTAR FUNCION POST ENVIAR PP
            });

         mostrarform(false);
         $("#nombre").prop('disabled', true);
	     tabla.ajax.reload();
       }
    });
}

function mostrar(idchofer){
     mostrarform(true);
    $.post("controllers/chofer.php?op=mostrar",{idchofer:idchofer},function(data,status){
          /*Convertir la cadena enviada desde PHP a un vector de objetos en JavaScript*/
         data = JSON.parse(data);
         $("#idchofer").val(data.idchofer);
         $("#nombre").val(data.nombre);
         $("#email").val(data.email);
    });
}

init();
