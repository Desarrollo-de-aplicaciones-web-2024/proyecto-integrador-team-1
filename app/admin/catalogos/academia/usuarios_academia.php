<?php
include_once '../../../../config/global.php';
include_once 'AcademiaUsuario.php';

$database = new Database();
$db = $database->getConnection();
$usuario = new AcademiaUsuario($db);

// Crear usuario
if($_POST && isset($_POST['create'])) {
    $usuario->nombre_completo = $_POST['nombre_completo'];
    $usuario->correo = $_POST['correo'];
    $usuario->telefono = $_POST['telefono'];
    $usuario->cargo = $_POST['cargo'];

    if($usuario->create()) {
        echo "<p class='success-message'>Usuario creado exitosamente.</p>";
    } else {
        echo "<p class='error-message'>Error al crear el usuario.</p>";
    }
}

// Eliminar usuario
if($_GET && isset($_GET['delete'])) {
    $usuario->id = $_GET['delete'];

    if($usuario->delete()) {
        echo "<p class='success-message'>Usuario eliminado exitosamente.</p>";
    } else {
        echo "<p class='error-message'>Error al eliminar el usuario.</p>";
    }
}

// Actualizar usuario
if($_POST && isset($_POST['update'])) {
    $usuario->id = $_POST['id'];
    $usuario->nombre_completo = $_POST['nombre_completo'];
    $usuario->correo = $_POST['correo'];
    $usuario->telefono = $_POST['telefono'];
    $usuario->cargo = $_POST['cargo'];
    $usuario->contrasena = $_POST['contrasena'];

    if($usuario->update()) {
        echo "<p class='success-message'>Usuario actualizado exitosamente.</p>";
    } else {
        echo "<p class='error-message'>Error al actualizar el usuario.</p>";
    }
}

// Leer usuarios
$stmt = $usuario->read();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios de Academia</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #007BFF;
        }
        form {
            margin-bottom: 30px;
        }
        form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        form input[type="text"], form input[type="email"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        form button {
            padding: 10px 15px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        form button:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        table th, table td {
            padding: 10px;
            text-align: left;
        }
        table th {
            background-color: #007BFF;
            color: white;
        }
        .actions button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
        }
        .actions button:hover {
            background-color: #218838;
        }
        .actions a {
            color: #dc3545;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 4px;
            border: 1px solid #dc3545;
            margin-left: 5px;
        }
        .actions a:hover {
            background-color: #dc3545;
            color: white;
        }
        .success-message {
            color: #28a745;
            font-weight: bold;
        }
        .error-message {
            color: #dc3545;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Registro de Usuario</h1>
    <form action="index.php" method="post">
        <input type="hidden" name="id" id="id">
        <label for="nombre_completo">Nombre Completo:</label>
        <input type="text" name="nombre_completo" id="nombre_completo" required><br>
        <label for="correo">Correo:</label>
        <input type="email" name="correo" id="correo" required><br>
        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" id="telefono" required><br>
        <label for="cargo">Cargo:</label>
        <input type="text" name="cargo" id="cargo" required><br>
        <label for="cargo">Contraseña:</label>
        <input type="text" name="contrasena" id="contrasena" disabled><br>


        <button type="submit" name="create">Registrar</button>
        <button type="submit" name="update" id="updateBtn" style="display: none;">Actualizar</button>
    </form>

    <h1>Listado de Usuarios</h1>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Nombre Completo</th>
            <th>Correo</th>
            <th>Teléfono</th>
            <th>Cargo</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                echo "<tr>
                                <td>{$id}</td>
                                <td>{$nombre_completo}</td>
                                <td>{$correo}</td>
                                <td>{$telefono}</td>
                                <td>{$cargo}</td>
                                <td class='actions'>
                                    <button onclick=\"editUser('{$id}', '{$nombre_completo}', '{$correo}', '{$telefono}', '{$cargo}','{$contrasena}')\">Modificar</button>
                                    <a href=\"index.php?delete={$id}\">Eliminar</a>
                                </td>
                              </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No se encontraron usuarios.</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<script>
    function editUser(id, nombre_completo, correo, telefono, cargo) {
        document.getElementById('id').value = id;
        document.getElementById('nombre_completo').value = nombre_completo;
        document.getElementById('correo').value = correo;
        document.getElementById('telefono').value = telefono;
        document.getElementById('cargo').value = cargo;
        document.getElementById('updateBtn').style.display = 'inline';
        document.getElementById('contrasena').style.disabled = 'false';
        document.getElementById('contrasena').style.enabled = 'true';

    }
</script>
</body>
</html>
