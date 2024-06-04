<?php
require_once '../../../../config/global.php';
require_once '../../../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['csvFile']) && $_FILES['csvFile']['error'] == 0) {
    $file = $_FILES['csvFile']['tmp_name'];
    $handle = fopen($file, "r");

    if ($handle !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $matricula = $data[0];
            $nombre = $data[1];
            $correo = $data[2];
            $licenciatura = $data[3];
            $semestre = $data[4];
            $telefono = $data[5];
            $sexo = $data[6];

            $stmt = $conexion->prepare("INSERT INTO usuarios_alumno (matricula, nombre, correo, licenciatura, semestre, telefono, sexo) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssss", $matricula, $nombre, $correo, $licenciatura, $semestre, $telefono, $sexo);
            $stmt->execute();

            if ($stmt->error) {
                echo "Error al insertar usuario: " . $stmt->error;
                exit;
            }
        }
        fclose($handle);
        // Redirigir a la página principal después de importar los usuarios
        header("Location: usuarios_alumno.php");
        exit;
    } else {
        echo "Error al abrir el archivo.";
    }
} else {
    echo "No se recibió ningún archivo CSV o hubo un error al cargarlo.";
}

$conexion->close();
?>
