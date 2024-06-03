<?php
require_once '../../../../config/global.php';
require_once '../../../../config/db.php';

if ($_POST) {
    $nombre_completo = $_POST['nombre_completo'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $cargo = $_POST['cargo'];

    // Generar contraseña aleatoria
    function generatePassword($length = 10) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        return substr(str_shuffle($chars), 0, $length);
    }

    $contrasena = generatePassword(rand(6, 10));

    $sql = "INSERT INTO academia_usuarios (nombre_completo, correo, telefono, cargo, contrasena) VALUES ('$nombre_completo', '$correo', '$telefono', '$cargo', '$contrasena')";
    if (mysqli_query($conexion, $sql)) {
        echo "Usuario agregado exitosamente.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
    }
}
?>