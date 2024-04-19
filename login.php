<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login - Brand</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Articles-Cards-images.css">
    <link rel="stylesheet" href="assets/css/Black-Navbar.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400|Roboto:300,400,700">
</head>
<body class="bg-gradient-primary" style="background: #212223;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-12 col-xl-10">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-flex">
                                <div class="flex-grow-1 bg-login-image" style="background: url(assets/img/photo-1554232456-8727aae0cfa4.webp) center / cover no-repeat;"></div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h4 class="text-dark mb-4">Bienvenido!</h4>
                                    </div>
                                    <form class="user" method="post" action="services/check_login.php">
                                        <div class="mb-3">
                                            <input class="form-control form-control-user" autocomplete="off" type="text" id="username" aria-describedby="emailHelp" placeholder="Nombre de usuario" name="username">
                                        </div>
                                        <div class="mb-3">
                                            <input class="form-control form-control-user" type="password" autocomplete="off" id="password" placeholder="Contraseña" name="password">
                                        </div>
                                        <div class="mb-3">
                                            <input class="form-control" type="text" id="codInst" name="codInst" placeholder="Cod. Institución" autocomplete="off" style="border-style: none;border-bottom-color: rgb(44,45,50); border-bottom-style: solid; border-radius: 0px; text-align: center;">
                                        </div>
                                        <button class="btn btn-primary d-block btn-user w-100" type="submit">Iniciar sesión</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/jquery-2.2.3.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#username").focus();
            
        });
    </script>
</body>
</html>