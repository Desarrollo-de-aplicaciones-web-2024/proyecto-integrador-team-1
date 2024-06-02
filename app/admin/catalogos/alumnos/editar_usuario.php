<?php
require_once '../../../../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matricula = $_POST['matricula'];
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $licenciatura = $_POST['licenciatura'];
    $semestre = $_POST['semestre'];
    $telefono = $_POST['telefono'];
    $sexo = $_POST['sexo'];

    $sql = "UPDATE usuarios_alumno SET nombre=?, correo=?, licenciatura=?, semestre=?, telefono=?, sexo=? WHERE matricula=?";
    if ($stmt = $conexion->prepare($sql)) {
        $stmt->bind_param("sssssss", $nombre, $correo, $licenciatura, $semestre, $telefono, $sexo, $matricula);
        if ($stmt->execute()) {
            header("Location: usuarios_alumno.php"); // Redirigir a la página principal
            exit();
        } else {
            echo "ERROR: No se pudo ejecutar $sql. " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "ERROR: No se pudo preparar la consulta: " . $conexion->error;
    }
}
$conexion->close();
?>

