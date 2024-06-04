<?php
require_once '../../../../config/db.php';
session_start();
// Verificar si se ha recibido un ID de empresa para desactivar
if(isset($_GET['id'])) {
    $empresa_id = $_GET['id'];

    // Actualizar el estado de la empresa en la base de datos
    $sql = "UPDATE Catalogo_empresas SET disponibilidad = 'No Disponible' WHERE id = $empresa_id";
    if ($conexion->query($sql) === TRUE) {
        // Redireccionar de vuelta a la página principal o a donde sea necesario
        header("Location: empresas.php");
        exit();
    } else {
        // Manejar el error si la actualización no es exitosa
        echo "Error al desactivar la empresa: " . $conexion->error;
    }
} else {
    // Manejar el caso en el que no se recibe un ID de empresa válido
    echo "ID de empresa no proporcionado";
}
?>
<?php
