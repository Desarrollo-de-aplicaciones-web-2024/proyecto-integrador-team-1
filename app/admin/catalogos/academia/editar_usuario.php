<?php
require_once '../../../../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $cargo = $_POST['cargo'];

    $sql = "UPDATE Prueba SET nombre='$nombre', correo='$correo', telefono='$telefono', cargo='$cargo' WHERE id='$id'";

    if ($conexion->query($sql) === TRUE) {
        echo "Usuario actualizado correctamente";
    } else {
        echo "Error actualizando usuario: " . $conexion->error;
    }

    $conexion->close();
}
?>
