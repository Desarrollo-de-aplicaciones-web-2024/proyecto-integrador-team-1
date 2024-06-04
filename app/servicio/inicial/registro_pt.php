<?php
// Conexión a la base de datos
$conn = new mysqli("database-team1-daw.c30w0agw4764.us-east-2.rds.amazonaws.com", "admin", "S1stemas_23", "PP_TEAM1");
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $fecha = $_POST["fecha_inicio"];
    $asistencia = $_POST["asistencia"];
    $horario = $_POST["horario"];
    $descripcion = $_POST["descripcion"];


    // Preparar la consulta SQL para insertar los datos
    $sql = "INSERT INTO plan_trabajo (fecha_inicio,asistencia,horario,descripcion) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conn->error);
    }

    // Asociar los parámetros a la consulta y ejecutarla
    $stmt->bind_param("ssss", $fecha, $asistencia, $horario, $descripcion);
    if ($stmt->execute()) {
        header("Location: documentos-iniciales.php");
        exit();
    } else {
        echo "Error al guardar los datos: " . $stmt->error;
    }

    // Cerrar la consulta y la conexión
    $stmt->close();
    $conn->close();
}
?>