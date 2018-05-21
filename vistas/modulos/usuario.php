<?php
  if(!$_SESSION['validarTSM']){
      header("location:inicio");
      exit();
  } else {
      if($_SESSION['permisos']==1){
        include_once("vistas/modulos/inc/aside.php");
?>
<!-- INICIO DEL M.USUARIO -->
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          Control
          <small>Usuarios</small>
        </h1>
        <ol class="breadcrumb">
          <li>
            <a href="#">
              <i class="fa fa-dashboard"></i> Inicio</a>
          </li>
          <li class="active">Usuarios</li>
        </ol>
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h1 class="box-title">Usuario</h1>
                  <button class="pull-right btn btn-success" id="btnagregar" onclick="mostrarform(true)">
                    <i class="fa fa-plus-circle"></i> Agregar</button>
                  <div class="box-tools pull-right">
                  </div>
                </div>
                <!-- /.box-header -->
                <!-- centro -->
                <div class="panel-body table-responsive" id="listadoregistros">
                  <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                      <th>Opciones</th>
                      <th>Nombre</th>
                      <th>Email</th>
                      <th>Login</th>
                      <th>Foto</th>
                      <th>Estado</th>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                      <th>Opciones</th>
                      <th>Nombre</th>
                      <th>Email</th>
                      <th>Login</th>
                      <th>Foto</th>
                      <th>Estado</th>
                    </tfoot>
                  </table>
                </div>
                <div class="panel-body" id="formularioregistros">
                  <form name="formulario" id="formulario" method="POST">
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <label class="col-sm-12 control-label">Nombre(*):</label>
                      <input type="hidden" name="idusuario" id="idusuario">
                      <div class="col-sm-12">
                      <input type="text" class="form-control" name="nombre" id="nombre" maxlength="100" placeholder="Nombre" required>
                      </div>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <label class="col-sm-12 control-label">Login (*):</label>
                      <div class="col-sm-12">
                      <input type="text" class="form-control" name="login" id="login" maxlength="20" placeholder="Login" required>
                      </div>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <label class="col-sm-12 control-label">Clave (*):</label>
                      <div class="col-sm-12">
                      <input type="password" class="form-control" name="clave" id="clave" maxlength="45" placeholder="Clave" required>
                      </div>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <label class="col-sm-12 control-label">Email (*):</label>
                      <div class="col-sm-12">
                      <input type="email" class="form-control" name="email" id="email" maxlength="45" placeholder="Email" required>
                      </div>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <label class="col-sm-12 control-label">Vincular a Chofer:</label>
                      <!-- INCLUIMOS LA CLASE SELECTPICKER -->
                      <div class="col-sm-12">
                      <select id="idchofer" class="form-control selectpicker" data-live-search="true" name="idchofer">
                      </select>
                      </div>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <label class="col-sm-12 control-label">Permisos:</label>
                      <ul style="list-style: none;" id="permisos">
                      </ul>
                      <span class="has-error col-sm-12" id="errorToShow"></span>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <label class="col-sm-12 control-label">Imagen:</label>
                      <div class="col-sm-12">
                      <input type="file" class="form-control" name="imagen" id="imagen">
                      <input type="hidden" name="imagenactual" id="imagenactual">
                      <img src="" width="150px" height="150px" id="imagenmuestra">
                      </div>
                    </div>
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <button class="btn btn-primary" type="submit" id="btnGuardar">
                        <i class="fa fa-save"></i> Guardar</button>

                      <button class="btn btn-danger" onclick="cancelarform()" type="button">
                        <i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-primary">
                        Ayuda
                      </button>
                    </div>
                  </form>
                </div>
                <!--Fin centro -->
              </div>
              <!-- /.box -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </section>
        <div class="modal modal-primary fade" id="modal-primary">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                  <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Modulo Usuarios</h4>
              </div>
              <div class="modal-body">
                <div class="box-body">
                  <dl class="dl-horizontal">
                    <dt>Nombre</dt>
                    <dd style="text-align:justify">Ingrese el nombre completo del usuario.</dd>
                    <dt>Login</dt>
                    <dd style="text-align:justify">Ingrese el login que desea asignar al usuario, con éste, el usuario o chofer tendra acceso sistema.</dd>
                    <dt>Clave</dt>
                    <dd style="text-align:justify">Ingrese la clave que desea asignar al usuario, con esta contraseña el usuario o chofer tendra acceso
                      al sistema.</dd>
                    <dt>Email</dt>
                    <dd style="text-align:justify">Ingrese el correo electronico que utiliza actualmente el usuario o chofer.
                    </dd>
                    <dt>Vincular a chofer</dt>
                    <dd style="text-align:justify">Seleccione el nombre del chofer que desea vincular a los datos suministrados, si es un personal administrativo
                      omitir la seleccion
                    </dd>
                    <dt>Imagen</dt>
                    <dd style="text-align:justify">Suba una imagen del chofer o usuario, los formatos permitidos son JPG y PNG con resolucion maxima de
                      50px por 50px.
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
<?php include_once("vistas/modulos/inc/footer.php"); ?>
<script src="vistas/plugins/datatables/jquery.dataTables.min.js"></script>    
<script src="vistas/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="vistas/plugins/datatables/buttons.html5.min.js"></script>
<script src="vistas/plugins/datatables/buttons.colVis.min.js"></script>
<script src="vistas/plugins/datatables/jszip.min.js"></script>
<script src="vistas/plugins/datatables/pdfmake.min.js"></script>
<script src="vistas/plugins/datatables/vfs_fonts.js"></script> 
<script type="text/javascript" src="vistas/js/usuario.js"></script>
</div>
<!-- FIN DEL M.USUARIO -->
<?php
    } else {
      header("location:escritorio");
      ob_end_flush();
      exit();
    }
  }
?>