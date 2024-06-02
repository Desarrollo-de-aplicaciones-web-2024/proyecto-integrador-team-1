<?php
require_once '../../../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar que todos los campos necesarios están presentes
    if (isset($_POST['matricula'], $_POST['nombre'], $_POST['correo'], $_POST['licenciatura'], $_POST['semestre'], $_POST['telefono'], $_POST['sexo'])) {
        // Obtener los datos del formulario
        $matricula = $_POST['matricula'];
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $licenciatura = $_POST['licenciatura'];
        $semestre = $_POST['semestre'];
        $telefono = $_POST['telefono'];
        $sexo = $_POST['sexo'];

        // Preparar la consulta SQL para insertar el nuevo usuario
        $sql = "INSERT INTO usuarios_alumno (matricula, nombre, correo, licenciatura, semestre, telefono, sexo) VALUES (?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = $conexion->prepare($sql)) {
            $stmt->bind_param("sssssss", $matricula, $nombre, $correo, $licenciatura, $semestre, $telefono, $sexo);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                // Redirigir de nuevo a la página de usuarios
                header("Location: usuarios_alumno.php");
                exit();
            } else {
                echo "ERROR: No se pudo ejecutar la consulta: $sql. " . $conexion->error;
            }
        } else {
            echo "ERROR: No se pudo preparar la consulta: $sql. " . $conexion->error;
        }

        // Cerrar la declaración
        $stmt->close();
    } else {
        echo "ERROR: Faltan datos en el formulario.";
    }
} else {
    echo "ERROR: Método de solicitud no válido.";
}

// Cerrar la conexión
$conexion->close();
?>
