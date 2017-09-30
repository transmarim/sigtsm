<?php include_once("vistas/modulos/inc/aside.php"); ?>
   <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
   <div class="content-wrapper">
    <section class="content-header">
        <h1>
        Enviar
        <small>Alertas</small>
      </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Alertas</a></li>
            <li class="active">Enviar Alertas</li>
        </ol>
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Enviar Alertas</h1>
                          <button class="pull-right btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button>
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
                            <tr>
                              <td>123456</td>
                              <td></td>
                              <td style="text-align:center;"><a data-toggle="modal" href="#myModal"><button id="btnAgregarArt" type="button" class="btn btn-warning btn-social"><span class="fa fa-dropbox"></span>Enviar Alerta</button>
                                </a>
                              </td>
                            </tr>
                          </tbody>
                          <tfoot>
                            <th>Cedula</th>
                            <th>Chofer</th>
                            <th>Opciones</th>
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Chofer(*):</label>
                            <input type="hidden" name="idchofer" id="idchofer">
                            <select id="idchofer" name="idchofer" class="form-control selectpicker" data-live-search="true" required>
                            </select>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Asunto(*):</label>
                            <select id="asunto" name="asunto" class="form-control selectpicker" data-live-search="true" required>
                              <option value="">DOCUMENTOS VENCIDOS</option>
                              <option value="">CEDULA VENCIDA</option>
                            </select>
                          </div>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label>Cuerpo del mensaje:</label>
                            <textarea class="form-control" name="descripcion" id="descripcion" placeholder="Descripcion" maxlength="255" cols="30" rows="3"></textarea>
                          </div>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                            <button id="btnCancelar" class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
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
                            <h4 class="modal-title">Modulo Pago de Tickets</h4>
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
      </section><!-- /.content -->
      <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Seleccione Tickets Pagados</h4>
        </div>
        <div class="modal-body">
          <table id="tblarticulos" class="table table-striped table-bordered table-condensed table-hover">
            <thead>
                <th>Ticket</th>
                <th>Monto</th>
                <th>Agencia</th>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
                <th>Ticket</th>
                <th>Monto</th>
                <th>Agencia</th>
            </tfoot>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Fin modal -->

       </section>

    <!-- Main content -->

    <!-- /.content -->
    <?php include_once("vistas/modulos/inc/footer.php"); ?>
</div>
