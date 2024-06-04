<?php
// Conexión a la base de datos
$conn = new mysqli("database-team1-daw.c30w0agw4764.us-east-2.rds.amazonaws.com", "admin", "S1stemas_23", "PP_TEAM1");
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $empresa = $_POST["empresa"];
    $nombresuper = $_POST["nombre_super"];
    $puestosuper = $_POST["puesto_super"];
    $email = $_POST["email"];
    $duracion = $_POST["duracion_practicas"];
    $depto = $_POST["departamento"];
    $puestotentativo = $_POST["puesto_tentativo"];

    // Preparar la consulta SQL para insertar los datos
    $sql = "INSERT INTO solicitud_practicas (empresa, nombre_super, puesto_super,email, duracion_practicas, departamento, puesto_tentativo) VALUES (?, ?, ?, ?, ?, ?,?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conn->error);
    }

    // Asociar los parámetros a la consulta y ejecutarla
    $stmt->bind_param("sssssss", $empresa, $nombresuper, $puestosuper,$email, $duracion, $depto, $puestotentativo);
    if ($stmt->execute()) {
        header("Location: plan_trabajo.php");
        exit();
    } else {
        echo "Error al guardar los datos: " . $stmt->error;
    }

    // Cerrar la consulta y la conexión
    $stmt->close();
    $conn->close();
}
?>