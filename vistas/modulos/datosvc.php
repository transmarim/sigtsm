<?php include_once("vistas/modulos/inc/aside.php"); ?>
   <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
   <div class="content-wrapper">
    <section class="content-header">
        <h1>
        Datos
        <small>Vehiculo</small>
      </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Datos Vehiculo Choferes</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Main row -->
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Placa:</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" disabled> </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Seguro:</label>
                                <input type="text" class="form-control" name="cedula" id="cedula" disabled> </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Fecha Vencimiento:</label>
                                <input type="text" class="form-control" name="fechaven" id="fechaven" disabled> </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Titulo:</label>
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