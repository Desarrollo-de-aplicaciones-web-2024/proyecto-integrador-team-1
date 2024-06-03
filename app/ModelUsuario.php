<?php
require_once 'Database.php';

class ModeloUsuario {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function insertar($correo, $pwd, $nombres, $apellido_paterno, $apellido_materno) {
        $sql = "INSERT INTO registro_usuarios (correo, pwd, nombres, apellido_paterno, apellido_materno) VALUES (:correo, :pwd, :nombres, :apellido_paterno, :apellido_materno)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':pwd', $pwd);
        $stmt->bindParam(':nombres', $nombres);
        $stmt->bindParam(':apellido_paterno', $apellido_paterno);
        $stmt->bindParam(':apellido_materno', $apellido_materno);
        if ($stmt->execute()) {
            // Redirigir a index.php si el registro fue exitoso
            header("Location: index.php");
            exit();
        } else {
            // Manejar el error si la inserción falla (opcional)
            echo "Error al registrar el usuario.";
        }
    }

    public function eliminar($id) {
        $sql = "DELETE FROM registro_usuarios WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function modificar($id, $correo, $pwd, $nombres, $apellido_paterno, $apellido_materno) {
        $sql = "UPDATE registro_usuarios SET correo = :correo, pwd = :pwd, nombres = :nombres, apellido_paterno = :apellido_paterno, apellido_materno = :apellido_materno WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':pwd', $pwd);
        $stmt->bindParam(':nombres', $nombres);
        $stmt->bindParam(':apellido_paterno', $apellido_paterno);
        $stmt->bindParam(':apellido_materno', $apellido_materno);
        return $stmt->execute();
    }

    public function buscarPorCorreo($correo) {
        $sql = "SELECT * FROM registro_usuarios WHERE correo = :correo";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function buscar($id) {
        $sql = "SELECT * FROM registro_usuarios WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function login($correo, $pwd) {
        $sql = "SELECT * FROM registro_usuarios WHERE correo = :correo AND pwd = :pwd";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':pwd', $pwd);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
