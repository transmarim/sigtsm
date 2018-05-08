<?php
  if(!$_SESSION['validarTSM']){
      header("location:inicio");
      exit();
  } else {
      if(!isset($_SESSION['idchofer'])){
        include_once("vistas/modulos/inc/aside.php");
?>
<!-- INICIO DEL ESCRITORIO USUARIOS COMUNES -->
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
                    <li>
                        <a href="#">
                            <i class="fa fa-dashboard"></i> Inicio</a>
                    </li>
                    <li class="active">Escritorio</li>
                </ol>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3 id="cantS"></h3>
                                <p>Servicios - Tickets</p>
                            </div>
                            <a href="tickettsm">
                                <div class="icon">
                                    <i class="ion ion-model-s"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3>Imprimir</h3>
                                <p>Reportes - Prepagos</p>
                            </div>
                            <a href="imprimiru">
                                <div class="icon">
                                    <i class="ion ion-printer"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3 id="cantU">
                                </h3>
                                <p>Control de Usuarios</p>
                            </div>
                            <a href="usuario">
                                <div class="icon">
                                    <i class="ion ion-ios-paper"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h3 id="cantV"></h3>
                                <p>Datos del Vehiculo</p>
                            </div>
                            <a href="vehiculo">
                                <div class="icon">
                                    <i class="ion ion-ios-speedometer"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <div class="box box-success">
                            <div class="box-header">
                                <i class="fa fa-comments-o"></i>
                                <h3 class="box-title">Chat</h3>
                            </div>
                            <div class="box-body chat" id="chat-box">
                                <div class="item">
                                    <img src="vistas/img/user4-128x128.jpg" alt="user image" class="online">
                                    <p class="message">
                                        <a href="#" class="name">
                                            <small class="text-muted pull-right">
                                                <i class="fa fa-clock-o"></i> 2:15</small> Pedro Torres </a> Buenas tardes, que ha pasado con el pago
                                        de caribeean??? </p>
                                </div>
                                <div class="item">
                                    <img src="vistas/img/user3-128x128.jpg" alt="user image" class="offline">
                                    <p class="message">
                                        <a href="#" class="name">
                                            <small class="text-muted pull-right">
                                                <i class="fa fa-clock-o"></i> 5:15</small> Leonardo Ferrer </a> Ya pagaron, confirma en tu banco.
                                        </p>
                                </div>
                                <div class="item">
                                    <img src="vistas/img/user2-160x160.jpg" alt="user image" class="offline">
                                    <p class="message">
                                        <a href="#" class="name">
                                            <small class="text-muted pull-right">
                                                <i class="fa fa-clock-o"></i> 5:30</small> Daniel Hernandez </a> Cuanto es la tarifa de puerto la
                                        cruz hasta ccs? </p>
                                </div>
                            </div>
                            <div class="box-footer">
                                <div class="input-group">
                                    <input class="form-control" placeholder="Escriba su mensaje...">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-success">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <i class="fa fa-info"></i>
                                <h3 class="box-title">¿Que es SIGTSM?</h3>
                            </div>
                            <div class="box-body">
                            <p><b>SIGTSM</b></p>
                            <p>Keffiyeh blog actually fashion axe vegan, irony biodiesel. Cold-pressed hoodie chillwave put a bird
                            on it aesthetic, bitters brunch meggings vegan iPhone. Dreamcatcher vegan scenester mlkshk. Ethical
                            master cleanse Bushwick, occupy Thundercats banjo cliche ennui farm-to-table mlkshk fanny pack
                            gluten-free. Marfa butcher vegan quinoa, bicycle rights disrupt tofu scenester chillwave 3 wolf moon
                            asymmetrical taxidermy pour-over. Quinoa tote bag fashion axe, Godard disrupt migas church-key tofu
                            blog locavore. Thundercats cronut polaroid Neutra tousled, meh food truck selfies narwhal American
                            Apparel.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

<?php
    } else {
    include_once("vistas/modulos/inc/aside.php");
?>
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
                    <li>
                        <a href="#">
                            <i class="fa fa-dashboard"></i> Inicio</a>
                    </li>
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
                            <a>
                                <div class="icon">
                                    <i class="ion ion-model-s"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3>53
                                    <sup style="font-size: 20px">%</sup>
                                </h3>
                                <p>Datos del chofer</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-ios-paper"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h3>1</h3>
                                <p>Datos del Vehiculo</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-ios-speedometer"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3>Imprimir</h3>
                                <p>Reportes - Prepagos</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-printer"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <div class="box box-success">
                            <div class="box-header">
                                <i class="fa fa-comments-o"></i>
                                <h3 class="box-title">Chat</h3>
                            </div>
                            <div class="box-body chat" id="chat-box">
                                <div class="item">
                                    <img src="vistas/img/user4-128x128.jpg" alt="user image" class="online">
                                    <p class="message">
                                        <a href="#" class="name">
                                            <small class="text-muted pull-right">
                                                <i class="fa fa-clock-o"></i> 2:15</small> Pedro Torres </a> Buenas tardes, este menu es solo para
                                        choferes?
                                    </p>
                                </div>
                                <div class="item">
                                    <img src="vistas/img/user3-128x128.jpg" alt="user image" class="offline">
                                    <p class="message">
                                        <a href="#" class="name">
                                            <small class="text-muted pull-right">
                                                <i class="fa fa-clock-o"></i> 5:15</small> Leonardo Ferrer </a> No sabemos. </p>
                                </div>
                                <div class="item">
                                    <img src="vistas/img/user2-160x160.jpg" alt="user image" class="offline">
                                    <p class="message">
                                        <a href="#" class="name">
                                            <small class="text-muted pull-right">
                                                <i class="fa fa-clock-o"></i> 5:30</small> Daniel Hernandez </a> Espera confirmar
                                    </p>
                                </div>
                            </div>
                            <div class="box-footer">
                                <div class="input-group">
                                    <input class="form-control" placeholder="Escriba su mensaje...">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-success">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <div class="box box-default">
                            <div class="box-header with-border">
                                <i class="fa fa-warning"></i>
                                <h3 class="box-title">Alertas</h3>
                            </div>
                            <div class="box-body">
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h4>
                                        <i class="icon fa fa-ban"></i> Alert!</h4> Su licencia esta vencida, renueve e ingrese el nuevo documento al
                                    sistema </div>
                                <div class="alert alert-warning alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h4>
                                        <i class="icon fa fa-warning"></i> Alert!</h4> Faltan 04 dias para vencer su licencia </div>
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h4>
                                        <i class="icon fa fa-check"></i> Alert!</h4> Todos sus documentos estan al dia. </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
<?php  
    }
  }
?>
<?php include_once("vistas/modulos/inc/footer.php"); ?>
<!-- SCRIPT UNICOS-->
<script src="vistas/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="vistas/js/escritorio.js"></script> 
<script>
$(document).ready(function () {
    $("#chat-box").slimscroll({
    height: '250px'
    });
    })
</script>
</div>
<?php ob_end_flush(); ?>