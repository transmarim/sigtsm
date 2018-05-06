<header class="main-header">
    <a href="index" class="logo"> <span class="logo-mini"><b>T</b>SM</span> <span class="logo-lg"><b>SIG</b>TRANS</span> </a>
    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button"> <span class="sr-only">Toggle navigation</span> </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <img src="vistas/img/usuarios/<?php echo $_SESSION['imagen']; ?>" class="user-image" alt="User Image"> <span class="hidden-xs"><?php echo $_SESSION["nombre"]; ?></span> </a>
                    <ul class="dropdown-menu">
                        <li class="user-header"> <img src="vistas/img/usuarios/<?php echo $_SESSION['imagen']; ?>" class="img-circle" alt="User Image">
                            <p> <?php echo $_SESSION["nombre"]; ?> <small>Conductor</small> </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left"> <a href="perfilchofer" class="btn btn-default btn-flat">Editar</a> </div>
                            <div class="pull-right"> <a href="controllers/usuario.php?op=salir" class="btn btn-default btn-flat">Salir</a> </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>

<?php 
    if(!isset($_SESSION['idchofer'])){
    /*INICIO HTML DE LOS USUARIOS COMUNES*/
?>

<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image"> <img src="vistas/img/usuarios/<?php echo $_SESSION['imagen']; ?>" class="img-circle" alt="User Image"> </div>
            <div class="pull-left info">
                <p> <?php echo $_SESSION["nombre"]; ?> </p> <a href="#"><i class="fa fa-circle text-success"></i> Online</a> </div>
        </div>
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MENU NAVEGACION</li>

            <?php $_SESSION['escritorio']==1 ? $pagina = '<li>
                <a href="escritorio"> <i class="fa fa-dashboard"></i> <span>Escritorio</span> </a>
            </li>' : $pagina = ''; echo $pagina;?>

            <?php $_SESSION['boletas']==1 ? $pagina = '<li class="treeview">
                <a href=""> <i class="fa fa-files-o"></i> <span>Boletas</span> </a>
                <ul class="treeview-menu">
                    <li><a href="tickettsm"><i class="fa fa-trademark"></i>TSM</a></li>
                    <li><a href="ticketcarib"><i class="fa fa-contao"></i>Caribbean</a></li>
                    <li><a href="descuentochofer"><i class="fa fa-usd"></i>Descuentos Boletas</a></li>
                </ul>
            </li>' : $pagina = ''; echo $pagina;?>

            <?php $_SESSION['ingresar']==1 ? $pagina = '<li class="treeview">
                <a href=""> <i class="fa fa-user-plus"></i> <span>Ingresar</span> </a>
                <ul class="treeview-menu">
                    <li><a href="cliente"><i class="fa fa-users"></i>Clientes</a></li>
                    <li><a href="centro"><i class="fa fa-ship"></i>Buques</a></li>
                    <li><a href="chofer"><i class="fa fa-id-card"></i>Chofer</a></li>
                    <li><a href="descuento"><i class="fa fa-minus-circle"></i>Descuentos</a></li>
                </ul>
            </li>' : $pagina = ''; echo $pagina;?>

            <?php $_SESSION['documentos']==1 ? $pagina = '<li class="treeview">
                <a href=""> <i class="fa fa-address-book-o"></i> <span>Documentos</span> </a>
                <ul class="treeview-menu">
                    <li class="treeview">
                        <a href="#"><i class="fa fa-hand-o-down"></i> Doc. de Vehiculos
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>
                        <ul class="treeview-menu" style="display: none;">
                            <li><a href="seguro"><i class="fa fa-shield"></i> Seguro</a></li>
                            <li><a href="vehiculo"><i class="fa fa-car"></i> Vehiculo</a></li>
                          </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-hand-o-down"></i> Doc. de Chofer
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>
                        <ul class="treeview-menu" style="display: none;">
                            <li><a href="licencia"><i class="fa fa-address-card"></i> Licencia</a></li>
                            <li><a href="certificado"><i class="fa fa-credit-card"></i> Certificado</a></li>
                          </ul>
                    </li>
                </ul>
            </li>' : $pagina = ''; echo $pagina;?>

            <?php $_SESSION['carteleras']==1 ? $pagina = '<li class="treeview">
                <a href=""> <i class="fa fa-external-link"></i> <span>Carteleras</span> </a>
                <ul class="treeview-menu">
                    <li><a href="tarifas"><i class="fa fa-money"></i>Tarifas</a></li>
                    <li><a href="#"><i class="fa fa-object-group"></i>Guardia Semanal</a></li>
                    <li><a href="talonario"><i class="fa fa-book"></i>Talonarios - TSM</a></li>
                    <li><a href="talonariocaribe"><i class="fa fa-book"></i>Talonarios - CARIB</a></li>
                </ul>
            </li>' : $pagina = ''; echo $pagina;?>

            <?php $_SESSION['alertas']==1 ? $pagina = '<li class="treeview">
               <a href=""> <i class="fa fa-exclamation-triangle"></i> <span>Alertas</span> </a>
               <ul class="treeview-menu">
                   <li><a href="veralert"><i class="fa fa-eye"></i>Ver Alertas</a></li>
                   <li><a href="enviaralert"><i class="fa fa-paper-plane"></i>Enviar Alertas</a></li>
               </ul>
           </li>' : $pagina = ''; echo $pagina;?>

            <?php $_SESSION['permisos']==1 ? $pagina = '<li class="treeview">
                <a href=""> <i class="fa fa-wrench"></i> <span>Permisos</span> </a>
                <ul class="treeview-menu">
                   <li><a href="usuario"><i class="fa fa-sitemap"></i>Control de Usuarios</a></li>
                   <li><a href="cierre"><i class="fa fa-unlock-alt"></i>Cierre de Sistema</a></li>
               </ul>
            </li>' : $pagina = ''; echo $pagina;?>
<!--
            <li>
                <a href="pagoticket"> <i class="fa fa-paypal"></i> <span>Tickets por Pagar</span> </a>
            </li>
-->
            <?php $_SESSION['prontopago']==1 ? $pagina = '<li>
                <a href="prontopago"> <i class="fa fa-envelope-o"></i> <span>Enviar Pronto-Pago</span> </a>
            </li>' : $pagina = ''; echo $pagina;?>

            <?php $_SESSION['reportes']==1 ? $pagina = '<li>
                <a href="imprimiru"> <i class="fa fa-print"></i> <span>Reportes</span> </a>
            </li>' : $pagina = ''; echo $pagina;?>

        </ul>
    </section>
</aside>

<?php
} else {
    ?>
        <aside class="main-sidebar">
            <section class="sidebar">
                <div class="user-panel">
                    <div class="pull-left image"> <img src="vistas/img/usuarios/<?php echo $_SESSION['imagen']; ?>" class="img-circle" alt="User Image"> </div>
                    <div class="pull-left info">
                        <p> <?php echo $_SESSION["nombre"]; ?> </p> <a href="#"><i class="fa fa-circle text-success"></i> Online</a> </div>
                </div>
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">MENU NAVEGACION</li>
                    <li>
                        <a href="escritorio"> <i class="fa fa-dashboard"></i> <span>Escritorio</span> </a>
                    </li>
                    <li>
                        <a href="perfilchofer"> <i class="fa fa-address-card-o"></i> <span>Datos Chofer</span> </a>
                    </li>
                    <li>
                        <a href="datosvc"> <i class="fa fa-car"></i> <span>Datos Vehiculo</span> </a>
                    </li>
                    <li>
                        <a href="imprimirc"> <i class="fa fa-file-text"></i> <span>Imprimir</span> </a>
                    </li>
                </ul>
            </section>
        </aside>
    <?php
}
?>
