<?php include_once("vistas/modulos/inc/aside.php"); ?>
   <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
   <div class="content-wrapper">
    <section class="content-header">
        <h1>
        Datos
        <small>Chofer</small>
      </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
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
                    <div class="box-body box-profile"> <img class="profile-user-img img-responsive img-circle" src="vistas/img/user1-128x128.jpg" alt="User profile picture">
                        <h3 class="profile-username text-center">Luis Villalba</h3>
                        <p class="text-muted text-center">Conductor</p>
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
                                <input type="text" class="form-control" name="nombre" id="nombre" disabled> </div>
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
                                <input type="text" class="form-control" name="placa" id="placa" disabled> </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Licencia:</label>
                                <input type="text" class="form-control" name="licencia" id="licencia" disabled> </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Certificado:</label>
                                <input type="text" class="form-control" name="certificado" id="certificado" disabled> </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Imagen:</label>
                                <input type="hidden" class="form-control" name="imagenactual" id="imagenactual"> <img src="" width="150px" height="120px" id="imagenmuestra"> </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row (main row) -->
    </section>
    <!-- /.content -->
     <?php include_once("vistas/modulos/inc/footer.php"); ?>
</div>