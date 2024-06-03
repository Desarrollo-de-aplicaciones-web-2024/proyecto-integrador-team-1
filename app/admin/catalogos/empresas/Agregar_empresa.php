<?php
session_start();
require_once '../../../../config/db.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validar que los campos no estén vacíos
    if (
        isset($_POST['companyName'], $_POST['sector'], $_POST['phone'], $_POST['address'], $_POST['availability']) &&
        !empty($_POST['companyName']) && !empty($_POST['sector']) && !empty($_POST['phone']) &&
        !empty($_POST['address']) && !empty($_POST['availability']) && isset($_FILES['logo']) && $_FILES['logo']['error'] == UPLOAD_ERR_OK
    ) {
        $nombre = $_POST['companyName'];
        $sector_id = intval($_POST['sector']); // Convertir a entero
        $telefono = $_POST['phone'];
        $direccion = $_POST['address'];
        $disponibilidad = $_POST['availability'];

        // Validar que el teléfono sea un número válido
        if (!is_numeric($telefono)) {
            $response['success'] = false;
            $response['message'] = 'El número de teléfono debe contener solo números.';
        } else {
            // Insertar datos preliminares en la base de datos sin el logo
            $sql = "INSERT INTO Catalogo_empresas (nombre, sector_id, telefono, direccion, disponibilidad) 
                    VALUES ('$nombre', $sector_id, '$telefono', '$direccion', '$disponibilidad')";

            if (mysqli_query($conexion, $sql)) {
                $empresa_id = mysqli_insert_id($conexion); // Obtener el ID de la empresa insertada

                // Manejar la carga del archivo
                $uploadDir = '../../../../img/';

                // Construir la ruta del logo para PNG
                $logoPath_png = $uploadDir . "empresa_$empresa_id.png";
                // Construir la ruta del logo para JPG
                $logoPath_jpg = $uploadDir . "empresa_$empresa_id.jpg";
                // Construir la ruta del logo para JPEG
                $logoPath_jpeg = $uploadDir . "empresa_$empresa_id.jpeg";
                // Construir la ruta del logo para GIF
                $logoPath_gif = $uploadDir . "empresa_$empresa_id.gif";
                // Construir la ruta del logo para SVG
                $logoPath_svg = $uploadDir . "empresa_$empresa_id.svg";

                // Seleccionar la ruta adecuada según la extensión del archivo subido
                switch ($_FILES['logo']['type']) {
                    case "image/png":
                        $logoPath = $logoPath_png;
                        break;
                    case "image/jpeg":
                        $logoPath = $logoPath_jpg;
                        break;
                    case "image/jpg":
                        $logoPath = $logoPath_jpeg;
                        break;
                    case "image/gif":
                        $logoPath = $logoPath_gif;
                        break;
                    case "image/svg+xml":
                        $logoPath = $logoPath_svg;
                        break;
                    default:
                        $response['success'] = false;
                        $response['message'] = 'Tipo de archivo no válido.';
                        mysqli_close($conexion);
                        $_SESSION['response'] = $response;
                        header("Location: empresas.php");
                        exit();
                }

                // Validar el tipo de archivo
                $check = getimagesize($_FILES['logo']['tmp_name']);
                if ($check === false) {
                    $response['success'] = false;
                    $response['message'] = 'El archivo no es una imagen.';
                } elseif ($_FILES['logo']['size'] > 500000) {
                    $response['success'] = false;
                    $response['message'] = 'El archivo es demasiado grande.';
                } else {
                    if (move_uploaded_file($_FILES['logo']['tmp_name'], $logoPath)) {
                        // Actualizar la empresa con la ruta del logo según la extensión del archivo
                        switch ($_FILES['logo']['type']) {
                            case "image/png":
                                $logo = '/img/' . "empresa_$empresa_id.png";
                                break;
                            case "image/jpeg":
                                $logo = '/img/' . "empresa_$empresa_id.jpg";
                                break;
                            case "image/jpg":
                                $logo = '/img/' . "empresa_$empresa_id.jpeg";
                                break;
                            case "image/gif":
                                $logo = '/img/' . "empresa_$empresa_id.gif";
                                break;
                            case "image/svg+xml":
                                $logo = '/img/' . "empresa_$empresa_id.svg";
                                break;
                        }

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
