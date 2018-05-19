<?php
  if(!$_SESSION['validarTSM']){
      header("location:inicio");
      exit();
  } else {
      if($_SESSION['documentos']==1){
        include_once("vistas/modulos/inc/aside.php");
?>
<!-- INICIO DEL M.VEHICULO -->
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          Control
          <small>Vehiculo de chofer</small>
        </h1>
        <ol class="breadcrumb">
          <li>
            <a href="#">
              <i class="fa fa-dashboard"></i> Inicio</a>
          </li>
          <li class="active">Vehiculos</li>
        </ol>
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h1 class="box-title">Vehiculos</h1>
                  <button class="pull-right btn btn-success" id="btnagregar" onclick="mostrarform(true)">
                    <i class="fa fa-plus-circle"></i> Agregar</button>
                  <div class="box-tools pull-right">
                  </div>
                </div>
                <!-- /.box-header -->
                <!-- centro -->
                <div class="panel-body table-responsive" id="listadoregistros">
                  <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                      <th>Opciones</th>
                      <th>Placa</th>
                      <th>Modelo</th>
                      <th>Año</th>
                      <th>Titulo</th>
                      <th>Estado</th>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                      <th>Opciones</th>
                      <th>Placa</th>
                      <th>Modelo</th>
                      <th>Año</th>
                      <th>Titulo</th>
                      <th>Estado</th>
                    </tfoot>
                  </table>
                </div>
                <div class="panel-body" id="formularioregistros">
                  <form name="formulario" id="formulario" method="POST">
                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <label class="col-sm-12 control-label">Placa *:</label>
                      <input type="hidden" name="idvehiculo" id="idvehiculo">
                      <div class="col-sm-12">
                      <input type="text" class="form-control" name="placa" id="placa" placeholder="Placa" required>
                      </div>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <label class="col-sm-12 control-label">Seguro *:</label>
                      <!-- INCLUIMOS LA CLASE SELECTPICKER -->
                      <div class="col-sm-12">
                      <select id="idseguro" class="form-control selectpicker" data-live-search="true" name="idseguro" required>
                        <option value="">--</option>
                        <option value="V-">A00A</option>
                        <option value="J-">A00B</option>
                      </select>
                      </div>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <label class="col-sm-12 control-label">Titulo:</label>
                      <div class="col-sm-12">
                      <input type="file" class="form-control" name="imagen" id="imagen">
                      <input type="hidden" class="form-control" name="imagenactual" id="imagenactual">
                      <a id="rutarchivo" href="" target="_blank"><img src="" width="150px" height="150px" id="imagenmuestra"></a>
                      </div>
                    </div>
                    <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                      <label class="col-sm-12 control-label">Modelo *:</label>
                      <div class="col-sm-12">
                      <input type="text" class="form-control" name="modelo" id="modelo" required>
                      </div>
                    </div>
                    <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                      <label class="col-sm-12 control-label">Año *:</label>
                      <div class="col-sm-12">
                      <input type="number" class="form-control" name="anovehiculo" id="anovehiculo" required>
                      </div>
                    </div>
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <button class="btn btn-primary" type="submit" id="btnGuardar">
                        <i class="fa fa-save"></i> Guardar</button>
                      <button class="btn btn-danger" type="button" onclick="cancelarform()">
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
                <h4 class="modal-title">Modulo Vehiculo</h4>
              </div>
              <div class="modal-body">
                <div class="box-body">
                  <dl class="dl-horizontal">
                    <dt>Placa</dt>
                    <dd style="text-align:justify">Ingrese el numero de placa del vehiculo respectivo.</dd>
                    <dt>Seguro</dt>
                    <dd style="text-align:justify">Ingrese el codigo de poliza, descrito en la planilla de seguro del vehiculo</dd>
                    <dt>Titulo</dt>
                    <dd style="text-align:justify">Suba el certificado de registro del vehiculo en formato PDF.</dd>
                    <dt>Modelo</dt>
                    <dd style="text-align:justify">Descripcion del modelo del vehiculo.
                    </dd>
                    <dt>Año</dt>
                    <dd style="text-align:justify">Ingrese el año del vehiculo.
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
<?php include_once("vistas/modulos/inc/footer.php"); ?>
<script src="vistas/plugins/datatables/jquery.dataTables.min.js"></script>    
<script src="vistas/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="vistas/plugins/datatables/buttons.html5.min.js"></script>
<script src="vistas/plugins/datatables/buttons.colVis.min.js"></script>
<script src="vistas/plugins/datatables/jszip.min.js"></script>
<script src="vistas/plugins/datatables/pdfmake.min.js"></script>
<script src="vistas/plugins/datatables/vfs_fonts.js"></script> 
<script type="text/javascript" src="vistas/js/vehiculo.js"></script>
</div>
<!-- FIN DEL M.VEHICULO -->
<?php
    } else {
      header("location:escritorio");
      ob_end_flush();
      exit();
    }
  }
?>