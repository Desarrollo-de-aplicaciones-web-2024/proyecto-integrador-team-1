<?php
require_once '../../../config/global.php';
require_once '../../../config/db.php';

define('RUTA_INCLUDE', '../../../'); // ajustar a necesidad

// Conexión a la base de datos
$conn = new mysqli("database-team1-daw.c30w0agw4764.us-east-2.rds.amazonaws.com", "admin", "S1stemas_23", "PP_TEAM1");
if ($conn->connect_error) {
die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT email, contraseña FROM login";
$result = $conn->query($sql);

$html = '<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Documentos Iniciales</title>
</head>
<body>
<h1>Solicitud Practicas profesionales</h1>
<table border="1">
    <thead>
    <tr>
        <th>Email</th>
        <th>Contraseña</th>
    </tr>
    </thead>
    <tbody>';
    while ($row = $result->fetch_assoc()) {
    $email = $row['email'];
    $contraseña = $row['contraseña'];
    $html .= "<tr>
        <td>$email</td>
        <td>$contraseña</td>
    </tr>";
    }
    $html .= '</tbody>
</table>
</body>
</html>';


$conn->close();


$file_path = 'solicitud_practicas_profesionales.html';
file_put_contents($file_path, $html);


header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
header('Content-Length: ' . filesize($file_path));
readfile($file_path);

unlink($file_path);
?>
