
function init(){
    listar();
    calcular();
}

function calcular(){
    var tabla=$('#tbllistado').DataTable({
        "paging": false,
        "bInfo" : false,
        "searching": false,
        "bLengthChange": false //used to hide the property  
    });
    /*FUNCION QUE DETECTA EL CLICK Y EL ID DE LA FILA*/
    /*
      $('#tbllistado').on('click', 'tr', function () {
        var id = tabla.row(this).id();
        alert('Clicked row id ' + id);
    });*/

    var total = 0;
    var totalFeriado = 0;
    /*FUNCION QUE DETECTA EL CHANGE Y EL VALOR PARA CANT*/
    $('#tbllistado').on('change', '.normal', function () {
        var id = $(this).val();
        /*DESACTIVAMOS EL INPUT*/
        $(this).prop('disabled', true);
        var neto = parseInt($(this).parent().parent().find(".neto").html(), 10);
        var monto = id*neto;
        total = total+monto;
        totalFeriado = total+(total*0.20);
        $("#total").html('Normal: '+total+' / Feriado: '+totalFeriado);
    });
}

function listar(){
    $.post('controllers/tarifas.php?op=listarHTML',function(respuesta){
        $("#contenido").html(respuesta);
    });
}




init();
