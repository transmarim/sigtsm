<?php include_once("vistas/modulos/inc/aside.php"); ?>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <div class="content-wrapper">
                <link rel="stylesheet" href="vistas/plugins/Ionicons/css/ionicons.min.css">
                <section class="content-header">
                    <h1>
        Bienvenido
        <small>Sistema Transmarim</small>
      </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
                        <li class="active">Escritorio</li>
                    </ol>
                </section>
                <section class="content">
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>150</h3>
                                    <p>Servicios - Tickets</p>
                                </div>
                                <div class="icon"> <i class="ion ion-model-s"></i> </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-xs-6">
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>20</h3>
                                    <p>Control de Choferes</p>
                                </div>
                                <div class="icon"> <i class="ion ion-ios-speedometer"></i> </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-xs-6">
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>1</h3>
                                    <p>Clientes</p>
                                </div>
                                <div class="icon"> <i class="ion-person-stalker"></i> </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-xs-6">
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>Imprimir</h3>
                                    <p>Reportes - Prepagos</p>
                                </div>
                                <div class="icon"> <i class="ion ion-printer"></i> </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-xs-12">
                            <div class="box box-success">
                                <div class="box-header"> <i class="fa fa-comments-o"></i>
                                    <h3 class="box-title">Chat</h3> </div>
                                <div class="box-body chat" id="chat-box">
                                    <div class="item"> <img src="vistas/img/user4-128x128.jpg" alt="user image" class="online">
                                        <p class="message">
                                            <a href="#" class="name"> <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 2:15</small> Pedro Torres </a> Buenas tardes, que ha pasado con el pago de caribeean??? </p>
                                    </div>
                                    <div class="item"> <img src="vistas/img/user3-128x128.jpg" alt="user image" class="offline">
                                        <p class="message">
                                            <a href="#" class="name"> <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:15</small> Leonardo Ferrer </a> Ya pagaron viejo, no te hagas el loco. </p>
                                    </div>
                                    <div class="item"> <img src="vistas/img/user2-160x160.jpg" alt="user image" class="offline">
                                        <p class="message">
                                            <a href="#" class="name"> <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:30</small> Daniel Hernandez </a> Cuanto es la tarifa de puerto la cruz hasta ccs? </p>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <div class="input-group">
                                        <input class="form-control" placeholder="Escriba su mensaje...">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-success"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-xs-12">
                            <div class="box box-default">
                                <div class="box-header with-border"> <i class="fa fa-warning"></i>
                                    <h3 class="box-title">Alertas</h3> </div>
                                <div class="box-body">
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <h4><i class="icon fa fa-ban"></i> Alert!</h4> Su licencia esta vencida, renueve e ingrese el nuevo documento al sistema </div>
                                    <div class="alert alert-warning alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <h4><i class="icon fa fa-warning"></i> Alert!</h4> Faltan 04 dias para vencer su licencia </div>
                                    <div class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <h4><i class="icon fa fa-check"></i> Alert!</h4> Todos sus documentos estan al dia. </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <?php include_once("vistas/modulos/inc/footer.php"); ?>
                    <!-- SCRIPT UNICOS-->
                    <script src="vistas/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
                    <script>
                        $(document).ready(function () {
                            $("#chat-box").slimscroll({
                                height: '250px'
                            });
                        })
                    </script>
            </div>