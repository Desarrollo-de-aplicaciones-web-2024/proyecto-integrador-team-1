<?php
require_once '../../../../config/db.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['matricula'])) {
        $matricula = intval($_POST['matricula']); // Convertir a entero

        mysqli_query($conexion, 'SET foreign_key_checks = 0');

        $sql = "DELETE FROM usuarios_alumno WHERE matricula = $matricula";

        if (mysqli_query($conexion, $sql)) {
            $response['success'] = true;
        } else {
            $response['success'] = false;
            $response['error'] = 'Error al eliminar el usuario: ' . mysqli_error($conexion);
        }

        mysqli_query($conexion, 'SET foreign_key_checks = 1');
    } else {
        $response['success'] = false;
        $response['error'] = 'Matrícula no proporcionada.';
    }
} else {
    $response['success'] = false;
    $response['error'] = 'Método de solicitud no válido.';
}

mysqli_close($conexion);
echo json_encode($response);
?>



