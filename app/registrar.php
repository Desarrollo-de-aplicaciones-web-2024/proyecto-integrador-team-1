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
            max-width: 600px; /* Ampliar el ancho máximo */
            margin: auto;
        }
        .card-header {
            text-align: center;
            font-size: 1.75rem; /* Aumentar el tamaño de la fuente */
            background-color: #0056b3; /* Fondo azul oscuro para el encabezado */
            color: white;
        }
        .card-body {
            padding: 2rem;
        }
        .form-group input {
            border-radius: 0.25rem;
        }
        .btn-primary {
            background-color: #0056b3; /* Azul oscuro para el botón primario */
            border: none;
        }
        .btn-primary:hover {
            background-color: #004a99; /* Azul más oscuro en hover */
        }
        .text-center a {
            color: #0056b3; /* Azul para los enlaces */
        }
        .text-center a:hover {
            color: #004a99; /* Azul más oscuro en hover */
        }
        .card-login img {
            display: block;
            margin: 0 auto 1rem;
            width: 150px; /* Ampliar el ancho de la imagen */
            height: auto;
        }
        .form-label-group {
            margin-bottom: 1rem;
        }
        .text-center h4 {
            margin-bottom: 1rem;
        }
    </style>
</head>

<body class="bg-dark">

<div class="container">
    <div class="card card-login mx-auto mt-5">
        <div class="card-header">Universidad Cristóbal Colón</div>
        <div class="card-body">
            <div class="text-center mb-4">
                <img src="../img/escudoo.svg" alt="Escudo de la Universidad Cristóbal Colón">
                <h4>Registro</h4>
            </div>
            <form>
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="text" id="nombre" class="form-control" placeholder="Nombre(s)" required="required" autofocus="autofocus">
                        <label for="nombre">Nombre(s)</label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-label-group">
                        <input type="text" id="apellido" class="form-control" placeholder="Apellido(s)" required="required">
                        <label for="apellido">Apellido(s)</label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-label-group">
                        <input type="email" id="email" class="form-control" placeholder="Correo electrónico" required="required">
                        <label for="email">Correo electrónico</label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-label-group">
                        <input type="password" id="password" class="form-control" placeholder="Contraseña" required="required">
                        <label for="password">Contraseña</label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-label-group">
                        <input type="password" id="confirmacion" class="form-control" placeholder="Confirme su contraseña" required="required">
                        <label for="confirmacion">Confirme su contraseña</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Registrarse</button>
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
