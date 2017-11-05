<?php include_once("vistas/modulos/inc/aside.php"); ?>
   <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
   <div class="content-wrapper">
    <section class="content-header">
        <h1>
        Control
        <small>Tickets TSM</small>
      </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Tickets</li>
        </ol>
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Tickets TSM </h1>
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
                          <th>Chofer</th>
                          <th>Fecha</th>
                          <th>Ticket</th>
                          <th>Agencia</th>
                          <th>Buque</th>
                          <th>Monto</th>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                           <th>Opciones</th>
                          <th>Chofer</th>
                          <th>Fecha</th>
                          <th>Ticket</th>
                          <th>Agencia</th>
                          <th>Buque</th>
                          <th>Monto</th>
                        </tfoot>
                      </table>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                      <form name="formulario" id="formulario" method="POST">
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Cliente *:</label>
                          <input type="hidden" name="idtickettsm" id="idtickettsm">
                          <select id="idcliente" class="form-control selectpicker" data-live-search="true" name="idcliente"></select>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                         <label>Chofer *:</label>   <!-- INCLUIMOS LA CLASE SELECTPICKER -->
                          <select id="idchofer" class="form-control selectpicker" data-live-search="true" name="idchofer"></select>
                        </div>
                         <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                         <label>Buque *:</label>   <!-- INCLUIMOS LA CLASE SELECTPICKER -->
                          <select id="idcentro" class="form-control selectpicker" data-live-search="true" name="idcentro"></select>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Codigo *:</label>
                          <input type="number" class="form-control" name="codigo" id="codigo" step="1" placeholder="Codigo del ticket" required>
                        </div>
                         <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Fecha Pago *:</label>
                          <input type="date" class="form-control" name="fechapago" id="fechapago" required>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Fecha Posteo *:</label>
                          <input type="date" class="form-control" name="fecha" id="fecha" required>
                        </div>
                         <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Monto a Pagar *:</label>
                          <input type="number" class="form-control" name="montop" id="montop" step="0.1" required>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Monto a Retener <span style="color:red">1%</span>:</label>
                          <input type="number" class="form-control" name="montoret" id="montoret" required disabled>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Monto a Cobrar:</label>
                          <input type="number" class="form-control" name="montoc" id="montoc" step="0.1">
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Descripcion:</label>
                          <textarea class="form-control" name="descripcion" id="descripcion" placeholder="Descripcion" maxlength="255" cols="30" rows="3"></textarea>
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
      </section><!-- /.content -->
        <div class="modal modal-primary fade" id="modal-primary">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                              <span aria-hidden="true">×</span></button>
                            <h4 class="modal-title">Modulo Tickets TSM</h4>
                          </div>
                          <div class="modal-body">
                             <div class="box-body">
                                          <dl class="dl-horizontal">
                                            <dt>Cliente</dt>
                                            <dd style="text-align:justify">Seleccione el cliente que aparece en el ticket o boleta y al cual fue realizado el servicio, este debe estar activo y/o previamente registrado en el sistema.</dd>
                                            <dt>Chofer</dt>
                                            <dd style="text-align:justify">Indique el chofer que ejecuto el servicio y/o boleta.</dd>
                                            <dt>Buque</dt>
                                            <dd style="text-align:justify">Seleccione el buque o centro de costo propocionado por el cliente para recargo del servicio, este debe estar activo y/o previamente registrado en el sistema.</dd>
                                            <dt>Codigo</dt>
                                            <dd style="text-align:justify">Indique el codigo unico, que se encuentra en la parte superior derecha de la boleta o ticket de servicio a ingresar.</dd>
                                            <dt>Fecha de Pago</dt>
                                            <dd style="text-align:justify">Agregue la fecha o semana en la cual se planea realizar el pago por el servicio, esta sera usada como referencia para la elaboracion de reportes pronto pago.</dd>
                                            <dt>Fecha de Posteo</dt>
                                            <dd style="text-align:justify">Señale la fecha en la cual fue realizado el servicio, este debe coincidir con el soporte fisico respectivo.</dd>
                                            <dt>Monto a Pagar</dt>
                                            <dd style="text-align:justify">Indique el monto a pagar por el servicio realizado al proveedor.</dd>
                                             <dt>Monto a Retener</dt>
                                            <dd style="text-align:justify">Campo automatico, su calculo esta establecido por el 1% por sobre la base o monto a pagar por concepto de ISLR. Solo es modificable por el administrador del sistema.</dd>
                                            <dt>Monto a Cobrar</dt>
                                            <dd style="text-align:justify">Ingrese el monto a cobrar al cliente por el servicio, este campo no es obligatario, sirve solo para informacion adicional.</dd>
                                            <dt>Descripcion</dt>
                                            <dd style="text-align:justify">Escriba la descripcion del servicio realizado, ruta, puntos, entre otros.</dd>
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
    <script type="text/javascript" src="vistas/js/tickettsm.js"></script>
</div>