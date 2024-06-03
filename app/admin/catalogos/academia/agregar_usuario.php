<?php
require_once '../../../../config/global.php';
require_once '../../../../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre_completo'];
    $correo = $_POST['correo_electronico'];
    $telefono = $_POST['numero_telefono'];
    $cargo = $_POST['cargo'];

    // Aquí debes realizar la inserción en la base de datos
    $sql = "INSERT INTO Prueba (nombre, correo, telefono, cargo) VALUES ('$nombre', '$correo', '$telefono', '$cargo')";

    if ($conexion->query($sql) === TRUE) {
        echo "Usuario agregado correctamente";
    } else {
        echo "Error al agregar usuario: " . $conexion->error;
    }
}
?>
