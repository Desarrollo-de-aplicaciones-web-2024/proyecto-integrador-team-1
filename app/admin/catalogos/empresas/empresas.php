<?php
require_once '../../../../config/global.php';
define('DB_HOST', 'database-team1-daw.c30w0agw4764.us-east-2.rds.amazonaws.com');
define('DB_USER', 'admin');
define('DB_PASS', 'S1stemas_23');
define('DB_NAME', 'PP_TEAM1');
// Conexión a la base de datos de Amazon RDS
$conexion = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

define('RUTA_INCLUDE', '../../../../'); // ajustar a necesidad
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo PAGE_TITLE ?></title>

    <?php getTopIncludes(RUTA_INCLUDE ) ?>
    <style>
        th, td {
            text-align: center;
        }

        th {
            background-color: #016CA1;
            color: white;
        }

        .btn-secondary {
            margin: 0 auto;
            display: block;
        }
    </style>
</head>

<body id="page-top">

<?php getNavbar() ?>

<div id="wrapper">

    <?php getSidebar() ?>

    <div id="content-wrapper">

        <div class="container-fluid">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Catálogos</li>
                    <li class="breadcrumb-item active" aria-current="page">Empresas</li>
                </ol>
            </nav>

            <div class="row my-3">
                <div class="col text-right">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addCompanyModal"><i class="fas fa-plus"></i> Agregar Empresa</button>
                </div>
            </div>

            <div class="table-responsive mb-3">
                <table class="table table-bordered dataTable">
                    <thead>
                    <tr>
                        <th>Logo</th>
                        <th>Nombre de la Empresa</th>
                        <th>Sector</th>
                        <th>Número de Teléfono</th>
                        <th>Dirección</th>
                        <th>Disponibilidad</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tbody>
                    <?php
                    $sql = "SELECT Catalogo_empresas.*, sectores.nombre AS sector_nombre 
                            FROM Catalogo_empresas 
                            JOIN sectores ON Catalogo_empresas.sector_id = sectores.id";
                    $result = $conexion->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td><img src='" . $row['logo'] . "' alt='Logo de " . $row['nombre'] . "' class='logo' style='max-width: 100px;'></td>";
                            echo "<td>" . $row['nombre'] . "</td>";
                            echo "<td>" . $row['sector_nombre'] . "</td>";
                            echo "<td>" . $row['telefono'] . "</td>";
                            echo "<td>" . $row['direccion'] . "</td>";
                            echo "<td>" . $row['disponibilidad'] . "</td>";
                            echo "<td><a href='#' class='btn btn-link btn-sm'>Editar</a> <a href='#' class='btn btn-link btn-sm desactivar-empresa'>Desactivar</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No hay empresas registradas</td></tr>";
                    }
                    $conexion->close();
                    ?>
                    </tbody>
                </table>
            </div>

        </div>
        <!-- /.container-fluid -->

        <?php getFooter() ?>

    </div>
    <!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<?php getModalLogout() ?>

<?php getBottomIncudes( RUTA_INCLUDE ) ?>

<!-- Modal Agregar Empresa -->
<div class="modal fade" id="addCompanyModal" tabindex="-1" role="dialog" aria-labelledby="addCompanyModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCompanyModalLabel">Agregar Empresa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addCompanyForm" action="Agregar_empresa.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="companyName">Nombre de la Empresa</label>
                        <input type="text" class="form-control" id="companyName" name="companyName" required>
                    </div>
                    <div class="form-group">
                        <label for="sector">Sector</label>
                        <select class="form-control" id="sector" name="sector" required>
                            <?php
                            // Rellenar el select con los sectores disponibles en la base de datos
                            $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                            $sql = "SELECT id, nombre FROM sectores";
                            $result = $conn->query($sql);
                            while($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
                            }
                            $conn->close();
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="phone">Número de Teléfono</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Dirección</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    <div class="form-group">
                        <label for="availability">Disponibilidad</label>
                        <select class="form-control" id="availability" name="availability" required>
                            <option value="Disponible">Disponible</option>
                            <option value="No Disponible">No Disponible</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="logo">Logo</label>
                        <input type="file" class="form-control-file" id="logo" name="logo" accept="image/*" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" form="addCompanyForm" class="btn btn-primary">Agregar Empresa</button>
            </div>
        </div>
    </div>
</div>

<?php
// Agregar un mensaje de error si hay alguno
if(isset($_SESSION['response'])) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
    echo $_SESSION['response']['message'];
    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
    echo '<span aria-hidden="true">&times;</span>';
    echo '</button>';
    echo '</div>';
    unset($_SESSION['response']);
}
?>


