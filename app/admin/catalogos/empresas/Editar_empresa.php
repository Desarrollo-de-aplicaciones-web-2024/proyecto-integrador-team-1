<?php
require_once '../../../../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario de edición
    $empresa_id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $sector_id = $_POST['sector'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $disponibilidad = $_POST['disponibilidad'];
    $logo = $_POST['logo'];

    // Consulta SQL para actualizar los datos de la empresa en la base de datos
    $sql = "UPDATE Catalogo_empresas SET nombre=?, sector_id=?, telefono=?, direccion=?, disponibilidad=?, logo=? WHERE id=?";

    // Preparar la consulta
    if ($stmt = $conexion->prepare($sql)) {
        // Vincular parámetros a la consulta
        $stmt->bind_param("sissssi", $nombre, $sector_id, $telefono, $direccion, $disponibilidad, $logo, $empresa_id);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            // Redirigir a la página principal después de la actualización
            header("Location: empresas.php");
            exit();
        } else {
            echo "ERROR: No se pudo ejecutar la consulta $sql. " . $stmt->error;
        }
        // Cerrar la declaración
        $stmt->close();
    } else {
        echo "ERROR: No se pudo preparar la consulta: " . $conexion->error;
    }
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>