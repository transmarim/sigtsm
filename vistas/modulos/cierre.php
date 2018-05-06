<?php
  if(!$_SESSION['validarTSM']){
      header("location:inicio");
      exit();
  } else {
      if($_SESSION['permisos']==1){
        include_once("vistas/modulos/inc/aside.php");
?>
<!-- INICIO DEL M.USUARIO -->
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <div class="content-wrapper">
    <link rel="stylesheet" href="vistas/plugins/datarange/daterangepicker.css">
      <section class="content-header">
        <h1>
          Cierre
          <small>Sistema</small>
        </h1>
        <ol class="breadcrumb">
          <li>
            <a href="#">
              <i class="fa fa-dashboard"></i> Inicio</a>
          </li>
          <li class="active">Cierre</li>
        </ol>
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h1 class="box-title">Cierre del Sistema</h1>
                  <button class="pull-right btn btn-success" id="btnagregar" onclick="mostrarform(true)">
                    <i class="fa fa-plus-circle"></i> Habilitar</button>
                  <div class="box-tools pull-right">
                  </div>
                </div>
                <!-- /.box-header -->
                <!-- centro -->
                <div class="panel-body" id="formularioregistros">
                  <form name="formulario" id="formulario" method="POST">
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <label>Rango de Cierre (*):</label>
                      <input type="text" class="form-control fecharango" id="fechaprepago" required>
                    </div>
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <label>ADVERTENCIA:</label><p>Al aplicar el cierre del sistema, los tickets realizados dentro del periodo, pasaran a ser procesados y no estaran disponibles para futuras modificaciones. Si desea revertir un ticket ya cerrado, contacte con el Desarrollador del Sistema.</p>
                    </div>
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <button class="btn btn-primary" type="submit" id="btnGuardar">
                        <i class="fa fa-lock"></i> Cerrar</button>
                      <button class="btn btn-danger" onclick="cancelarform()" type="button">
                        <i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-primary">
                        Ayuda
                      </button>
                    </div>
                  </form>
                </div>
                <!--Fin centro -->
              </div>
              <!-- /.box -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </section>
        <div class="modal modal-primary fade" id="modal-primary">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                  <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Modulo Cierre de Sistema</h4>
              </div>
              <div class="modal-body">
                <div class="box-body">
                  <dl class="dl-horizontal">
                    <dt>Rango del Cierre</dt>
                    <dd style="text-align:justify">Seleccione rango o periodo para realizar el cierre del sistema.</dd>
                    <dt>Cerrar</dt>
                    <dd style="text-align:justify">Seleccione cerrar para aplicar el cierre del sistema</dd>
                  </dl>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
      </section>
<?php include_once("vistas/modulos/inc/footer.php"); ?>
<script type="text/javascript" src="vistas/plugins/datarange/moment.js"></script>
<script type="text/javascript" src="vistas/plugins/datarange/daterangepicker.js"></script>
<script type="text/javascript" src="vistas/js/cierre.js"></script>
<script type="text/javascript">function imprimirc(){$("#fechaprepago").daterangepicker({timePicker:!1,timePickerIncrement:30,format:"DD/MM/YYYY"}),$("#fechaempresa").daterangepicker({timePicker:!1,timePickerIncrement:30,format:"DD/MM/YYYY"}),$(".fecharango").daterangepicker({locale:{format:"MM/DD/YYYY",separator:" - ",applyLabel:"Aceptar",cancelLabel:"Cancelar",fromLabel:"Desde",toLabel:"Hasta",customRangeLabel:"Custom",weekLabel:"S",daysOfWeek:["Dom","Lun","Mar","Mier","Jue","Vie","Sab"],monthNames:["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],firstDay:1},linkedCalendars:!1,autoUpdateInput:!0,showCustomRangeLabel:!1})}$(document).ready(imprimirc);</script>
</div>
<!-- FIN DEL M.USUARIO -->
<?php
    } else {
      header("location:escritorio");
      ob_end_flush();
      exit();
    }
  }
?>