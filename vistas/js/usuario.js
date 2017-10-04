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
       }
    });
    
    
    
}


init();