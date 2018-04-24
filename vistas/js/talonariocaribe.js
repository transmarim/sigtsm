var tabla;
var bandera;
function init(){
    mostrarform(false);
    listar();
    
    validarinput('#desde',/^[0-9]+$/);
    validarinput('#hasta',/^[0-9]+$/);
    
    $.post("controllers/chofer.php?op=selectc",function(r){
        $("#idchofer").html(r);   
        $("#idchofer").selectpicker('refresh');
        });
    
     $("#formulario").on("submit",function(e){
       guardaryeditar(e);
    });
    
}

function limpiar(){
    $("#idtalonario").val("");
    $("#idchofer").selectpicker("val","");
    $("#desde").val("");
    $("#hasta").val("");
    $("#fecha").val("");
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
					url: 'controllers/talonariocaribe.php?op=listar',
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
       url:"controllers/talonariocaribe.php?op=guardaryeditar",
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

function mostrar(idtalonario){
     $.post("controllers/talonariocaribe.php?op=mostrar",{idtalonario:idtalonario},function(data,status){
          /*Convertir la cadena enviada desde PHP a un vector de objetos en JavaScript*/
         data = JSON.parse(data);
         mostrarform(true);
        $("#idtalonario").val(data.idtalonario);
        $("#idchofer").val(data.idchofer);
        $("#idchofer").selectpicker('refresh');
        $("#desde").val(data.desde);
        $("#hasta").val(data.hasta);
        $("#fecha").val(data.fecha);
     });
    }

 function eliminar(idtalonario){
    swal({
        title: "Esta seguro..?"
        , text: "Al eliminar este talonario, no podra utilizarse en el sistema"
        , type: "warning"
        , showCancelButton: true
        , confirmButtonColor: "#da4f49"
        , confirmButtonText: "Si, deseo eliminarla!"
        , closeOnConfirm: false
        }, function () {
            $.post('controllers/talonariocaribe.php?op=eliminar',{idtalonario:idtalonario},function(e){
            swal("Eliminada!", e , "success");  
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

function imprimir(idtalonario){
    var formData = new FormData();
    var talonario = idtalonario;
    formData.append("idtalonario",idtalonario);
    $.ajax({
        url:"controllers/imprimiru.php?op=reporteTalonarioC",
        type:"POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(respuesta){
          swal({
            title: "Reporte de Entrega"
            , text: "Ha sido generado, continue para imprimir"
            , type: "info"
            , showCancelButton: true
            , confirmButtonColor: "#da4f49"
            , confirmButtonText: "Imprimir!"
            , closeOnConfirm: true
            }, function () {
                window.open(respuesta,"_blank");
            });
        }
     });
}

init();
