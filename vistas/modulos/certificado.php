<?php include_once("vistas/modulos/inc/aside.php"); ?>
   <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
   <div class="content-wrapper">
    <section class="content-header">
        <h1>
        Control
        <small>Certificados</small>
      </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Certificados</li>
        </ol>
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Certificados</h1>
                          <button class="pull-right btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                      <table id="tblistado" class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                          <th>NUMERO</th>
                          <th>VENCE</th>
                          <th>ESTADO</th>
                          <th>OPCIONES</th>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                        <th>NUMERO</th>
                        <th>VENCE</th>
                        <th>ESTADO</th>
                        <th>OPCIONES</th>
                        </tfoot>
                      </table>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                      <form name="formulario" id="formulario" method="POST">
                         <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Numero *:</label>
                          <input type="hidden" name="idcertificado" id="idcertificado">
                           <input type="number" class="form-control" name="numero" id="numero" placeholder="Numero" required>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Vence *:</label>
                          <input type="date" class="form-control" name="fechaven" id="fechaven" required>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                          <button class="btn btn-danger" type="button" onclick="cancelarform()"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                        </div>
                      </form>
                    </div>
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->
    </section>
    <!-- Main content -->
    
    <!-- /.content -->
    <?php include_once("vistas/modulos/inc/footer.php"); ?>
</div>