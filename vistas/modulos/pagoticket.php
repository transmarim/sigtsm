<?php include_once("vistas/modulos/inc/aside.php"); ?>
   <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
   <div class="content-wrapper">
    <section class="content-header">
        <h1>
        Pago
        <small>Tickets</small>
      </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Pago</a></li>
            <li class="active">Tickets</li>
        </ol>
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Pago de Tickets</h1>
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
                            <th>Fecha</th>
                            <th>Chofer</th>
                            <th>Comprobante</th>
                            <th>Monto</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>Opciones</th>
                            <th>Fecha</th>
                            <th>Chofer</th>
                            <th>Comprobante</th>
                            <th>Monto</th>
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" style="height: 400px;" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <label>Chofer(*):</label>
                            <input type="hidden" name="idingreso" id="idingreso">
                            <select id="idproveedor" name="idproveedor" class="form-control selectpicker" data-live-search="true" required>
                              
                            </select>
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Fecha(*):</label>
                            <input type="date" class="form-control" name="fecha_hora" id="fecha_hora" required="">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Tipo de Pago(*):</label>
                            <select name="tipo_comprobante" id="tipo_comprobante" class="form-control selectpicker" required="">
                               <option value="Transferencia">Transferencia</option>
                               <option value="Cheque">Cheque</option>
                               <option value="Efectivo">Efectivo</option>
                            </select>
                          </div>
                          <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <label>Comprobante:</label>
                            <input type="text" class="form-control" name="comprobante" id="comprobante" maxlength="10" placeholder="Comprobante">
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <label>Monto Pagado:</label>
                            <input type="text" class="form-control" name="num_comprobante" id="num_comprobante" maxlength="10" placeholder="Numero" required="">
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a data-toggle="modal" href="#myModal">           
                              <button id="btnAgregarArt" type="button" class="btn btn-primary"> <span class="fa fa-plus"></span> Agregar Tickets</button>
                            </a>
                          </div>

                          <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                              <thead style="background-color:#A9D0F5">
                                    <th>Opciones</th>
                                    <th>Ticket</th>
                                    <th>Agencia</th>
                                    <th>Monto</th>
                                    <th>Subtotal</th>
                                </thead>
                                <tfoot>
                                    <th>TOTAL BS</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th><h4 id="total">0.00 </h4><input type="hidden" name="total_compra" id="total_compra"></th> 
                                </tfoot>
                                <tbody>
                                  
                                </tbody>
                            </table>
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
                                            <dd style="text-align:justify">Seleccione el nombre chofer al cual se le realizara el pago.</dd>
                                            <dt>Fecha</dt>
                                            <dd style="text-align:justify">Indique la fecha en la que se hara el pago al respectivo chofer</dd>
                                            <dt>Tipo de pago</dt>
                                            <dd>Seleccione el metodo por el cual se le realizara el pago al chofer.</dd>
                                            <dt>Comprobante</dt>
                                            <dd>Ingrese el numero de comprobante del recibo de pago.
                                            </dd>
                                            <dt>Monto pagado</dt>
                                            <dd>Ingrese el monto cancelado al chofer por dicho ticket.
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