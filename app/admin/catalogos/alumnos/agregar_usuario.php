<?php
require_once '../../../../config/db.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validar que los campos no estén vacíos
    if (
        isset($_POST['matricula'], $_POST['nombre'], $_POST['correo'], $_POST['licenciatura'],
            $_POST['semestre'], $_POST['telefono'], $_POST['sexo']) &&
        !empty($_POST['matricula']) && !empty($_POST['nombre']) && !empty($_POST['correo']) &&
        !empty($_POST['licenciatura']) && !empty($_POST['semestre']) && !empty($_POST['telefono']) &&
        !empty($_POST['sexo'])
    ) {
        $matricula = intval($_POST['matricula']); // Convertir a entero
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $licenciatura = $_POST['licenciatura'];
        $semestre = $_POST['semestre'];
        $telefono = $_POST['telefono'];
        $sexo = $_POST['sexo'];

        // Validar que la matrícula sean solo números
        if (!is_numeric($matricula)) {
            $response['success'] = false;
            $response['message'] = 'La matrícula debe contener solo números.';
        }
        // Validar que el correo termine en "@ucc.mx"
        elseif (!preg_match("/@ucc\.mx$/", $correo)) {
            $response['success'] = false;
            $response['message'] = 'El correo debe finalizar con "@ucc.mx".';
        } else {
            // Verificar si la matrícula o el correo ya existen en la base de datos
            $checkSql = "SELECT COUNT(*) as count FROM usuarios_alumno WHERE matricula = $matricula OR correo = '$correo'";
            $result = mysqli_query($conexion, $checkSql);
            $row = mysqli_fetch_assoc($result);

            if ($row['count'] > 0) {
                $response['success'] = false;
                $response['message'] = 'La matrícula o el correo ya existen en la base de datos.';
            } else {
                $sql = "INSERT INTO usuarios_alumno (matricula, nombre, correo, licenciatura, semestre, telefono, sexo) 
                        VALUES ('$matricula', '$nombre', '$correo', '$licenciatura', '$semestre', '$telefono', '$sexo')";

                if (mysqli_query($conexion, $sql)) {
                    $response['success'] = true;
                    $response['message'] = 'Usuario agregado correctamente.';
                } else {
                    $response['success'] = false;
                    $response['message'] = 'Error al agregar el usuario: ' . mysqli_error($conexion);
                }
            }
        }
    } else {
        $response['success'] = false;
        $response['message'] = 'Todos los campos son obligatorios.';
    }
} else {
    $response['success'] = false;
    $response['message'] = 'Método de solicitud no válido.';
}

mysqli_close($conexion);

session_start();
$_SESSION['response'] = $response;
header("Location: usuarios_alumno.php");
exit();
?>
