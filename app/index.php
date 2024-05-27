<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Universidad Cristóbal Colón</title>
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../css/sb-admin.css" rel="stylesheet">
    <link href="../img/favicon.ico" rel="shortcut icon" type="image/png"/>
    <style>
        .bg-dark {
            background-color: #0062cc !important;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .card-login {
            width: 100%;
            max-width: 400px;
            margin: auto;
        }
        .card-header {
            text-align: center;
            font-size: 1.5rem;
            background-color: #0062cc;
            color: white;
        }
        .card-body {
            padding: 2rem;
        }
        .form-group input {
            border-radius: 0.25rem;
        }
        .btn-primary {
            background-color: #0062cc;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
        }
        .text-center a {
            color: #0062cc;
        }
        .text-center a:hover {
            color: #0056b3;
        }
        .card-login img {
            display: block;
            margin: 0 auto 1rem;
            width: 100px;
            height: auto;
        }
    </style>
</head>

<body class="bg-dark">

<div class="container">
    <div class="card card-login mx-auto mt-5">
        <div class="card-header">¡Bienvenido!</div>
        <div class="card-body">
            <img src="../img/escudoo.svg" alt="Escudo de la Universidad Cristóbal Colón">
            <form action="login.php" method="post">
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Correo electrónico" required autofocus>
                        <label for="inputEmail">Correo electrónico</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Contraseña" required>
                        <label for="inputPassword">Contraseña</label>
                    </div>
                </div>
                <button class="btn btn-primary btn-block" type="submit">Ingresar</button>
                <a class="btn btn-secondary btn-block" href="registrar.php">Registro</a>
            </form>
            <div class="text-center">
                <a class="d-block small mt-3" href="recuperar.php">¿Olvidó su contraseña?</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
