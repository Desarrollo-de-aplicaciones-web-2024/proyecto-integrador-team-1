<?php
require_once '../../../../config/global.php';
require_once '../../../../config/db.php';

if ($_POST) {
    $id = $_POST['id'];
    $nombre_completo = $_POST['nombre_completo'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $cargo = $_POST['cargo'];

    $sql = "UPDATE academia_usuarios SET nombre_completo='$nombre_completo', correo='$correo', telefono='$telefono', cargo='$cargo' WHERE id=$id";
    if (mysqli_query($conexion, $sql)) {
        echo "Usuario actualizado exitosamente.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
    }
}
?>
