<?php
require_once '../../../../config/db.php';
session_start();

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (
        isset($_POST['matricula'], $_POST['nombre'], $_POST['correo'], $_POST['licenciatura'],
            $_POST['semestre'], $_POST['telefono'], $_POST['sexo']) &&
        !empty($_POST['matricula']) && !empty($_POST['nombre']) && !empty($_POST['correo']) &&
        !empty($_POST['licenciatura']) && !empty($_POST['semestre']) && !empty($_POST['telefono']) &&
        !empty($_POST['sexo'])
    ) {
        $matricula = intval($_POST['matricula']);
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $licenciatura = $_POST['licenciatura'];
        $semestre = $_POST['semestre'];
        $telefono = $_POST['telefono'];
        $sexo = $_POST['sexo'];

        if (!is_numeric($matricula)) {
            $_SESSION['response'] = ['success' => false, 'message' => 'La matrícula debe contener solo números.'];
        } elseif (!preg_match("/@ucc\.mx$/", $correo)) {
            $_SESSION['response'] = ['success' => false, 'message' => 'El correo debe finalizar con "@ucc.mx".'];
        } else {
            $checkSql = "SELECT COUNT(*) as count FROM usuarios_alumno WHERE matricula = $matricula";
            $result = mysqli_query($conexion, $checkSql);
            $row = mysqli_fetch_assoc($result);

            if ($row['count'] > 0) {
                $_SESSION['response'] = ['success' => false, 'message' => 'La matrícula ya existe en la base de datos.'];
            } else {
                $sql = "INSERT INTO usuarios_alumno (matricula, nombre, correo, licenciatura, semestre, telefono, sexo) 
                        VALUES ('$matricula', '$nombre', '$correo', '$licenciatura', '$semestre', '$telefono', '$sexo')";

                if (mysqli_query($conexion, $sql)) {
                    $_SESSION['response'] = ['success' => true, 'message' => 'Usuario agregado correctamente.'];
                } else {
                    $_SESSION['response'] = ['success' => false, 'message' => 'Error al agregar el usuario: ' . mysqli_error($conexion)];
                }
            }
        }
    } else {
        $_SESSION['response'] = ['success' => false, 'message' => 'Todos los campos son obligatorios.'];
    }
} else {
    $_SESSION['response'] = ['success' => false, 'message' => 'Método de solicitud no válido.'];
}

mysqli_close($conexion);
header("Location: usuarios_alumno.php");
exit();
?>
