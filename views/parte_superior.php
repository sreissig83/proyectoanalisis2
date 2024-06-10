<?php
 session_start();
 if($_SESSION["s_usuario"] === null){
    header("location: ../index.php");
 } else {
    include_once '../db/conexioncrud.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
 };
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Meson de Libros V. 1.0.1</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../mains.css">
    <link rel="stylesheet" type="text/css" href="../datatables/datatables.min.css">
    <link rel="stylesheet" href="../datatables/datatables203/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="../plugins/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="../plugins/fontawesome6.5.2/css/all.css">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->


            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="../index.php">
                    <span>Meson de Libros</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Menu
            </div>
            <?php
            if (($_SESSION["s_idRol"] === 4) && ($_SESSION["s_rol_descripcion"] === "admin")) {

            ?>
            <li class="nav-item">
                <a class="nav-link" href="../views/articulos.php">
                    <i class="fa-solid fa-book fa-lg"></i>    
                    <span>Articulos</span>
                </a>
            </li>
            <li class="nav-item">
            
                <a class="nav-link" href="../views/editoriales.php">
                    <i class="fa-solid fa-book fa-lg" href="../views/editoriales.php"></i>
                    <span>Editoriales</span>     
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="../views/proveedores.php">
                    <i class="fa-solid fa-book fa-lg"></i>    
                    <span>Proveedores</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="../views/clientes.php">
                <i class="fa-solid fa-book fa-lg"></i>    
                    <span>Clientes</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="../views/movimientos.php">
                    <i class="fa-solid fa-book fa-lg"></i>    
                    <span>Movimientos</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="../views/usuarios.php">
                    <i class="fa-solid fa-book fa-lg"></i>    
                    <span>Usuarios</span>
                </a>
            </li>
    <?php
    } else  if(($_SESSION["s_idRol"] === 1) && ($_SESSION["s_rol_descripcion"] === "dataentry")){
    ?>
            <li class="nav-item">
                <a class="nav-link" href="../views/articulos.php">
                    <i class="fa-solid fa-book fa-lg"></i>    
                    <span>Articulos</span>
                </a>
            </li>
            <li class="nav-item">
            
                <a class="nav-link" href="../views/editoriales.php">
                    <i class="fa-solid fa-book fa-lg" href="../views/editoriales.php"></i>
                    <span>Editoriales</span>     
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="../views/proveedores.php">
                    <i class="fa-solid fa-book fa-lg"></i>    
                    <span>Proveedores</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="../views/clientes.php">
                <i class="fa-solid fa-book fa-lg"></i>    
                    <span>Clientes</span>
                </a>
            </li>
    <?php
    } else  if(($_SESSION["s_idRol"] === 2) && ($_SESSION["s_rol_descripcion"] === "deposito")){
    ?>
        <li class="nav-item">
                <a class="nav-link collapsed" href="../views/movimientos.php">
                    <i class="fa-solid fa-book fa-lg"></i>    
                    <span>Movimientos</span>
                </a>
            </li>
            <?php
    } else  if(($_SESSION["s_idRol"] === 5) && ($_SESSION["s_rol_descripcion"] === "lector")){
    ?>
        <li class="nav-item">
                <a class="nav-link" href="../views/articulos.php">
                    <i class="fa-solid fa-book fa-lg"></i>    
                    <span>Articulos</span>
                </a>
            </li>
            <li class="nav-item">
            
                <a class="nav-link" href="../views/editoriales.php">
                    <i class="fa-solid fa-book fa-lg" href="../views/editoriales.php"></i>
                    <span>Editoriales</span>     
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="../views/proveedores.php">
                    <i class="fa-solid fa-book fa-lg"></i>    
                    <span>Proveedores</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="../views/clientes.php">
                <i class="fa-solid fa-book fa-lg"></i>    
                    <span>Clientes</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="../views/movimientos.php">
                    <i class="fa-solid fa-book fa-lg"></i>    
                    <span>Movimientos</span>
                </a>
            </li>
            <?php
    } else  if(($_SESSION["s_idRol"] === 3) && ($_SESSION["s_rol_descripcion"] === "venta")){
    ?>
        <li class="nav-item">
                <a class="nav-link collapsed" href="../views/movimientos.php">
                    <i class="fa-solid fa-book fa-lg"></i>    
                    <span>Movimientos</span>
                </a>
            </li>
            <?php
    }
    ?>
            


            <!-- Divider -->
            <hr class="sidebar-divider">

        
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="login.html">Login</a>
                        <a class="collapse-item" href="register.html">Register</a>
                        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.html">404 Page</a>
                        <a class="collapse-item" href="blank.html">Blank Page</a>
                    </div>
                </div>
            </li>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow" id="headersite">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        
                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        

                        

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <input type="hidden" id="username" value="<?php echo $_SESSION['s_usuario']; ?>">
                                <input type="hidden" id="useridrol" value="<?php echo $_SESSION['s_idRol']; ?>">
                                <input type="hidden" id="userdescrip" value="<?php echo $_SESSION['s_rol_descripcion']; ?>">
                                <img class="img-profile rounded-circle"
                                    src="../img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="perfilusuario.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil de Usuario
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Configuraciones
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Registro de Actividad
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cerrar Sesion
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->