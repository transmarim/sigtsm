<?php
  if(!$_SESSION['validarTSM']){
      header("location:inicio");
      exit();
  } else {
      if($_SESSION['ingresar']==1){
        include_once("vistas/modulos/inc/aside.php");
?>
<!-- INICIO DEL M.CHOFER -->
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
                          <label class="col-sm-12 control-label" for="nombre">Nombre *:</label>
                          <input type="hidden" name="idchofer" id="idchofer">
                          <div class="col-sm-12">
                           <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" required>
                           </div>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                         <label class="col-sm-12 control-label" for="vehiculo" >Vehiculo *:</label>   <!-- INCLUIMOS LA CLASE SELECTPICKER -->
                         <div class="col-sm-12">
                          <select id="idvehiculo" class="form-control selectpicker" data-live-search="true" name="idvehiculo" required>
                          </select>
                          </div>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                         <label class="col-sm-12 control-label" for="licencia">Licencia *:</label>   <!-- INCLUIMOS LA CLASE SELECTPICKER -->
                         <div class="col-sm-12">
                          <select id="idlicencia" class="form-control selectpicker" data-live-search="true" name="idlicencia" required>
                          </select>
                         </div>
                        </div>
                         <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                         <label class="col-sm-12 control-label" for="certificado">Certificado *:</label>   <!-- INCLUIMOS LA CLASE SELECTPICKER -->
                         <div class="col-sm-12">
                          <select id="idcertificado" class="form-control selectpicker" data-live-search="true" name="idcertificado" required>
                          </select>
                          </div>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label class="col-sm-12 control-label" for="cedula">Cedula *:</label>
                          <div class="col-sm-12">
                           <input type="number" class="form-control" name="cedula" id="cedula" placeholder="Cedula" required>
                           </div>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                         <label class="col-sm-12 control-label" for="telefono">Telefono :</label>
                         <div class="col-sm-12">
                          <input type="number" class="form-control" name="telefono" id="telefono" placeholder="Telefono" min="1" max="99999999999">
                         </div>
                        </div>                        
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label class="col-sm-12 control-label" for="fechanac">Fecha Nac:</label>
                          <div class="col-sm-12">
                          <input type="date" class="form-control" name="fechanac" id="fechanac" required>
                          </div>
                        </div>
                         <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label class="col-sm-12 control-label" for="email">Email :</label>
                           <div class="col-sm-12">
                           <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                           </div>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label class="col-sm-12 control-label" for="direccion">Direccion:</label>
                          <div class="col-sm-12">
                          <textarea class="form-control" name="direccion" id="direccion" placeholder="Direccion" maxlength="45" cols="30" rows="3"></textarea>
                        </div>
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
<!-- FIN DEL M.CHOFER -->
<?php
    } else {
      header("location:escritorio");
      ob_end_flush();
      exit();
    }
  }
?>
