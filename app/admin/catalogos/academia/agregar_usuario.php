<?php
require_once '../../../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_completo = $_POST['nombre_completo'];
    $correo_electronico = $_POST['correo_electronico'];
    $numero_telefono = $_POST['numero_telefono'];
    $cargo = $_POST['cargo'];

    $sql = "INSERT INTO usuarios_academia (nombre_completo,correo_electronico,numero_telefono, cargo) VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssss", $nombre_completo, $correo_electronico, $numero_telefono, $cargo);

    if ($stmt->execute()) {
        echo "Usuario agregado exitosamente.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();
}
?>


