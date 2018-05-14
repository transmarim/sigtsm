<?php
  if(!$_SESSION['validarTSM']){
      header("location:inicio");
      exit();
  } else {
      if($_SESSION['prontopago']==1){
        include_once("vistas/modulos/inc/aside.php");
?>
<!-- INICIO DEL M.PRONTOPAGO -->
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
  <link rel="stylesheet" href="vistas/plugins/datarange/daterangepicker.css">
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          Enviar
          <small>Pronto-Pago</small>
        </h1>
        <ol class="breadcrumb">
          <li>
            <a href="#">
              <i class="fa fa-dashboard"></i>Inicio</a>
          </li>
          <li class="active">Pronto-Pago</li>
        </ol>
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h1 class="box-title">Enviar Pronto-Pago</h1>
                  <div class="box-tools pull-right">
                  </div>
                </div>
                <!-- /.box-header -->
                <!-- centro -->
                <div class="panel-body table-responsive" id="listadoregistros">
                  <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                      <th>Cedula</th>
                      <th>Chofer</th>
                      <th>Opciones</th>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                      <th>Cedula</th>
                      <th>Chofer</th>
                      <th>Opciones</th>
                    </tfoot>
                  </table>
                  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-primary">Ayuda
                  </button>
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
                <h4 class="modal-title">Modulo Alertas</h4>
              </div>
              <div class="modal-body">
                <div class="box-body">
                  <dl class="dl-horizontal">
                    <dt>Chofer</dt>
                    <dd style="text-align:justify">Seleccione el nombre chofer al cual se le realizará el pago.</dd>
                    <dt>Fecha</dt>
                    <dd style="text-align:justify">Indique la fecha en la que se hará el pago al respectivo chofer</dd>
                    <dt>Tipo de pago</dt>
                    <dd style="text-align:justify">Seleccione el metodo por el cual se le realizará el pago al chofer.</dd>
                    <dt>Comprobante</dt>
                    <dd style="text-align:justify">Ingrese el numero de comprobante del recibo de pago.
                    </dd>
                    <dt>Agregar Ticket</dt>
                    <dd style="text-align:justify">Seleccione de la ventana los tickets pendientes por pagar al chofer.
                    </dd>
                    <dt>Monto pagado</dt>
                    <dd style="text-align:justify">Ingrese el monto cancelado al chofer por los tickets seleccionados.
                    </dd>
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
      </section>
      <!-- /.content -->
      <!-- Modal -->
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Formulario de Pronto-Pago</h4>
            </div>
            <div class="modal-body">
              <div class="panel-body" id="formularioregistros">
                <form name="formulario" id="formulario" method="POST">
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Chofer(*):</label>
                    <input type="hidden" name="idchofer" id="idchofer">
                    <input type="hidden" name="email" id="email">
                    <input type="text" class="form-control" id="nombre" name="nombre" required disabled>
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Asunto(*):</label>
                    <select id="asunto" name="asunto" class="form-control selectpicker" data-live-search="true" required>
                      <option value="PRONTO PAGO SEMANAL">PRONTO PAGO SEMANAL</option>
                    </select>
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Rango:</label>
                    <input type="text" class="form-control fecharango" id="fechaprepago" required>
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Empresa:</label>
                    <select id="idempresa" class="form-control selectpicker" data-live-search="true" name="idempresa" required>
                      <option value="">--</option>
                      <option value="1">TRANSMARIM</option>
                      <option value="2">CARIBBEAN</option>
                    </select>
                  </div>
                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <button class="btn btn-primary" type="submit" id="btnGuardar">
                      <i class="fa fa-download"></i> Generar</button>
                    <button id="btnCancelar" class="btn btn-danger" onclick="cancelarform()" type="button">
                      <i class="fa fa-trash"></i> Limpiar</button>
                  </div>
                </form>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
      <!-- Fin modal -->
      </section>
<?php include_once("vistas/modulos/inc/footer.php"); ?>
<script src="vistas/plugins/datatables/jquery.dataTables.min.js"></script>    
<script src="vistas/plugins/datatables/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="vistas/plugins/datarange/moment.js"></script>
<script type="text/javascript" src="vistas/plugins/datarange/daterangepicker.js"></script>
<script type="text/javascript">function imprimirc(){$("#fechaprepago").daterangepicker({timePicker:!1,timePickerIncrement:30,format:"DD/MM/YYYY"}),$("#fechaempresa").daterangepicker({timePicker:!1,timePickerIncrement:30,format:"DD/MM/YYYY"}),$(".fecharango").daterangepicker({locale:{format:"MM/DD/YYYY",separator:" - ",applyLabel:"Aceptar",cancelLabel:"Cancelar",fromLabel:"Desde",toLabel:"Hasta",customRangeLabel:"Custom",weekLabel:"S",daysOfWeek:["Dom","Lun","Mar","Mier","Jue","Vie","Sab"],monthNames:["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],firstDay:1},linkedCalendars:!1,autoUpdateInput:!0,showCustomRangeLabel:!1})}$(document).ready(imprimirc);</script>
<script type="text/javascript" src="vistas/js/prontopago.js"></script> 
</div>
<!-- FIN DEL M.PRONTOPAGO -->
<?php
    } else {
      header("location:escritorio");
      ob_end_flush();
      exit();
    }
  }
?>