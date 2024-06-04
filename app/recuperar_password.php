<?php
require 'ModelUsuario.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer files
require 'email/autoload.php';

function sendPasswordByEmail($email, $password) {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.hostinger.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'recuperar_contrasena@proyectolibrosminerva.com'; //
        $mail->Password = 'Adri1391-';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('recuperar_contrasena@proyectolibrosminerva.com', 'Proyecto final');
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Recuperación de contraseña';
        $mail->Body    = "Tu contraseña es: $password";

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo'];

    $modelo = new ModeloUsuario();
    $usuario = $modelo->buscarPorCorreo($correo);

    if ($usuario) {
        $password = $usuario['pwd'];
        if (sendPasswordByEmail($correo, $password)) {
            header('Location: index.php');
            exit();
        } else {
            echo "No se pudo enviar el correo. Inténtalo de nuevo.";
        }
    } else {
        echo "Correo no encontrado.";
    }
}
?>
