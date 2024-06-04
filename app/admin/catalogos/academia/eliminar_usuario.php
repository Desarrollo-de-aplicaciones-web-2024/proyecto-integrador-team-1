<?php
require_once '../../../../config/global.php';
require_once '../../../../config/db.php';

if ($_POST) {
    $id = $_POST['id'];

    $sql = "DELETE FROM academia_usuarios WHERE id=$id";
    if (mysqli_query($conexion, $sql)) {
        echo "Usuario eliminado exitosamente.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
    }
}
?>
