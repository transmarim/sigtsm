var tabla;

function init(){
    mostrarform(false);
    listar();
    $("#formulario").on("submit",function(e){
        guardaryeditar(e);
    });
    
    $("#imagenmuestra").hide();
    
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
           alert(respuesta);
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
         $("#clave").val(data.clave);
         $("#email").val(data.email);
         $("#idchofer").val(data.idchofer);
         $("#idchofer").selectpicker('refresh');
         /*MOSTRAMOS IMG DE MUESTRA*/
         $("#imagenmuestra").show();
         $("#imagenmuestra").attr("src","vistas/img/usuarios/"+data.imagen);
     });
     $.post('controllers/usuario.php?op=permisos&id='+idusuario,function(respuesta){
         $("#permisos").html(respuesta);
     });
 }
    


init();