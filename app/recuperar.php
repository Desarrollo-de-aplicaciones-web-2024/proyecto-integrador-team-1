<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Universidad Cristóbal Colón</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin.css" rel="stylesheet">
    <link href="../img/favicon.ico" rel="shortcut icon" type="image/png"/>
    <style>
        .bg-dark {
            background-color: #0062cc !important; /* Fondo azul */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .card-login {
            width: 100%;
            max-width: 500px; /* Pantalla más grande */
            margin: auto;
        }
        .card-header {
            text-align: center;
            font-size: 1.5rem;
            background-color: #0056b3;
            color: white;
        }
        .card-body {
            padding: 2rem;
        }
        .form-group input {
            border-radius: 0.25rem;
        }
        .btn-primary {
            background-color: #0056b3;
            border: none;
        }
        .btn-primary:hover {
            background-color: #004494;
        }
        .text-center a {
            color: #0056b3;
        }
        .text-center a:hover {
            color: #004494;
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
        <div class="card-header">Recuperar contraseña</div>
        <div class="card-body">
            <div class="text-center mb-4">
                <img src="../img/escudoo.svg" alt="Escudo de la Universidad Cristóbal Colón">
                <h4>¿Olvidó su contraseña?</h4>
                <p>Se enviará un correo electrónico con instrucciones para recuperar el acceso a su cuenta.</p>
            </div>
            <form>
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="email" id="inputEmail" class="form-control" placeholder="Correo electrónico" required="required" autofocus="autofocus">
                        <label for="inputEmail">Correo electrónico</label>
                    </div>
                </div>
                <a class="btn btn-primary btn-block" href="login.php">Recuperar</a>
            </form>
            <div class="text-center">
                <a class="d-block small mt-3" href="index.php">Página de inicio</a>
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
