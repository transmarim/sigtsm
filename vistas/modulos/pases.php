<?php
  if(!$_SESSION['validarTSM']){
      header("location:inicio");
      exit();
  } else {
      if($_SESSION['carteleras']==1){
        include_once("vistas/modulos/inc/aside.php");
?>
<!-- INICIO DEL M.TARIFAS -->
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          Pases
          <small>PDVSA / PBIP</small>
        </h1>
        <ol class="breadcrumb">
          <li>
            <a href="#">
              <i class="fa fa-dashboard"></i> Otros</a>
          </li>
          <li class="active">Pases</li>
        </ol>
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h1 class="box-title">Pases PDVSA / PBIP</h1>
                </div>
                <!-- /.box-header -->
                <div class="panel-body" id="formularioregistros">
                  <form name="formulario" id="formulario" method="POST">
                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <label class="col-sm-12 control-label">Formato *:</label>
                      <div class="col-sm-12">
                      <select id="tipo_pase" class="form-control selectpicker" data-live-search="true" name="tipo_pase" required>
                          <option value="">--</option>
                          <option value="1">INTT</option>
                          <option value="2">PDVSA / BOLIPUERTOS</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <label class="col-sm-12 control-label">Fecha *:</label>
                      <div class="col-sm-12">
                      <input type="date" class="form-control" name="fecha" id="fecha" required>
                      </div>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <label class="col-sm-12 control-label">Choferes *:</label>
                      <ul style="list-style: none;" id="choferes">
                      </ul>
                      <span class="has-error col-sm-12" id="errorToShow"></span>
                    </div>
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <button class="btn btn-primary" type="submit" id="btnGuardar">
                        <i class="fa fa-download"></i> Generar</button>
                      <button class="btn btn-danger" type="button" onclick="cancelarform()">
                        <i class="fa fa-arrow-circle-left"></i> Restablecer</button>
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
                <h4 class="modal-title">Modulo Seguros</h4>
              </div>
              <div class="modal-body">
                <div class="box-body">
                  <dl class="dl-horizontal">
                    <dt>Numero</dt>
                    <dd style="text-align:justify">Ingrese el numero de seguro del vehiculo.</dd>
                    <dt>Vence</dt>
                    <dd style="text-align:justify">Indique la fecha de vencimiento del seguro del vehiculo.</dd>
                    <dt>Tipo</dt>
                    <dd style="text-align:justify">Seleccione el tipo de seguro que posee el vehiculo.</dd>
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
<script type="text/javascript" src="vistas/js/pases.js"></script>
</div>
<!-- FIN DEL M.TARIFAS -->
<?php
    } else {
      header("location:escritorio");
      ob_end_flush();
      exit();
    }
  }
?>