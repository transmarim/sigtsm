<?php include_once("vistas/modulos/inc/aside.php"); ?>
   <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
   <div class="content-wrapper">
    <section class="content-header">
        <h1>
        Control
        <small>Buques</small>
      </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Buques</li>
        </ol>
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Buques </h1>
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
                          <th>Codigo</th>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                          <th>Opciones</th>
                          <th>Nombre</th>
                          <th>Codigo</th>
                        </tfoot>
                      </table>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                      <form name="formulario" id="formulario" method="POST">
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Nombre *:</label>
                          <input type="hidden" name="idcentro" id="idcentro">
                           <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" required>
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
                            <h4 class="modal-title">Modulo Buques</h4>
                          </div>
                          <div class="modal-body">
                             <div class="box-body">
                                          <dl class="dl-horizontal">
                                            <dt>Nombre</dt>
                                            <dd style="text-align:justify">Ingrese el nombre del buque que desea afliliar en el sistema, o en su defecto un centro de costo para las boletas de servicio.</dd>
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
    <script type="text/javascript" src="vistas/js/centro.js"></script>
</div>