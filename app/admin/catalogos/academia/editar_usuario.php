<?php
require_once '../../../../config/global.php';
require_once '../../../../config/db.php';

if ($_POST) {
    // Obtener los datos del formulario
    $id = $_POST['id'];
    $nombre_completo = $_POST['nombre_completo'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $cargo = $_POST['cargo'];
    $rol = $_POST['rol'];

    // Actualizar los datos en la base de datos
    $sql = "UPDATE academia_usuarios SET nombre_completo='$nombre_completo', correo='$correo', telefono='$telefono', cargo='$cargo',rol='$rol' WHERE id=$id";
    if (mysqli_query($conexion, $sql)) {
        // Si se actualizan los datos correctamente, muestra un mensaje de éxito y recarga la página
        echo "<script>alert('Cambios guardados correctamente.'); window.location.href = 'usuarios_academia.php';</script>";
    } else {
        // Si hay un error al actualizar los datos, muestra un mensaje de error
        echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
    }
}
?>