<?php
require 'ModelUsuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo'];
    $pwd = $_POST['pwd'];

    $modelo = new ModeloUsuario();
    $usuario = $modelo->login($correo, $pwd);

    if ($usuario) {
        echo "Login exitoso";
    } else {
        echo "Correo o contraseña incorrecto";
    }
}
?>
