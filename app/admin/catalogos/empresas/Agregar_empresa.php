<?php
require_once '../../../../config/db.php';
session_start();
$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validar que los campos no estén vacíos
    if (
        isset($_POST['companyName'], $_POST['sector'], $_POST['phone'], $_POST['address'], $_POST['city'], $_POST['state'], $_POST['availability']) &&
        !empty($_POST['companyName']) && !empty($_POST['sector']) && !empty($_POST['phone']) &&
        !empty($_POST['address']) && !empty($_POST['city']) && !empty($_POST['state']) && !empty($_POST['availability']) &&
        isset($_FILES['logo']) && $_FILES['logo']['error'] == UPLOAD_ERR_OK
    ) {
        $nombre = $_POST['companyName'];
        $sector_id = intval($_POST['sector']); // Convertir a entero
        $telefono = $_POST['phone'];
        $direccion = $_POST['address'];
        $ciudad = $_POST['city'];
        $estado = $_POST['state'];
        $disponibilidad = $_POST['availability'];

        // Validar que el teléfono sea un número válido
        if (!is_numeric($telefono)) {
            $response['success'] = false;
            $response['message'] = 'El número de teléfono debe contener solo números.';
        } else {
            // Insertar datos preliminares en la base de datos sin el logo
            $sql = "INSERT INTO Catalogo_empresas (nombre, sector_id, telefono, direccion, ciudad, estado, disponibilidad) 
                    VALUES ('$nombre', $sector_id, '$telefono', '$direccion', '$ciudad', '$estado', '$disponibilidad')";

            if (mysqli_query($conexion, $sql)) {
                $empresa_id = mysqli_insert_id($conexion); // Obtener el ID de la empresa insertada

                // Manejar la carga del archivo
                $uploadDir = '../../../../img/';

                // Construir la ruta del logo según la extensión del archivo subido
                $extension = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
                $logoPath = $uploadDir . "empresa_$empresa_id.$extension";

                // Validar el tipo de archivo
                $allowed_types = ['image/png', 'image/jpeg', 'image/jpg', 'image/gif', 'image/svg+xml'];
                if (!in_array($_FILES['logo']['type'], $allowed_types)) {
                    $response['success'] = false;
                    $response['message'] = 'Tipo de archivo no válido.';
                } elseif ($_FILES['logo']['size'] > 500000) {
                    $response['success'] = false;
                    $response['message'] = 'El archivo es demasiado grande.';
                } else {
                    if (move_uploaded_file($_FILES['logo']['tmp_name'], $logoPath)) {
                        // Actualizar la empresa con la ruta del logo
                        $logo = '/img/' . "empresa_$empresa_id.$extension";

                        $updateSql = "UPDATE Catalogo_empresas SET logo = '$logo' WHERE id = $empresa_id";

                        if (mysqli_query($conexion, $updateSql)) {
                            $response['success'] = true;
                            $response['message'] = 'Empresa agregada correctamente.';
                        } else {
                            $response['success'] = false;
                            $response['message'] = 'Error al actualizar el logo: ' . mysqli_error($conexion);
                        }
                    } else {
                        $response['success'] = false;
                        $response['message'] = 'Error al subir el archivo. ' . $_FILES['logo']['error'];
                    }
                }
            } else {
                $response['success'] = false;
                $response['message'] = 'Error al agregar la empresa: ' . mysqli_error($conexion);
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

$_SESSION['response'] = $response;
header("Location: empresas.php");
exit();
?>
