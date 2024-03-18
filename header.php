
<!DOCTYPE html>
<html data-bs-theme="light" lang="en" style="overflow: hidden;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Sistema de asistencia biometrico</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Nunito.css">
    <link rel="stylesheet" href="assets/css/Roboto.css">
    <link rel="stylesheet" href="assets/css/Roboto%20Slab.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/css/Sidebar-Cool-SB-Admin-Inspirate.css">
</head>

<body id="page-top">
    <div id="wrapper" style="height: 100vh;">
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <div id="sidenavAccordion" class="sb-sidenav accordion sb-sidenav-dark">
                    <div class="sb-sidenav-menu" style="background: #171516;">
                        <div class="nav"><img src="assets/img/Asinyx%20logo.svg" width="237" height="193">
                        <div>
                                <a class="nav-link <?php if ($_SESSION['current_page'] == "index") echo "active" ?>" href="index.php">
                                    <div class="sb-nav-link-icon">
                                        <i class="fa fa-chart-line"></i>
                                    </div>
                                    <span>Analiticas</span>
                                </a>
                            </div>
                            <div>
                                <a class="nav-link <?php if ($_SESSION['current_page'] == "usuarios") echo "active" ?>" href="usuarios.php">
                                    <div class="sb-nav-link-icon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <span>Usuarios</span>
                                </a>
                            </div>
                        <div>
                                <a class="nav-link <?php if ($_SESSION['current_page'] == "asistencia") echo "active" ?>" href="asistencia.php">
                                    <div class="sb-nav-link-icon">
                                        <i class="fa fa-table"></i>
                                    </div>
                                    <span>Asistencia</span>
                                </a>
                            </div>
                            <div>
                                <a class="nav-link <?php if ($_SESSION['current_page'] == "cursos") echo "active" ?>" href="cursos.php">
                                    <div class="sb-nav-link-icon">
                                        <i class="fa fa-suitcase"></i>
                                    </div>
                                    <span>Cursos</span>
                                </a>
                            </div>
                            <div>
                                <a class="nav-link collapsed <?php if ($_SESSION['current_page'] == "registrar_estudiante" || $_SESSION['current_page'] == "registrar_maestro" ) echo "active"?>" href="#" aria-expanded="false" aria-controls="collapse2" data-bs-toggle="collapse" data-bs-target="#collapseLayouts-1">
                                    <div class="sb-nav-link-icon">
                                        <i class="fa fa-send"></i>
                                    </div>
                                    <span>Acciones rápidas&nbsp;</span>
                                    <div class="sb-sidenav-collapse-arrow">
                                        <i class="fa fa-angle-down"></i>
                                    </div>
                                </a>
                                <div id="collapseLayouts-1" class="collapse" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                    <div class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link <?php if ($_SESSION['current_page'] == "registrar_estudiante") echo "active" ?>" href="ManageUsers.php">+ Registrar estudiante</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-xxl-flex sb-sidenav-footer" style="background: rgb(23,21,22);"><a class="text-end nav-link active" href="#">
                            <div class="sb-nav-link-icon"><i class="fa fa-sign-out float-start d-xxl-flex" style="font-size: 23px;margin: 0px;margin-top: 2px;"></i><span class="float-start" style="margin-left: 10px;font-size: 19px;">Cerrar Sesion</span></div>
                        </a></div>
                </div>
            </div>
            <div id="layoutSidenav_content">
                <main></main>
            </div>
        </div>
        <div class="d-flex flex-column" id="content-wrapper">
        <div id="content" style="margin-left: 0;">
        <nav class="navbar navbar-expand bg-dark shadow mb-4 topbar static-top navbar-light" style="--bs-dark: #1e1b1d;--bs-dark-rgb: 30,27,29;background: rgb(28,28,31);" data-bs-theme="dark">
    <div class="container-fluid"><button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle me-3" type="button"><i class="fas fa-bars"></i></button>
        <ul class="navbar-nav flex-nowrap ms-auto">
            <li class="nav-item dropdown no-arrow mx-1">
                <div class="nav-item dropdown show no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="true" data-bs-toggle="dropdown" href="#"><span class="badge bg-danger badge-counter">1</span><i class="fas fa-bell text-light-emphasis fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-list animated--grow-in" data-bs-popper="none" data-bs-theme="light">
                        <h6 class="dropdown-header">Notificaciones del sistema</h6><a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="me-3">
                                <div class="bg-primary icon-circle"><i class="fas fa-file-alt text-white"></i></div>
                            </div>
                            <div><span class="small text-gray-500">10 de Enero de 2024</span>
                                <p>Juan Eleazar de 5TO E ha llegado a las 4 tardanzas!<br /><br />Generar carta de advertencia?</p>
                            </div>
                        </a><a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown no-arrow mx-1">
                <div class="shadow dropdown-list dropdown-menu dropdown-menu-end" aria-labelledby="alertsDropdown"></div>
            </li>
            <div class="d-none d-sm-block topbar-divider"></div>
            <li class="nav-item no-arrow"><a class="nav-link nav-link active" href="profile.php">
                    <div class="sb-nav-link-icon"><img class="border rounded-circle img-profile" src="./assets/img/asinyx_logo.svg" width="49" height="49" /></div><span>  Usuario</span>
                </a></li>
        </ul>
        </div>
    </nav>
        <script src="js/jquery-2.2.3.min.js"></script>
	
