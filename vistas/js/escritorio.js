function init(){

    $("#formulario").on("submit",function(e){
            guardaryeditar(e);
    });
    
    $.post("controllers/tickettsm.php?op=contador",function(respuesta){
    $("#cantS").append(""+respuesta+"");
    });

    $.post("controllers/usuario.php?op=contador",function(respuesta){
    $("#cantU").append(""+respuesta+"");
    });

    $.post("controllers/vehiculo.php?op=contador",function(respuesta){
    $("#cantV").append(""+respuesta+"");
    });

    $.post("controllers/chofer.php?op=contador",function(respuesta){
    $("#cantC").append(""+respuesta+"");
    });

    function cargarChat(){
    $.post("controllers/chat.php?op=mostrar",function(data,status){
        /*Convertir la cadena enviada desde PHP a un vector de objetos en JavaScript*/
        $("#chat-box").html('');
        data = JSON.parse(data);
        $.each(data, function(i, item) {
        $("#chat-box").append('<div class="item"> <img src="vistas/img/usuarios/'+item[3]+'" alt="user image" class="online"> <p class="message"> <a href="#" class="name"> <small class="text-muted pull-right"> <i class="fa fa-clock-o"></i> '+item[1]+'</small> '+item[0]+' </a> '+item[4]+' </p> </div>');
        });
    });
}

    function guardaryeditar(e){
        e.preventDefault();
        var formData = new FormData($("#formulario")[0]);
        $.ajax({
           url:"controllers/chat.php?op=guardaryeditar",
           type:"POST",
           data: formData,
           contentType: false,
           processData: false,
           success: function(respuesta){
             limpiar();
             cargarChat();
           }
        });
    }

    function limpiar(){
        $("#mensaje").val("");
    }

    cargarChat();
}

init();
