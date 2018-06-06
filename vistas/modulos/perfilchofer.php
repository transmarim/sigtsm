<?php
  if(!$_SESSION['validarTSM']){
      header("location:inicio");
      exit();
  } else {
    include_once("vistas/modulos/inc/aside.php");
?>
<!-- INICIO DEL M.PERFIL -->
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    Datos
                    <small>Chofer</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="#">
                            <i class="fa fa-dashboard"></i> Inicio</a>
                    </li>
                    <li class="active">Perfil</li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <!-- Main row -->
                <div class="row">
                    <div class="col-md-3">
                        <!-- Profile Image -->
                        <div class="box box-primary">
                            <div class="box-body box-profile">
                                <img class="profile-user-img img-responsive img-circle" src="vistas/img/usuarios/<?php echo $_SESSION['imagen']; ?>" alt="User profile picture">
                                <h3 class="profile-username text-center">
                                    <?php echo $_SESSION['nombre'] ?>
                                </h3>
                                <p class="text-muted text-center">Usuario</p>
                                <p class="text-muted text-center"><button class="btn btn-warning" onclick="mostrar(<?php echo $_SESSION['idchofer']; ?>)"> Mostrar Datos</button></p>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                        <!-- /.box -->
                    </div>
                    <div class="col-md-9">
                        <div class="box box-primary">
                            <div class="panel-body" id="formularioregistros">
                                <form name="formulario" id="formulario" method="POST">
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Nombre:</label>
                                        <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $_SESSION['nombre']; ?>" disabled></div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Cedula:</label>
                                        <input type="text" class="form-control" name="cedula" id="cedula" disabled> </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Telefono:</label>
                                        <input type="text" class="form-control" name="telefono" id="telefono" disabled> </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Email:</label>
                                        <input type="text" class="form-control" name="email" id="email" disabled> </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Vehiculo:</label>
                                        <a id="vehiculo" href="" target="_blank"><span class="form-control">Descargar</span></a>
                                        </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Licencia:</label>
                                        <a id="licencia" href="" target="_blank"><span class="form-control">Descargar</span></a>
                                        </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Certificado:</label>
                                        <a id="certificado" href="" target="_blank"><span class="form-control">Descargar</span></a>
                                        </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Fecha Nacimiento:</label>
                                        <input type="text" class="form-control" name="fechanac" id="fechanac" disabled> </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Imagen:</label>
                                        <input type="hidden" class="form-control" name="imagenactual" id="imagenactual">
                                        <img src="" width="150px" height="120px" id="imagenmuestra"> </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row (main row) -->
            </section>
<?php include_once("vistas/modulos/inc/footer.php"); ?>
<script type="text/javascript" src="vistas/js/perfilchofer.js"></script>
</div>
<?php
    } ob_end_flush();
?>