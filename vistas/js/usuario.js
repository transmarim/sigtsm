var tabla;

function init(){
    mostrarform(false);
    listar();
    $("#imagenmuestra").hide();

    //Mostramos los permisos
	$.post("controllers/usuario.php?op=permisos&id=",function(r){
	        $("#permisos").html(r);
	})
    validarimg();
    validarinput('#nombre',/^[a-zA-Z]+(\s*[a-zA-Z]*)*[a-zA-Z]+$/);
    validarinput('#login',/^[a-z\d_]{4,15}$/i);
    validarinput('#clave',/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/);
    validarinput('#email',/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/);
    
     $("#formulario").on("submit",function(e){
        guardaryeditar(e);
    });
    
}

function limpiar(){
    $("#idusuario").val("");
    $("#nombre").val("");
    $("#login").val("");
    $("#clave").val("");
    $("#email").val("");
    $("#idchofer").selectpicker("val","");
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

function listar(){
    tabla=$('#tbllistado').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginaci├│n y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: 'controllers/usuario.php?op=listar',
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

function cancelarform(){
    mostrarform(false);
    limpiar();
}

function guardaryeditar(e){
    e.preventDefault();
    /*$("#btnGuardar").prop("disabled",true);*/
    var formData = new FormData($("#formulario")[0]);
    $.ajax({
       url:"controllers/usuario.php?op=guardaryeditar",
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

 function mostrar(idusuario){
     $.post("controllers/usuario.php?op=mostrar",{idusuario:idusuario},function(data,status){
          // Convertir la cadena enviada desde PHP a un vector de objetos en JavaScript
         data = JSON.parse(data);
         /*LLAMO MOSTRAR FORM*/
         mostrarform(true);
         $("#idusuario").val(data.idusuario);
         $("#nombre").val(data.nombre);
         $("#login").val(data.login);
         $("#email").val(data.email);
         $("#idchofer").val(data.idchofer);
         $("#idchofer").selectpicker('refresh');
         /*MOSTRAMOS IMG DE MUESTRA*/
         $("#imagenmuestra").show();
         $("#imagenmuestra").attr("src","vistas/img/usuarios/"+data.imagen);
         $("#imagenactual").val(data.imagen);
     });
     $.post('controllers/usuario.php?op=permisos&id='+idusuario,function(respuesta){
         $("#permisos").html(respuesta);
     });
 }

 function desactivar(idusuario){
    swal({
        title: "Esta seguro..?"
        , text: "Al desactivar este usuario, no podra ingresar al sistema"
        , type: "warning"
        , showCancelButton: true
        , confirmButtonColor: "#da4f49"
        , confirmButtonText: "Si, deseo desactivarlo!"
        , closeOnConfirm: false
        }, function () {
            $.post('controllers/usuario.php?op=desactivar',{idusuario:idusuario},function(e){
            swal("Desactivado!", e , "success");  
            tabla.ajax.reload();
            });
        });
 }

 function activar(idusuario){
    swal({
        title: "Esta seguro..?"
        , text: "Al activar este usuario, podra reingresar al sistema"
        , type: "warning"
        , showCancelButton: true
        , confirmButtonColor: "#da4f49"
        , confirmButtonText: "Si, deseo activarlo!"
        , closeOnConfirm: false
        }, function () {
            $.post('controllers/usuario.php?op=activar',{idusuario:idusuario},function(e){
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
         if(Number(imagenSize)<500000 && (imagenType == "image/jpeg" || imagenType == "image/png")){
             swal('Excelente!','La imagen cumple con los parametros permitidos.','success');
         }else{
             swal('Error!','El archivo que intenta subir no cumple con los parametros permitidos.','error');
             $("#imagen").val("");
         }
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
          } else {
              if(cajetin.hasClass("has-error")){
                  cajetin.removeClass("has-error");
              }
              cajetin.addClass("has-success");
          } 
      })
}

init();
