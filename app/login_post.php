<?php

require 'ModelUsuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo'];
    $pwd = $_POST['pwd'];

    $modelo = new ModeloUsuario();
    $usuario = $modelo->login($correo, $pwd);

    if ($usuario) {
        header('Location: admin/catalogos/alumnos/paginainicio.php');
        exit();
    } else {
        header('Location: index.php');
        exit();
    }
}
?>
