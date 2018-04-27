<?php
  if(!$_SESSION['validarTSM']){
      header("location:inicio");
      exit();
  } else {
      if($_SESSION['reportes']==1){
        include_once("vistas/modulos/inc/aside.php");
?>
<!-- INICIO DEL M.IMPRIMIRU-->
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <div class="content-wrapper">
            <link rel="stylesheet" href="vistas/plugins/datarange/daterangepicker.css">
            <section class="content-header">
                <h1>
                    Reportes
                    <small>Prepagos y relaciones</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="#">
                            <i class="fa fa-dashboard"></i> Inicio</a>
                    </li>
                    <li class="active">Imprimir</li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <!-- MENU IMPRESION -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Opciones de Reportes</h3>
                            </div>
                            <div class="box-body">
                                <button type="button" class="btn btn-social btn-block btn-lg btn-github" onclick="mostrarform(true,1)">
                                    <i class="fa fa-paypal"></i>Pronto Pago-Chofer</button>
                                <button type="button" class="btn btn-social btn-block btn-lg btn-github" onclick="mostrarform(true,2)">
                                    <i class="fa fa-paypal"></i>Detalle de Ticket</button>
                                <button type="button" class="btn btn-social btn-block btn-lg btn-github" onclick="mostrarform(true,3)">
                                    <i class="fa fa-paypal"></i>Resumen Pronto-Pago</button>
                                <button type="button" class="btn btn-social btn-block btn-lg btn-github" onclick="mostrarform(true,4)">
                                    <i class="fa fa-paypal"></i>Servicios por Clientes</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <!-- INICIO DEL BOX DE REPORTES -->
                        <div class="box box-primary reportes" id="cuadro1">
                            <div class="box-header" style="padding-bottom:0px">
                                <i class="fa fa-print"></i>
                                <h3 class="box-title">Pronto-Pago Chofer</h3>
                            </div>
                            <div class="panel-body" id="formularioregistros">
                                <form name="formulario1" id="formulario1" method="POST">
                                    <div class="form-group">
                                        <label class="col-sm-3 col-xs-12 control-label">Chofer:</label>
                                        <!-- INCLUIMOS LA CLASE SELECTPICKER -->
                                        <div class="input-group col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <select id="idchofer" class="form-control selectpicker" data-live-search="true" name="idchofer"></select>
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
                                    <input type="text" class="form-control fecharango" id="fechaprepago" required>
                                        <span class="input-group-btn">
                                            <button type="submit" name="btnTicket" id="btnTicket" class="btn btn-danger btn-flat">Imprimir</button>
                                        </span>
                                    </div>
                                    <!-- /.input group -->
                                </form>
                            </div>
                        </div>
                        <!-- /BOXPRIMARY -->
                        <!-- INICIO DEL BOX DE REPORTES -->
                        <div class="box box-primary reportes" id="cuadro2">
                            <div class="box-header" style="padding-bottom:0px">
                                <i class="fa fa-print"></i>
                                <h3 class="box-title">Detalle de Ticket</h3>
                            </div>
                            <div class="panel-body" id="formularioregistros">
                                <form name="formulario3" id="formulario3" method="POST">
                                    <div class="form-group">
                                        <label class="col-sm-3 col-xs-12 control-label">No de Ticket</label>
                                    </div>
                                    <div class="input-group margin col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <input type="number" class="form-control" name="ticket" id="ticket" required min="1">
                                        <input type="hidden" class="form-control" name="idchofer" id="idchofer">
                                        <input type="hidden" class="form-control" id="numeroform" name ="numeroform">
                                        <span class="input-group-btn">
                                            <button type="submit" name="btnTicket" id="btnTicket" class="btn btn-danger btn-flat">Imprimir</button>
                                        </span>
                                    </div>
                                    <div class="clearfix"></div>
                                    <label class="col-sm-3 col-xs-12 control-label">Empresa:</label>
                                    <!-- INCLUIMOS LA CLASE SELECTPICKER -->
                                    <div class="input-group col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <select id="idempresa3" class="form-control selectpicker" data-live-search="true" name="idempresa" required>
                                            <option value="">--</option>
                                            <option value="1">TRANSMARIM</option>
                                            <option value="2">CARIBBEAN</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /BOXPRIMARY -->
                        <div class="box box-primary reportes" id="cuadro3">
                            <div class="box-header" style="padding-bottom:0px">
                                <i class="fa fa-print"></i>
                                <h3 class="box-title">Resumen Pronto-Pago</h3>
                            </div>
                            <div class="panel-body" id="formularioregistros">
                                <form name="formulario" id="formulario2" method="POST">
                                    <div class="form-group">
                                        <label class="col-sm-3 col-xs-12 control-label">Empresa:</label>
                                        <!-- INCLUIMOS LA CLASE SELECTPICKER -->
                                        <div class="input-group col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                            <select id="idempresa2" class="form-control selectpicker" data-live-search="true" name="idempresa" required>
                                                <option value="">--</option>
                                                <option value="1">TRANSMARIM</option>
                                                <option value="2">CARIBBEAN</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <label class="col-sm-3 col-xs-12 control-label">Rango:</label>
                                    <div class="input-group col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" class="form-control fecharango" id="fechaprepago2" required>
                                        <span class="input-group-btn">
                                            <button type="submit" name="btnTicket" id="btnTicket" class="btn btn-danger btn-flat">Imprimir</button>
                                        </span>
                                    </div>
                                    <!-- /.input group -->
                                </form>
                            </div>
                        </div>
                        <!-- /BOXPRIMARY -->
                        <div class="box box-primary reportes" id="cuadro4">
                            <div class="box-header" style="padding-bottom:0px">
                                <i class="fa fa-print"></i>
                                <h3 class="box-title">Servicios por Cliente</h3>
                            </div>
                            <div class="panel-body" id="formularioregistros">
                                <form name="formulario4" id="formulario4" method="POST">
                                    <div class="form-group">
                                        <label class="col-sm-3 col-xs-12 control-label">Rango</label>
                                    </div>
                                    <div class="input-group col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" class="form-control fecharango" id="fechaprepago3" required>
                                        <span class="input-group-btn">
                                            <button type="submit" name="btnTicket" id="btnTicket" class="btn btn-danger btn-flat">Imprimir</button>
                                        </span>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-xs-12 control-label">Cliente:</label>
                                    </div>
                                    <!-- INCLUIMOS LA CLASE SELECTPICKER -->
                                    <div class="input-group col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                    <select id="idcliente" class="form-control selectpicker" data-live-search="true" name="idcliente"></select>
                                    </div>
                                    <!-- /.input group -->
                                </form>
                            </div>
                        </div>
                    </div>
            </section>
            <!-- /.content -->
<?php include_once("vistas/modulos/inc/footer.php"); ?>
<script type="text/javascript" src="vistas/plugins/datarange/moment.js"></script>
<script type="text/javascript" src="vistas/plugins/datarange/daterangepicker.js"></script>
<script type="text/javascript" src="vistas/js/imprimiru.js"></script>
<script type="text/javascript">function imprimirc(){$("#fechaprepago").daterangepicker({timePicker:!1,timePickerIncrement:30,format:"DD/MM/YYYY"}),$("#fechaempresa").daterangepicker({timePicker:!1,timePickerIncrement:30,format:"DD/MM/YYYY"}),$(".fecharango").daterangepicker({locale:{format:"MM/DD/YYYY",separator:" - ",applyLabel:"Aceptar",cancelLabel:"Cancelar",fromLabel:"Desde",toLabel:"Hasta",customRangeLabel:"Custom",weekLabel:"S",daysOfWeek:["Dom","Lun","Mar","Mier","Jue","Vie","Sab"],monthNames:["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],firstDay:1},linkedCalendars:!1,autoUpdateInput:!0,showCustomRangeLabel:!1})}$(document).ready(imprimirc);</script>
</div>
<!-- FIN DEL M.IMPRIMIRU -->
<?php
    } else {
      header("location:escritorio");
      ob_end_flush();
      exit();
    }
  }
?>