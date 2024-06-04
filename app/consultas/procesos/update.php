<?php
require_once '../../../config/global.php';
require_once '../../../config/db.php';

define('RUTA_INCLUDE', '../../../'); //ajustar a necesidad

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["action"]) && isset($_POST["id"])) {
        $action = $_POST["action"];
        $id = $_POST["id"];

        if ($action === "accept") {

            $sql = "UPDATE Archivos set estado = 'aceptado' WHERE id = $id;";
            $resultado = mysqli_query($conexion, $sql);

        } elseif ($action === "reject") {

            $sql = "UPDATE Archivos set estado = 'rechazado' WHERE id = $id;";
            $resultado = mysqli_query($conexion, $sql);

        }

    }
}

?>
