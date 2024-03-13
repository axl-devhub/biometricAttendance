
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
                                        <a class="nav-link disabled <?php if ($_SESSION['current_page'] == "registrar_maestro") echo "active" ?>" style="color:#    " href="#"><strike>+ Registrar docente</strike></a>
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
        <script src="js/jquery-2.2.3.min.js"></script>
	
