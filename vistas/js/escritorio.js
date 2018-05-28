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
             swal(respuesta, "Presione OK para continuar");
           }
        });
    }

}

init();
