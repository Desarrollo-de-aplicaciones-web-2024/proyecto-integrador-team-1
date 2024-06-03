<?php
// Función para agregar un usuario a la base de datos
function agregarUsuario($conexion, $matricula, $nombre, $correo, $licenciatura, $semestre, $telefono, $sexo) {
    $sql = "INSERT INTO usuarios_alumno (matricula, nombre, correo, licenciatura, semestre, telefono, sexo) 
            VALUES ('$matricula', '$nombre', '$correo', '$licenciatura', '$semestre', '$telefono', '$sexo')";

    return mysqli_query($conexion, $sql);
}

// Manejar la importación de usuarios desde un archivo CSV
$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['csvFile']) && !empty($_FILES['csvFile']['name'])) {
        $csvFile = $_FILES['csvFile'];

        // Verificar que sea un archivo CSV
        $fileType = pathinfo($csvFile['name'], PATHINFO_EXTENSION);
        if ($fileType !== 'csv') {
            $response['success'] = false;
            $response['message'] = 'El archivo debe ser un CSV.';
        } else {
            // Leer el contenido del archivo CSV
            $csvData = file_get_contents($csvFile['tmp_name']);
            $lines = explode(PHP_EOL, $csvData);

            // Iterar sobre cada línea del archivo CSV
            foreach ($lines as $line) {
                // Obtener los campos de cada línea
                $fields = str_getcsv($line);
                if (count($fields) === 7) {
                    // Asignar los valores a variables
                    list($matricula, $nombre, $correo, $licenciatura, $semestre, $telefono, $sexo) = $fields;

                    // Agregar el usuario a la base de datos
                    if (agregarUsuario($conexion, $matricula, $nombre, $correo, $licenciatura, $semestre, $telefono, $sexo)) {
                        // Éxito al agregar el usuario
                        $response['success'] = true;
                        $response['message'] = 'Usuarios importados correctamente.';
                    } else {
                        // Error al agregar el usuario
                        $response['success'] = false;
                        $response['message'] = 'Error al importar usuarios.';
                        break; // Salir del bucle si hay un error
                    }
                } else {
                    // El número de campos no es el esperado
                    $response['success'] = false;
                    $response['message'] = 'El archivo CSV no tiene el formato correcto.';
                    break; // Salir del bucle si hay un error
                }
            }
        }
    } else {
        $response['success'] = false;
        $response['message'] = 'No se proporcionó ningún archivo CSV.';
    }
} else {
    $response['success'] = false;
    $response['message'] = 'Método de solicitud no válido.';
}

echo json_encode($response);
?>
