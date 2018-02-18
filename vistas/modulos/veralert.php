<?php include_once("vistas/modulos/inc/aside.php"); ?>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <div class="content-wrapper">
                <link rel="stylesheet" href="vistas/plugins/Ionicons/css/ionicons.min.css">
                <section class="content-header">
                    <h1>
        Modulo
        <small>Alertas generales de SIGTSM</small>
      </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Alertas</a></li>
                        <li class="active">Ver Alertas</li>
                    </ol>
                </section>
                <section class="content">
                    <div class="row">
<!--
                        <div class="col-lg-6 col-md-6 col-xs-12">
                            <div class="box box-danger">
                                <div class="box-header with-border"> <i class="fa fa-id-card"></i>
                                    <h3 class="box-title">Cedulas Vencidas</h3> </div>
                                <div class="box-body">
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <h4><i class="icon fa fa-ban"></i> Vencido!</h4>Los siguientes choferes tienen su cedula de identidad vencida:
                                        <ul>
                                          <li>Jose Ejemplo</li>
                                        </ul>
                                      </div>
                                    <div class="alert alert-warning alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <h4><i class="icon fa fa-warning"></i> Advertencia!</h4>Los siguientes choferes tienen su cedula proxima a vencer:
                                        <ul>
                                          <li>Jose Ejemplo</li>
                                        </ul></div>
                                    <div class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <h4><i class="icon fa fa-check"></i> Exito!</h4> Todas las cedulas estan vigentes. </div>
                                </div>
                            </div>
                        </div>
-->
                        <div class="col-lg-4 col-md-6 col-xs-12">
                            <div class="box box-danger">
                                <div class="box-header with-border"> <i class="fa fa-credit-card"></i>
                                    <h3 class="box-title">Certificados Vencidos</h3> </div>
                                <div class="box-body">
                                    <div id="ldanger2" class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <h4><i class="icon fa fa-ban"></i> Vencido!</h4>Los siguientes choferes tienen su certificado vencido:
                                        <ol id='certificadoVencida'>
                                            
                                        </ol>
                                      </div>
                                    <div id="lwarning2" class="alert alert-warning alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <h4><i class="icon fa fa-warning"></i> Advertencia!</h4>Los siguientes choferes tienen su certificado proximo a vencer:
                                        
                                          <ol id='certificadoPorVencer'>
                                          </ol></div>
                                    <div id="lsuccess2" class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <h4><i class="icon fa fa-check"></i> Exito!</h4> Todas las licencias estan vigentes. </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-xs-12">
                            <div class="box box-danger">
                                <div class="box-header with-border"> <i class="fa fa-credit-card"></i>
                                    <h3 class="box-title">Licencias Vencidas</h3> </div>
                                <div class="box-body">
                                    <div id="ldanger" class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <h4><i class="icon fa fa-ban"></i> Vencido!</h4>Los siguientes choferes tienen su licencia vencida:
                                        <ol id='licenciaVencida'>
                                            
                                        </ol>
                                      </div>
                                    <div id="lwarning" class="alert alert-warning alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <h4><i class="icon fa fa-warning"></i> Advertencia!</h4>Los siguientes choferes tienen su licencia proxima a vencer:
                                        
                                          <ol id='licenciaPorVencer'>
                                          </ol></div>
                                    <div id="lsuccess" class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <h4><i class="icon fa fa-check"></i> Exito!</h4> Todas las licencias estan vigentes. </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-xs-12">
                            <div class="box box-danger">
                                <div class="box-header with-border"> <i class="fa fa-credit-card"></i>
                                    <h3 class="box-title">Seguros Vencidos</h3> </div>
                                <div class="box-body">
                                    <div id="ldanger3" class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <h4><i class="icon fa fa-ban"></i> Vencido!</h4>Los siguientes Vehiculos tienen su seguro vencido:
                                        <ol id='seguroVencida'>
                                            
                                        </ol>
                                      </div>
                                    <div id="lwarning3" class="alert alert-warning alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <h4><i class="icon fa fa-warning"></i> Advertencia!</h4>Los siguientes Vehiculos tienen su seguro proximo a vencer:
                                        
                                          <ol id='seguroPorVencer'>
                                          </ol></div>
                                    <div id="lsuccess3" class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <h4><i class="icon fa fa-check"></i> Exito!</h4> Todas los seguros estan vigentes. </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <?php include_once("vistas/modulos/inc/footer.php"); ?>
                <script type="text/javascript" src="vistas/js/veralert.js"></script>
            </div>
