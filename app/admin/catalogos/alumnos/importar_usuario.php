<?php
require_once '../../../../config/global.php';
require_once '../../../../config/db.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['csvFile']) && $_FILES['csvFile']['error'] == 0) {
    $file = $_FILES['csvFile']['tmp_name'];
    $handle = fopen($file, "r");

    if ($handle !== FALSE) {
        $import_success = true;
        $duplicates = [];

        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $matricula = $data[0];
            $nombre = $data[1];
            $correo = $data[2];
            $licenciatura = $data[3];
            $semestre = $data[4];
            $telefono = $data[5];
            $sexo = $data[6];

            // Verificar si la matrícula ya existe
            $checkQuery = "SELECT * FROM usuarios_alumno WHERE matricula = ?";
            $stmt = $conexion->prepare($checkQuery);
            $stmt->bind_param("s", $matricula);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $duplicates[] = $matricula;
            } else {
                // Insertar el usuario en la base de datos
                $insertQuery = "INSERT INTO usuarios_alumno (matricula, nombre, correo, licenciatura, semestre, telefono, sexo) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conexion->prepare($insertQuery);
                $stmt->bind_param("sssssss", $matricula, $nombre, $correo, $licenciatura, $semestre, $telefono, $sexo);
                if (!$stmt->execute()) {
                    $import_success = false;
                }
            }
        }
        fclose($handle);

        if (!$import_success) {
            $_SESSION['response'] = ['success' => false, 'message' => 'Ocurrió un error al importar los usuarios.'];
        } elseif (!empty($duplicates)) {
            $duplicateList = implode(', ', $duplicates);
            $_SESSION['response'] = ['success' => false, 'message' => 'Las siguientes matrículas ya existen: ' . $duplicateList];
        } else {
            $_SESSION['response'] = ['success' => true, 'message' => 'Usuarios importados correctamente.'];
        }
    } else {
        $_SESSION['response'] = ['success' => false, 'message' => 'Error al abrir el archivo.'];
    }
} else {
    $_SESSION['response'] = ['success' => false, 'message' => 'No se recibió ningún archivo CSV o hubo un error al cargarlo.'];
}

header("Location: usuarios_alumno.php");
exit;

$conexion->close();
?>
