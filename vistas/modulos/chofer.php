<?php include_once("vistas/modulos/inc/aside.php"); ?>
   <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
   <div class="content-wrapper">
    <section class="content-header">
        <h1>
        Control
        <small>Choferes</small>
      </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Choferes</li>
        </ol>
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Choferes </h1>
                          <button class="pull-right btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                      <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                          <th>Opciones</th>
                          <th>Nombre</th>
                          <th>Cedula</th>
                          <th>Tlf</th>
                          <th>Imagen</th>
                          <th>Status</th>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                          <th>Opciones</th>
                          <th>Nombre</th>
                          <th>Cedula</th>
                          <th>Tlf</th>
                          <th>Status</th>
                          <th>Imagen</th>
                        </tfoot>
                      </table>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                      <form name="formulario" id="formulario" method="POST">
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Nombre *:</label>
                          <input type="hidden" name="idchofer" id="idchofer">
                           <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" required>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                         <label>Vehiculo *:</label>   <!-- INCLUIMOS LA CLASE SELECTPICKER -->
                          <select id="idvehiculo" class="form-control selectpicker" data-live-search="true" name="idvehiculo" required>
                              <option value="">--</option>
                              <option value="1">1</option>
                              <option value="2">IAO72A</option>
                          </select>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                         <label>Licencia *:</label>   <!-- INCLUIMOS LA CLASE SELECTPICKER -->
                          <select id="idlicencia" class="form-control selectpicker" data-live-search="true" name="idlicencia" required>
                          </select>
                        </div>
                         <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                         <label>Certificado *:</label>   <!-- INCLUIMOS LA CLASE SELECTPICKER -->
                          <select id="idcertificado" class="form-control selectpicker" data-live-search="true" name="idcertificado" required>
                              <option value="">--</option>
                              <option value="1">1</option>
                              <option value="2">VEN23</option>
                          </select>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Cedula *:</label>
                           <input type="number" class="form-control" name="cedula" id="cedula" placeholder="Cedula" required>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                         <label>Telefono :</label> 
                          <input type="number" class="form-control" name="telefono" id="telefono" placeholder="Telefono" min="1" max="99999999999">
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Fecha Nac:</label>
                          <input type="date" class="form-control" name="fechanac" id="fechanac">
                        </div>
                         <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Email :</label>
                           <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Direccion:</label>
                          <textarea class="form-control" name="direccion" id="direccion" placeholder="Direccion" maxlength="45" cols="30" rows="3"></textarea>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Imagen:</label>
                          <input type="file" class="form-control" name="imagen" id="imagen">
                          <input type="hidden" class="form-control" name="imagenactual" id="imagenactual">
                          <img src="" width="150px" height="120px" id="imagenmuestra">
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
                            <h4 class="modal-title">Modulo Chofer</h4>
                          </div>
                          <div class="modal-body">
                             <div class="box-body">
                                          <dl class="dl-horizontal">
                                            <dt>Nombre</dt>
                                            <dd style="text-align:justify">Ingrese el nombre del nuevo chofer en el sistema, se recomienda identificarlo correctamente.</dd>
                                            <dt>Vehiculo</dt>
                                            <dd style="text-align:justify">Seleccione del listado, el vehiculo asignado al chofer, si el vehiculo que desea no se encuentra en la lista, verifique que haya sido registrado, este activo o no se encuentre ya asignado a otro chofer.</dd>
                                            <dt>Licencia</dt>
                                            <dd style="text-align:justify">Seleccione del lista, la licencia asignada al chofer, si la licencia que desea no se encuentra en la lista, verifique que haya sido registrada, este activa o no se encuentre ya asignada a otro chofer.</dd>
                                            <dt>Certificado</dt>
                                            <dd style="text-align:justify">Seleccione del listado, el certificado asignado al chofer, si el certificado que desea no se encuentra en la lista, verifique que haya sido registrado, este activo o no se encuentre ya asignado a otro chofer.</dd>
                                            <dt>Cedula</dt>
                                            <dd style="text-align:justify">Seleccione del listado, la cedula asignada al chofer, si la cedula que desea no se encuentra en la lista, verifique que haya sido registrada, este activa o no se encuentre ya asignada a otro chofer.</dd>
                                            <dt>Telefono</dt>
                                            <dd style="text-align:justify">Ingresar el telefono fijo o movil de contacto del chofer a ingresar.</dd>
                                            <dt>Fecha Nac</dt>
                                            <dd style="text-align:justify">Ingresar la fecha de nacimiento del chofer.</dd>
                                            <dt>Email</dt>
                                            <dd style="text-align:justify">Ingresar el email del chofer, este campo es obligatorio, ya que a esta direccion llegaran los reportes de los pronto pago.</dd>
                                            <dt>Imagen</dt>
                                            <dd style="text-align:justify">Seleccione la imagen del chofer, los formatos permitidos son JPG y PNG. Con resolucion maxima de 50px x 50px</dd>
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
    <script src="vistas/plugins/datatables/jquery.dataTables.min.js"></script>    
    <script src="vistas/plugins/datatables/dataTables.buttons.min.js"></script>
    <script src="vistas/plugins/datatables/buttons.html5.min.js"></script>
    <script src="vistas/plugins/datatables/buttons.colVis.min.js"></script>
    <script src="vistas/plugins/datatables/jszip.min.js"></script>
    <script src="vistas/plugins/datatables/pdfmake.min.js"></script>
    <script src="vistas/plugins/datatables/vfs_fonts.js"></script> 
    <script type="text/javascript" src="vistas/js/chofer.js"></script>
</div>