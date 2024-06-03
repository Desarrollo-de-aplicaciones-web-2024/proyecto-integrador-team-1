<?php
require 'ModelUsuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo'];
    $pwd = $_POST['pwd'];
    $nombres = $_POST['nombres'];
    $apellido_paterno = $_POST['apellido_paterno'];
    $apellido_materno = $_POST['apellido_materno'];

    $modelo = new ModeloUsuario();
    if ($modelo->insertar($correo, $pwd, $nombres, $apellido_paterno, $apellido_materno)) {
        echo "Registro exitoso";
    } else {
        echo "Error al registrar";
    }
}
?>
