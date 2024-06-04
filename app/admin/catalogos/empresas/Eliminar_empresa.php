<?php
require_once '../../../../config/global.php';
require_once '../../../../config/db.php';

session_start();

if (isset($_GET['id'])) {
    $empresa_id = intval($_GET['id']);

    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Eliminar la empresa solo si está marcada como "No Disponible"
    $sql = "DELETE FROM Catalogo_empresas WHERE id = ? AND disponibilidad = 'No Disponible'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $empresa_id);

    if ($stmt->execute()) {
        $_SESSION['response'] = array(
            "type" => "success",
            "message" => "Empresa eliminada con éxito."
        );
    } else {
        $_SESSION['response'] = array(
            "type" => "danger",
            "message" => "Error al eliminar la empresa."
        );
    }

    $stmt->close();
    $conn->close();
}

header("Location: empresas.php");
exit();
?>

