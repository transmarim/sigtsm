
function init(){
    listar();
}

function listar(){
    var tabla=$('#tbllistado').DataTable({
        "paging": false,
        "bLengthChange": false //used to hide the property  
    });
    /*FUNCION QUE DETECTA EL CLICK Y EL ID DE LA FILA*/
    /*
      $('#tbllistado').on('click', 'tr', function () {
        var id = tabla.row(this).id();
        alert('Clicked row id ' + id);
    });*/

    var total = 0;
    /*FUNCION QUE DETECTA EL CHANGE Y EL VALOR PARA CANT*/
    $('#tbllistado').on('change', '.normal', function () {

        var id = $(this).val();
        var neto = parseInt($(this).parent().parent().find(".neto").html(), 10);
        var monto = id*neto;
        total = total+monto;

        $("#total").html(total);
    });

}




init();
