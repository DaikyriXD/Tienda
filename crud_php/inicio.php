<?php
session_start();
if (!empty($_SESSION['active'])) {
    header('location: admin/productos.php');
} else {
    if (!empty($_POST)) {
        $alert = '';
        if (empty($_POST['usuario']) || empty($_POST['contraseña'])) {
            $alert = '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
                        Ingrese usuario y contraseña
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
        } else {
            require_once "config/connection.php";
            $user = pg_escape_string($dbconn, $_POST['usuario']);
            $clave = (pg_escape_string($dbconn, $_POST['contraseña']));
            $query = pg_query($dbconn, "SELECT * FROM usuarios WHERE usuario = '$user' AND contraseña = '$clave'");
            pg_close($dbconn);
            $resultado = pg_num_rows($query);
            if ($resultado > 0) {
                $dato = pg_fetch_array($query);
                $_SESSION['active'] = true;
                $_SESSION['id'] = $dato['id'];
                $_SESSION['nombre'] = $dato['nombre'];
                $_SESSION['user'] = $dato['usuario'];
                if($dato['rol'] == 'A') {
                    header('Location: admin/productos.php');
                } elseif ($dato['rol'] == 'C') {
                    header('Location: homeusu.php');
                }
            } else {
                $alert = '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
                Contraseña incorrecta
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                </div>';
                session_destroy();
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" type="text/css" href="assets/css/sb-admin-2.min.css">
    <link rel="shortcut icon" href="assets/img/favicon.ico" />
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image">
                                <img class="img-thumbnail" src="assets/img/logo.png" alt="">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                        <?php echo (isset($alert)) ? $alert : ''; ?>
                                    </div>
                                    <form class="user" method="POST" action="" autocomplete="off">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="usuario" name="usuario" placeholder="Usuario...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="clave" name="contraseña" placeholder="Password">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                        <hr>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="admin/assets/js/jquery-3.6.0.min.js"></script>
    <script src="admin/assets/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="admin/assets/js/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="admin/assets/js/sb-admin-2.min.js"></script>

</body>

</html>