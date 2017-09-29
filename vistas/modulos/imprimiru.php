<?php include_once("vistas/modulos/inc/aside.php"); ?>
   <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
   <div class="content-wrapper">
    <link rel="stylesheet" href="vistas/plugins/datarange/daterangepicker.css">
    <section class="content-header">
        <h1>
        Imprimir
        <small>Prepagos y Reportes</small>
      </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Imprimir</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Main row -->
        <div class="row">
            <!-- IMPRIMIR PREPAGO-->
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header" style="padding-bottom:0px"> <i class="fa fa-print"></i>
                        <h3 class="box-title">Pronto-Pago Chofer</h3> </div>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group">
                                    <label class="col-sm-3 col-xs-12 control-label">Chofer:</label>
                                <!-- INCLUIMOS LA CLASE SELECTPICKER -->
                                <div class="input-group col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                    <select id="idchofer" class="form-control selectpicker" data-live-search="true" name="idchofer" required>
                                        <option value="">--</option>
                                        <option value="1">TRANSMARIM</option>
                                        <option value="2">CARIBBEAN</option>
                                    </select>
                                </div>
                              </div>
                      <div class="clearfix"></div>
                      <div class="form-group">
                                <label class="col-sm-3 col-xs-12 control-label">Empresa:</label>
                            <!-- INCLUIMOS LA CLASE SELECTPICKER -->
                            <div class="input-group col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                <select id="idempresa" class="form-control selectpicker" data-live-search="true" name="idempresa" required>
                                    <option value="">--</option>
                                    <option value="1">TRANSMARIM</option>
                                    <option value="2">CARIBBEAN</option>
                                </select>
                            </div>
                          </div>
                            <div class="clearfix"></div>
                            <label class="col-sm-3 col-xs-12 control-label">Rango:</label>
                            <div class="input-group col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control fecharango" id="fechaprepago" required> <span class="input-group-btn">
                        <button type="submit" name="btnTicket" id="btnTicket" class="btn btn-danger btn-flat">Imprimir</button>
                        </span>
                      </div>
                            <!-- /.input group -->
                        </form>
                    </div>
                </div>
            </div>
            <!-- FIN PREPAGO TICKET-->
            <!-- IMPRIMIR SOLO TICKET-->
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header" style="padding-bottom:0px"> <i class="fa fa-print"></i>
                        <h3 class="box-title">Detalle de Ticket</h3> </div>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                            <div class="form-group">
                                <label class="col-sm-3 col-xs-12 control-label">Nº de Ticket</label>
                            </div>
                            <div class="input-group margin col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                <input type="number" class="form-control" name="ticket" id="ticket" required min="1">
                                <input type="hidden" class="form-control" name="idchofer" id="idchofer"> <span class="input-group-btn">
                        <button type="submit" name="btnTicket" id="btnTicket" class="btn btn-danger btn-flat">Imprimir</button>
                        </span> </div>
                        <div class="clearfix"></div>
                                  <label class="col-sm-3 col-xs-12 control-label">Empresa:</label>
                              <!-- INCLUIMOS LA CLASE SELECTPICKER -->
                              <div class="input-group col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                  <select id="idempresa" class="form-control selectpicker" data-live-search="true" name="idempresa" required>
                                      <option value="">--</option>
                                      <option value="1">TRANSMARIM</option>
                                      <option value="2">CARIBBEAN</option>
                                  </select>
                              </div>
                        </form>
                    </div>
                </div>
            </div>
          </div>
          <!-- FIN SOLO TICKET-->
          <div class="row">
            <!-- IMPRIMIR SOLO TICKET-->
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header" style="padding-bottom:0px"> <i class="fa fa-print"></i>
                        <h3 class="box-title">Resumen Pronto-Pago</h3> </div>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                      <div class="form-group">
                                <label class="col-sm-3 col-xs-12 control-label">Empresa:</label>
                            <!-- INCLUIMOS LA CLASE SELECTPICKER -->
                            <div class="input-group col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                <select id="idempresa" class="form-control selectpicker" data-live-search="true" name="idempresa" required>
                                    <option value="">--</option>
                                    <option value="1">TRANSMARIM</option>
                                    <option value="2">CARIBBEAN</option>
                                </select>
                            </div>
                          </div>
                            <div class="clearfix"></div>
                            <label class="col-sm-3 col-xs-12 control-label">Rango:</label>
                            <div class="input-group col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control fecharango" id="fechaprepago" required> <span class="input-group-btn">
                        <button type="submit" name="btnTicket" id="btnTicket" class="btn btn-danger btn-flat">Imprimir</button>
                        </span>
                      </div>
                            <!-- /.input group -->
                        </form>
                    </div>
                </div>
            </div>
            <!-- IMPRIMIR PREPAGO-->
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header" style="padding-bottom:0px"> <i class="fa fa-print"></i>
                        <h3 class="box-title">Servicios por Cliente</h3> </div>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                            <div class="form-group">
                                <label class="col-sm-3 col-xs-12 control-label">Rango</label>
                            </div>
                            <div class="input-group col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control fecharango" id="fechaempresa" required> <span class="input-group-btn">
                        <button type="submit" name="btnTicket" id="btnTicket" class="btn btn-danger btn-flat">Imprimir</button>
                        </span> </div>
                        <div class="clearfix"></div>
                            <div class="form-group">
                                <label class="col-sm-3 col-xs-12 control-label">Cliente:</label>
                            </div>
                            <!-- INCLUIMOS LA CLASE SELECTPICKER -->
                            <div class="input-group col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                <select id="idcliente" class="form-control selectpicker" data-live-search="true" name="idcliente" required>
                                    <option value="">--</option>
                                    <option value="1">TRANSMARIM</option>
                                    <option value="2">CARIBBEAN</option>
                                </select>
                            </div>
                            <!-- /.input group -->
                        </form>
                    </div>
                </div>
            </div>
            <!-- FIN PREPAGO TICKET-->
        </div>
        <!-- /.row (main row) -->
    </section>
    <!-- /.content -->
    <?php include_once("vistas/modulos/inc/footer.php"); ?>
    <script type="text/javascript" src="vistas/plugins/datarange/moment.js"></script>
    <script type="text/javascript" src="vistas/plugins/datarange/daterangepicker.js"></script>
    <script type="text/javascript">function imprimirc(){$("#fechaprepago").daterangepicker({timePicker:!1,timePickerIncrement:30,format:"DD/MM/YYYY"}),$("#fechaempresa").daterangepicker({timePicker:!1,timePickerIncrement:30,format:"DD/MM/YYYY"}),$(".fecharango").daterangepicker({locale:{format:"MM/DD/YYYY",separator:" - ",applyLabel:"Aceptar",cancelLabel:"Cancelar",fromLabel:"Desde",toLabel:"Hasta",customRangeLabel:"Custom",weekLabel:"S",daysOfWeek:["Dom","Lun","Mar","Mier","Jue","Vie","Sab"],monthNames:["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],firstDay:1},linkedCalendars:!1,autoUpdateInput:!0,showCustomRangeLabel:!1})}$(document).ready(imprimirc);</script>
</div>
