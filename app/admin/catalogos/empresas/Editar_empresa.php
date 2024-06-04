<?php
require_once '../../../../config/db.php';
session_start(); // Iniciar sesión para manejar mensajes

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario de edición
    $empresa_id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $sector_id = $_POST['sector'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $disponibilidad = $_POST['disponibilidad'];
    $logo = $_POST['logo'];

    // Imprimir los valores para depuración
    error_log("ID: $empresa_id");
    error_log("Nombre: $nombre");
    error_log("Sector ID: $sector_id");
    error_log("Teléfono: $telefono");
    error_log("Dirección: $direccion");
    error_log("Disponibilidad: $disponibilidad");
    error_log("Logo: $logo");

    if(!empty($nombre) && !empty($sector_id) && !empty($telefono) && !empty($direccion) && !empty($disponibilidad) && !empty($logo)) {
        // Consulta SQL para actualizar los datos de la empresa en la base de datos
        $sql = "UPDATE Catalogo_empresas SET nombre=?, sector_id=?, telefono=?, direccion=?, disponibilidad=?, logo=? WHERE id=?";

        // Preparar la consulta
        if ($stmt = $conexion->prepare($sql)) {
            // Vincular parámetros a la consulta
            $stmt->bind_param("sissssi", $nombre, $sector_id, $telefono, $direccion, $disponibilidad, $logo, $empresa_id);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    $_SESSION['response'] = array(
                        "message" => "Empresa actualizada correctamente.",
                        "type" => "success"
                    );
                } else {
                    $_SESSION['response'] = array(
                        "message" => "No se realizaron cambios en la empresa.",
                        "type" => "info"
                    );
                }
                header("Location: empresas.php");
                exit();
            } else {
                $_SESSION['response'] = array(
                    "message" => "Error al actualizar la empresa: " . $stmt->error,
                    "type" => "danger"
                );
                header("Location: empresas.php");
                exit();
            }
            // Cerrar la declaración
            $stmt->close();
        } else {
            $_SESSION['response'] = array(
                "message" => "Error al preparar la consulta: " . $conexion->error,
                "type" => "danger"
            );
            header("Location: empresas.php");
            exit();
        }
    } else {
        $_SESSION['response'] = array(
            "message" => "Datos obligatorios no establecidos.",
            "type" => "danger"
        );
        header("Location: empresas.php");
        exit();
    }
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>