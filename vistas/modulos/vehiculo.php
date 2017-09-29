<?php include_once("vistas/modulos/inc/aside.php"); ?>
   <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
   <div class="content-wrapper">
    <section class="content-header">
        <h1>
        Control
        <small>Vehiculos</small>
      </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Vehiculos</li>
        </ol>
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Vehiculos</h1>
                          <button class="pull-right btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                      <table id="tblistado" class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                          <th>PLACA</th>
                          <th>MODELO</th>
                          <th>AÑO</th>
                          <th>ESTADO</th>
                          <th>OPCIONES</th>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                        <th>PLACA</th>
                        <th>MODELO</th>
                        <th>AÑO</th>
                        <th>ESTADO</th>
                        <th>OPCIONES</th>
                        </tfoot>
                      </table>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                      <form name="formulario" id="formulario" method="POST">
                         <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Placa *:</label>
                          <input type="hidden" name="idseguro" id="idseguro">
                           <input type="text" class="form-control" name="placa" id="placa" placeholder="Placa" required>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                         <label>Seguro *:</label>   <!-- INCLUIMOS LA CLASE SELECTPICKER -->
                          <select id="idseguro" class="form-control selectpicker" data-live-search="true" name="idseguro" required>
                              <option value="">--</option>
                              <option value="V-">A00A</option>
                              <option value="J-">A00B</option>
                          </select>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Titulo:</label>
                          <input type="file" class="form-control" name="imagen" id="imagen">
                          <input type="hidden" class="form-control" name="imagenactual" id="imagenactual">
                          <img src="" width="150px" height="120px" id="imagenmuestra">
                        </div>
                        <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                          <label>Modelo *:</label>
                          <input type="text" class="form-control" name="modelo" id="modelo" required>
                        </div>
                        <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                          <label>Año *:</label>
                          <input type="number" class="form-control" name="anovehiculo" id="anovehiculo" required>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                          <button class="btn btn-danger" type="button" onclick="cancelarform()"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-primary">
                            Ayuda
                            </button>
                        </div>
                      </form>
                    </div>
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section>
        <div class="modal modal-primary fade" id="modal-primary">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                              <span aria-hidden="true">×</span></button>
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
    <!-- Main content -->

    <!-- /.content -->
    <?php include_once("vistas/modulos/inc/footer.php"); ?>
</div>
