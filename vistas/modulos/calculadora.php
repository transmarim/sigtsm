<?php
  if(!$_SESSION['validarTSM']){
      header("location:inicio");
      exit();
  } else {
    include_once("vistas/modulos/inc/aside.php");
?>
<!-- INICIO DEL M.DATOSVC -->
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    Calculadora
                    <small>de Tickets</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="#">
                            <i class="fa fa-dashboard"></i> Inicio</a>
                    </li>
                    <li class="active">Calculadora</li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h1 class="box-title">Calculadora de Tickets </h1>
                </div>
                <!-- /.box-header -->
                <!-- centro -->
                <div class="panel-body table-responsive" id="listadoregistros">
                  <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                      <th>Ruta</th>
                      <th>Neto</th>
                      <th>D. Normal</th>
                      <th>D. Feriado</th>
                    </thead>
                    <tbody>
                    <tr id="vergacion">
                    <td>Hola</td>
                    <td class="neto">2000</td>
                    <td><input class="normal" type="number" step="1" max="10" min="0"></td>
                    <td><input type="number"></td>
                    </tr>
                    <tr id="trimardito">
                    <td>Hola</td>
                    <td class="neto">2000</td>
                    <td><input class="normal" type="number" step="1" max="10" min="0"></td>
                    <td><input type="number"></td>
                    </tr>
                    <tfoot>
                      <th>TOTAL BS S.</th>
                      <th></th>
                      <th></th>
                      <th id="total"></th>
                    </tfoot>
                    </tbody>
                  </table>
                </div>
                <!--Fin centro -->
              </div>
              <!-- /.box -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </section>
            <!-- /.content -->
<?php include_once("vistas/modulos/inc/footer.php"); ?>
<script src="vistas/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="vistas/js/calculadora.js"></script>
        </div>
<!--FIN M. DATOSVC -->
<?php
    } ob_end_flush();
?>