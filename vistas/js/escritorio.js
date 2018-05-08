function init(){
    
    $.post("controllers/tickettsm.php?op=contador",function(respuesta){
    $("#cantS").append(""+respuesta+"");
    });

    $.post("controllers/usuario.php?op=contador",function(respuesta){
    $("#cantU").append(""+respuesta+"");
    });

    $.post("controllers/vehiculo.php?op=contador",function(respuesta){
    $("#cantV").append(""+respuesta+"");
    });
    

}

init();
