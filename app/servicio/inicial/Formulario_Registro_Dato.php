<?php
require_once '../../../config/global.php';

define('RUTA_INCLUDE', '../../../'); //ajustar a necesidad
// Conexión a la base de datos
$conn = new mysqli("database-team1-daw.c30w0agw4764.us-east-2.rds.amazonaws.com", "admin", "S1stemas_23", "PP_TEAM1");
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
    $sql = "SELECT Razon_social FROM Empresa";
    $result = $conn->query($sql);

if ($result === false) {
    die("Error en la consulta SQL: " . $conn->error);
}
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
</head>

<body id="page-top">

<?php getNavbar() ?>

<div id="wrapper">

    <?php getSidebar($rutas) ?>

    <div id="content-wrapper">

        <div class="container-fluid">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Registro </li>
                    <li class="breadcrumb-item active" aria-current="page">Registro de datos para realizar prácticas profesionales
                    </li>
                </ol>
            </nav>

        </div>

        <!-- /.container-fluid -->

        <div class="container ">
            <form id="formulario-subida" action="registro-up.php" method="post" enctype="multipart/form-data">
                <div class="empresa">
                    <label for="empresa">Empresa:</label>
                    <select name="empresa" class="form-control" aria-label="Default select example">
                        <?php
                        if ($result->num_rows > 0) {
                            // Salida de datos de cada fila
                            while($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row["Razon_social"] . "'>" . $row["Razon_social"] . "</option>";
                            }
                        } else {
                            echo "<option value=''>No hay empresas disponibles</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="nombre-supervisor">Nombre del supervisor directo:</label>
                    <input name="nombre_super" type="text" class="form-control" id="nombre-supervisor">
                </div>
                <div class="form-group">
                    <label for="puesto-supervisor">Puesto del supervisor directo:</label>
                    <input name="puesto_super" type="text" class="form-control" id="puesto-supervisor">
                </div>
                <div class="meses">
                    <label for="duracion-practicas">Duración de las prácticas:</label>
                    <select name="duracion_practicas" class="form-control" aria-label="Default select example">
                        <option value=""># meses</option>
                        <option value="3 meses">3 meses</option>
                        <option value="4 meses">4 meses</option>
                        <option value="5 meses">5 meses</option>
                        <option value="6 meses">6 meses</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="departamento">Departamento:</label>
                    <input name="departamento" type="text" class="form-control" id="departamento">
                </div>
                <div class="form-group">
                    <label for="puesto-tentativo">Puesto tentativo a desempeñar:</label>
                    <input name="puesto_tentativo" type="text" class="form-control" id="puesto-tentativo">
                </div>
                <div class="row mb-5">
                    <div class="col">
                        <input type="submit" value="Guardar" class="btn btn-primary" id="input-subida">
                    </div>
                    <div class="col text-right">
                        <button type="button" class="btn btn-danger">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- /.container -->

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
</body>

</html>
<?php
$conn->close();
?>
