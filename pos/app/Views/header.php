<?php  $user_sesion = session(); //Traemos los datos de la sesion.
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>DS</title>
    <link rel="icon" href="<?php echo base_url(); ?>/data-complexityicon.png" type="image/png">
    <link href="<?php echo base_url(); ?>/css/styles.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="<?php echo base_url(); ?>/js/jquery-ui/jquery-ui.min.css" rel="stylesheet"></script>
    <script src="<?php echo base_url(); ?>/js/all.min.js" crossorigin="anonymous"></script>
    <script src="<?php echo base_url(); ?>/js/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="<?php echo base_url(); ?>/js/jquery-ui/jquery-ui.min.js"></script>


</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="<?php echo base_url(); ?>./configuracion">Sueños Infantiles</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        <!-- Navbar-->
        <ul class="navbar-nav ml-auto mr-md-3 my-2 my-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown"
                 aria-haspopup="true" aria-expanded="false"><?php echo $user_sesion->nombre; ?>
                 <i class="fas fa-user fa-fw"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="<?php echo base_url(); ?>/usuarios/cambiarPassword">Cambiar contraseña</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo base_url(); ?>/usuarios/cerrarSesion">Cerrar sesión</a>
                </div>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">CATEGORIAS</div>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-tags"></i></div>
                            Productos
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo base_url(); ?>/productos">Productos</a>
                                <a class="nav-link" href="<?php echo base_url(); ?>/unidades">Unidades</a>
                                <a class="nav-link" href="<?php echo base_url(); ?>/categorias">Categorias</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            Clientes
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link" href="<?php echo base_url(); ?>/clientes">Clientes</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#admin" aria-expanded="false" aria-controls="admin">
                            <div class="sb-nav-link-icon"><i class="fas fa-tools"></i></div>
                            Administracion
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="admin" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link" href="<?php echo base_url(); ?>/configuracion">Configuración</a>
                                <a class="nav-link" href="<?php echo base_url(); ?>/usuarios">Usuarios</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#compra" aria-expanded="false" aria-controls="admin">
                            <div class="sb-nav-link-icon"><i class="fas fa-hand-holding-usd"></i></div>
                            Compras
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="compra" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link" href="<?php echo base_url(); ?>/compras/nuevo">Nueva compra</a>
                                <a class="nav-link" href="<?php echo base_url(); ?>/compras">Compras</a>
                            </nav>
                        </div>
                        <a class="nav-link" href="<?php echo base_url(); ?>/ventas/venta" >
                            <div class="sb-nav-link-icon"><i class="fas fa-coins"></i></div>
                            Caja
                        </a>
                        <a class="nav-link" href="<?php echo base_url(); ?>/ventas" >
                            <div class="sb-nav-link-icon"><i class="fas fa-cart-arrow-down"></i></div>
                            Ventas
                        </a>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#reporte" aria-expanded="false" aria-controls="admin">
                            <div class="sb-nav-link-icon"><i class="fas fa-file-pdf"></i></div>
                            Reportes
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="reporte" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link" href="<?php echo base_url(); ?>/productos/mostrarMinimo">Stock mínimo</a>
                            </nav>
                        </div>
                        
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Start Bootstrap
                </div>
            </nav>
        </div>