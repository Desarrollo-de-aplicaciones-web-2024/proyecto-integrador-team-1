<?php
require_once '../../../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matricula = $_POST['matricula'];

    $sql = "DELETE FROM usuarios_alumno WHERE matricula = ?";
    if ($stmt = $conexion->prepare($sql)) {
        $stmt->bind_param("s", $matricula);
        if ($stmt->execute()) {
            header("Location: usuarios_alumno.php"); // Redirigir a la página principal
            exit();
        } else {
            echo "Error al eliminar el registro: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conexion->error;
    }
    $conexion->close();
} else {
    header("Location: usuarios_alumno.php");
    exit();
}
?>

