<?php
require_once '../../../config/global.php';
require_once '../../../config/db.php';

define('RUTA_INCLUDE', '../../../'); // ajustar a necesidad

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["action"]) && isset($_POST["id"]) && isset($_POST["comment"])) {
        $action = $_POST["action"];
        $id = intval($_POST["id"]); // Ensure ID is an integer
        $comentarios = mysqli_real_escape_string($conexion, $_POST["comment"]); // Escape the comment

        if ($action === "accept") {
            $sql = "UPDATE Archivos SET estado = 'aceptado', Comentarios = '$comentarios' WHERE id = $id";
        } elseif ($action === "reject") {
            $sql = "UPDATE Archivos SET estado = 'rechazado', Comentarios = '$comentarios' WHERE id = $id";
        }

        $resultado = mysqli_query($conexion, $sql);
        if ($resultado) {
            echo "Success";
        } else {
            echo "Error: " . mysqli_error($conexion);
        }
    }
}
?>
