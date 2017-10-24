var tabla;
var bandera;
function init(){
    mostrarform(false);
    listar();
    
    validarinput('#numero',/^[0-9]+$/);
    
     $("#formulario").on("submit",function(e){
       guardaryeditar(e);
    });
    
}

function limpiar(){
    $("#idcertificado").val("");
    $("#numero").val("");
    $("#fechaven").val("");

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
					url: 'controllers/certificado.php?op=listar',
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
     $.post("controllers/certificado.php?op=mostrar",{idcertificado:idcertificado},function(data,status){
          /*Convertir la cadena enviada desde PHP a un vector de objetos en JavaScript*/
         data = JSON.parse(data);
         mostrarform(true);
         $("#idcertificado").val(data.idcertificado);
         $("#numero").val(data.numero);
         $("#fechaven").val(data.fechaven);
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

function validarinput(idcampo,texto){
    $(idcampo).change(function(){
          var expreTexto = texto;
          var cajetin = $(this).parent();
          if(!expreTexto.test($(this).val())){
              if(cajetin.hasClass("has-success")){
                cajetin.removeClass("has-success");
              } 
              cajetin.addClass("has-error");
              bandera = true;
          } else {
              if(cajetin.hasClass("has-error")){
                cajetin.removeClass("has-error");
              }
             cajetin.addClass("has-success");
              bandera = false;
          } 
      });
}

init();
