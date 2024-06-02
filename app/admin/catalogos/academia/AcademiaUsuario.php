<?php
class AcademiaUsuario {
    private $conn;
    private $table_name = 'academia_usuarios';

    public $id;
    public $nombre_completo;
    public $correo;
    public $telefono;
    public $cargo;

    public $contrasena;
    public function __construct($db) {
        $this->conn = $db;
    }

    // Crear un nuevo usuario de academia
    public function create() {
        // Generar una contraseña aleatoria entre 8 y 10 caracteres alfanuméricos
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $password_length = rand(8, 10);
        $this->contrasena = '';
        for ($i = 0; $i < $password_length; $i++) {
            $this->contrasena .= $characters[rand(0, strlen($characters) - 1)];
        }

        $query = "INSERT INTO " . $this->table_name . " 
            (nombre_completo, correo, telefono, cargo, contrasena) VALUES 
            (:nombre_completo, :correo, :telefono, :cargo, :contrasena)";

        $stmt = $this->conn->prepare($query);

        $this->nombre_completo = htmlspecialchars(strip_tags($this->nombre_completo));
        $this->correo = htmlspecialchars(strip_tags($this->correo));
        $this->telefono = htmlspecialchars(strip_tags($this->telefono));
        $this->cargo = htmlspecialchars(strip_tags($this->cargo));
        $this->contrasena = htmlspecialchars(strip_tags($this->contrasena));

        $stmt->bindParam(':nombre_completo', $this->nombre_completo);
        $stmt->bindParam(':correo', $this->correo);
        $stmt->bindParam(':telefono', $this->telefono);
        $stmt->bindParam(':cargo', $this->cargo);
        $stmt->bindParam(':contrasena', $this->contrasena);

        if($stmt->execute()) {
            return true;
        }

        return false;
    }


    // Leer todos los usuarios de academia
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Actualizar un usuario de academia
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
            SET nombre_completo=:nombre_completo, correo=:correo, telefono=:telefono, cargo=:cargo, contrasena=:contrasena
            WHERE id=:id";

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->nombre_completo = htmlspecialchars(strip_tags($this->nombre_completo));
        $this->correo = htmlspecialchars(strip_tags($this->correo));
        $this->telefono = htmlspecialchars(strip_tags($this->telefono));
        $this->cargo = htmlspecialchars(strip_tags($this->cargo));

        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':nombre_completo', $this->nombre_completo);
        $stmt->bindParam(':correo', $this->correo);
        $stmt->bindParam(':telefono', $this->telefono);
        $stmt->bindParam(':cargo', $this->cargo);
        $stmt->bindParam(':contrasena', $this->contrasena);

        if($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Eliminar un usuario de academia
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(1, $this->id);

        if($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>
