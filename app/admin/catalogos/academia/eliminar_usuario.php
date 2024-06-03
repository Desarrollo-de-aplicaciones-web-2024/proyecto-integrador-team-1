<?php
require_once '../../../../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    $sql = "DELETE FROM Prueba WHERE id='$id'";

    if ($conexion->query($sql) === TRUE) {
        echo "Usuario eliminado correctamente";
    } else {
        echo "Error eliminando usuario: " . $conexion->error;
    }

    $conexion->close();
}
?>
