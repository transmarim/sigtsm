var tabla;
var bandera;

function init(){
    mostrarform(false);
    calcularRet();
    listar();
    
    /*MOSTRAR SELECT LICENCIA*/
    $.post("controllers/cliente.php?op=listarc",function(respuesta){
    $("#idcliente").html(respuesta);
    $("#idcliente").selectpicker('refresh');
    });
    
    $.post("controllers/chofer.php?op=selectc",function(respuesta){
    $("#idchofer").html(respuesta);
    $("#idchofer").selectpicker('refresh');
    });
    
    $.post("controllers/centro.php?op=listarc",function(respuesta){
    $("#idcentro").html(respuesta);
    $("#idcentro").selectpicker('refresh');
    });
    
     $("#formulario").on("submit",function(e){
       guardaryeditar(e);
    });
    
}

function limpiar(){
    $("#idtickettsm").val("");
    $("#codigo").val("");
    $("#fecha").val("");
    $("#fechapago").val("");
    $("#montop").val("");
    $("#montoret").val("");
    $("#montoc").val("");
    $("#descripcion").val("");
    $("#idcentro").selectpicker("val","");
    /*QUITAR CLASES A LOS ELEMENTOS*/
    $(".form-group").removeClass('has-success has-error');
}

function mostrarform(flag){
    limpiar();
    $("#montoret").attr("disabled", true);
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
					url: 'controllers/tickettsm.php?op=listar',
					type : "get",
					dataType : "json",
					error: function(e){
						console.log(e.responseText);
					}
				},
		"bDestroy": true,
		"iDisplayLength": 25,//Paginacion
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}

function guardaryeditar(e){
    $("#montoret").attr("disabled", false);
    e.preventDefault();
    var formData = new FormData($("#formulario")[0]);
    $.ajax({
       url:"controllers/tickettsm.php?op=guardaryeditar",
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

function mostrar(idtickettsm){
     $.post("controllers/tickettsm.php?op=mostrar",{idtickettsm:idtickettsm},function(data,status){
          /*Convertir la cadena enviada desde PHP a un vector de objetos en JavaScript*/
         data = JSON.parse(data);
         mostrarform(true);
         $("#idtickettsm").val(data.idtickettsm);
         $("#idcliente").val(data.idcliente);
         $("#idcliente").selectpicker('refresh');
         $("#idchofer").val(data.idchofer);
         $("#idchofer").selectpicker('refresh');
         $("#idcentro").val(data.idcentro);
         $("#idcentro").selectpicker('refresh');
         $("#codigo").val(data.codigo);
         $("#fecha").val(data.fecha);
         $("#fechapago").val(data.fechapago);
         $("#montop").val(data.montop);
         $("#montoc").val(data.montoc);
         $("#montoret").val(data.montoret);
         $("#descripcion").val(data.descripcion);
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

function calcularRet(){
    $("#montop").change(function(){
        var monto = $(this).val();
        var ret = monto*0.01;
        $("#montoret").val(ret);
    })
}


init();
