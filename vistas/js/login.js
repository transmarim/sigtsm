$("#frmAcceso").on('submit',function(e)
{
	e.preventDefault();
    login = $("#login").val();
    clave = $("#clave").val();
    $.post("controllers/usuario.php?op=verificar",{"logina":login,"clavea":clave},function(data){
        if(data!="null"){
            $(location).attr("href","escritorio");
        }else{
             swal('Error!','Usuario y/o clave incorrectos','error');
        }
    })
});