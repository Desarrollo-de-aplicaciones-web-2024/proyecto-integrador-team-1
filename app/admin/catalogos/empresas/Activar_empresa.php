<?php
require_once '../../../../config/db.php';

// Verificar si se ha recibido un ID de empresa para activar
if(isset($_GET['id'])) {
    $empresa_id = $_GET['id'];

    // Actualizar el estado de disponibilidad de la empresa en la base de datos a "Disponible"
    $sql = "UPDATE Catalogo_empresas SET disponibilidad = 'Disponible' WHERE id = $empresa_id";
    if ($conexion->query($sql) === TRUE) {
        // Redireccionar de vuelta a la página principal o a donde sea necesario
        header("Location: empresas.php");
        exit();
    } else {
        // Manejar el error si la actualización no es exitosa
        echo "Error al activar la empresa: " . $conexion->error;
    }
} else {
    // Manejar el caso en el que no se recibe un ID de empresa válido
    echo "ID de empresa no proporcionado";
}
?>

