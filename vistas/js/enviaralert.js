var tabla;
var bandera;

function init(){
    mostrarform(false);
    listar();

     $("#formulario").on("submit",function(e){
        guardaryeditar(e);
    });
    
}

function limpiar(){
    $("#idchofer").val("");
    $("#nombre").val("");
    $("#descripcion").val("");
    $("#email").val("");
    $("#asunto").selectpicker("val","");
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
					url: 'controllers/alerta.php?op=listarAlert',
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
    swal({
        title: "Esta seguro..?"
        , text: "Se enviara un email de alerta"
        , type: "warning"
        , showCancelButton: true
        , confirmButtonColor: "#da4f49"
        , confirmButtonText: "Si, deseo enviarlo!"
        , closeOnConfirm: false
        }, function () {
            $("#nombre").prop('disabled', false);
            var formData = new FormData($("#formulario")[0]);
            $.ajax({
            url:"controllers/enviaralert.php?op=enviaralert",
            type:"POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(respuesta){
                swal(respuesta, "Presione OK para continuar",);
                swal(respuesta, e , "success");
                $("#nombre").prop('disabled', true);
            }
            });
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
