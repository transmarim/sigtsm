var tabla;

function init(){
    mostrarform(false);
    $("#formulario").on("submit",function(e){
        guardaryeditar(e);
    });
    
    //Mostramos los permisos
	$.post("controllers/usuario.php?op=permisos&id=",function(r){
	        $("#permisos").html(r);
	})
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
           alert(respuesta);
       }
    });
    
    
    
}


init();