<?php
include 'config/db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM PP_TEAM1.login WHERE email='$email' AND contraseña='$password'";
    $result = mysqli_query($conexion, $query); // Utiliza la variable $conexion en lugar de $db

    if (mysqli_num_rows($result) == 1) {
        // Inicio de sesión exitoso, redirecciona a la página deseada
        header('Location: pagina_restringida.php');
        exit();
    } else {
        // Usuario o contraseña incorrectos
        echo 'Usuario o contraseña incorrectos';
    }
}
?>
