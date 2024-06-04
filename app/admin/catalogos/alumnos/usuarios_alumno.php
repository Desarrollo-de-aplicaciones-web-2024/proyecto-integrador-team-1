<?php
require_once '../../../../config/global.php';
require_once '../../../../config/db.php';

define('RUTA_INCLUDE', '../../../../'); //ajustar a necesidad

session_start();

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
   <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">-->
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

    <?php getSidebar(RUTA_INCLUDE) ?>
    <div id="content-wrapper">

        <div class="container-fluid">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Catálogos</li>
                    <li class="breadcrumb-item active" aria-current="page">Usuarios Alumnos</li>
                </ol>
            </nav>
            <?php if (isset($_SESSION['response'])): ?>
                <div class="alert <?php echo $_SESSION['response']['success'] ? 'alert-success' : 'alert-danger'; ?>" role="alert">
                    <?php echo $_SESSION['response']['message']; ?>
                </div>
                <?php unset($_SESSION['response']); ?>
            <?php endif; ?>

           <!-- <div class="alert alert-success" role="alert">
                <i class="fas fa-check"></i> Mensaje de éxito
            </div>

            <div class="alert alert-danger" role="alert">
                <i class="fas fa-exclamation-triangle"></i> Mensaje de error
            </div> -->
            <div class="row my-3">
                <div class="col text-right">
                    <!-- Contenedor para los botones -->
                    <div class="d-inline">
                        <!-- Botón para importar usuarios -->
                        <button type="button" class="btn btn-primary d-inline-block" data-toggle="modal" data-target="#importModal">
                            <i class="fas fa-file-import"></i> Importar Usuarios
                        </button>
                        <!-- Botón para agregar usuario -->
                        <button type="button" class="btn btn-success d-inline-block ml-2" data-toggle="modal" data-target="#addModal">
                            <i class="fas fa-plus"></i> Agregar Usuario
                        </button>
                    </div>
                </div>
            </div>
            <div class="table-responsive mb-3">
                <table class="table table-bordered table-striped dataTable" >
                    <thead>
                    <tr>
                        <th>Matrícula</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Licenciatura</th>
                        <th>Semestre</th>
                        <th>Teléfono</th>
                        <th>Sexo</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    // Verifica si la conexión a la base de datos existe
                    if ($conexion) {
                        $sql = "SELECT * FROM usuarios_alumno";
                        if ($result = mysqli_query($conexion, $sql)) {
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $row['matricula'] . "</td>";
                                    echo "<td>" . $row['nombre'] . "</td>";
                                    echo "<td>" . $row['correo'] . "</td>";
                                    echo "<td>" . $row['licenciatura'] . "</td>";
                                    echo "<td>" . $row['semestre'] . "</td>";
                                    echo "<td>" . $row['telefono'] . "</td>";
                                    echo "<td>" . $row['sexo'] . "</td>";
                                    echo "<td class='text-center'>";
                                    echo "<a href='#' class='btn btn-link btn-sm' data-toggle='modal' data-target='#editModal' data-matricula='" . $row['matricula'] . "' data-nombre='" . $row['nombre'] . "' data-correo='" . $row['correo'] . "' data-licenciatura='" . $row['licenciatura'] . "' data-semestre='" . $row['semestre'] . "' data-telefono='" . $row['telefono'] . "' data-sexo='" . $row['sexo'] . "'><img src='../../../../img/edit-30x30.png' alt='Imagen Editar'></a>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                mysqli_free_result($result);
                            } else {
                                echo "<tr><td colspan='8'>No se encontraron registros.</td></tr>";
                            }
                        } else {
                            echo "ERROR: No se pudo ejecutar $sql. " . mysqli_error($conexion);
                        }
                    } else {
                        echo "ERROR: No se pudo conectar a la base de datos.";
                    }
                    ?>
                    </tbody>
                </table>

                <!-- Modal Editar -->
                <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Editar Usuario</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="editForm" method="post" action="editar_usuario.php">
                                    <div class="form-group">
                                        <label for="editMatricula">Matrícula</label>
                                        <input type="text" class="form-control" id="editMatricula" name="matricula">
                                    </div>
                                    <div class="form-group">
                                        <label for="editNombre">Nombre</label>
                                        <input type="text" class="form-control" id="editNombre" name="nombre">
                                    </div>
                                    <div class="form-group">
                                        <label for="editCorreo">Correo</label>
                                        <input type="email" class="form-control" id="editCorreo" name="correo">
                                    </div>
                                    <div class="form-group">
                                        <label for="editLicenciatura">Licenciatura</label>
                                        <input type="text" class="form-control" id="editLicenciatura" name="licenciatura">
                                    </div>
                                    <div class="form-group">
                                        <label for="editSemestre">Semestre</label>
                                        <input type="text" class="form-control" id="editSemestre" name="semestre">
                                    </div>
                                    <div class="form-group">
                                        <label for="editTelefono">Teléfono</label>
                                        <input type="text" class="form-control" id="editTelefono" name="telefono">
                                    </div>
                                    <div class="form-group">
                                        <label for="editSexo">Sexo</label>
                                        <select class="form-control" id="editSexo" name="sexo">
                                            <option value="Masculino">Masculino</option>
                                            <option value="Femenino">Femenino</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                    <button type="button" class="btn btn-danger" id="deleteUser" data-matricula="">Eliminar Usuario</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Agregar -->
                <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addModalLabel">Agregar Usuario</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="addForm" method="post" action="agregar_usuario.php">
                                    <div class="form-group">
                                        <label for="matricula">Matrícula</label>
                                        <input type="text" class="form-control" id="matricula" name="matricula" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">Nombre</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="correo">Correo</label>
                                        <input type="email" class="form-control" id="correo" name="correo" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="licenciatura">Licenciatura</label>
                                        <input type="text" class="form-control" id="licenciatura" name="licenciatura" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="semestre">Semestre</label>
                                        <input type="text" class="form-control" id="semestre" name="semestre" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="telefono">Teléfono</label>
                                        <input type="text" class="form-control" id="telefono" name="telefono" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="sexo">Sexo</label>
                                        <select class="form-control" id="sexo" name="sexo" required>
                                            <option value="M">Masculino</option>
                                            <option value="F">Femenino</option>
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Agregar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fin Modal Agregar -->

                <!-- Modal Importar -->
                <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="importModalLabel">Importar Usuarios</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="importForm" action="importar_usuario.php" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="csvFile">Seleccionar archivo CSV</label>
                                        <input type="file" class="form-control-file" id="csvFile" name="csvFile" accept=".csv" required>
                                        <small id="csvHelp" class="form-text text-muted">Asegúrate de que el archivo CSV esté en el formato correcto. Cada línea debe contener los siguientes campos separados por comas: Matrícula, Nombre, Correo, Licenciatura, Semestre, Teléfono, Sexo.</small>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Importar Usuarios</button>
                                </form>
                            </div>
                        </div>
                    </div>
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
    <!-- Validacion de usuario -->

    <script>
        document.getElementById('addForm').addEventListener('submit', function(event) {
            var matricula = document.getElementById('addMatricula').value;
            var correo = document.getElementById('addCorreo').value;

            // Validar que la matrícula sea solo números
            if (!/^\d+$/.test(matricula)) {
                alert('La matrícula debe contener solo números.');
                event.preventDefault();
                return;
            }

            // Validar que el correo termine en "@ucc.mx"
            if (!correo.endsWith('@ucc.mx')) {
                alert('El correo debe finalizar con "@ucc.mx".');
                event.preventDefault();
                return;
            }
        });
    </script>

    <?php getBottomIncudes( RUTA_INCLUDE ) ?>

    <script>
        $(document).ready(function() {
            $('#editModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var matricula = button.data('matricula');
                var nombre = button.data('nombre');
                var correo = button.data('correo');
                var licenciatura = button.data('licenciatura');
                var semestre = button.data('semestre');
                var telefono = button.data('telefono');
                var sexo = button.data('sexo');

                var modal = $(this);
                modal.find('.modal-body #editMatricula').val(matricula);
                modal.find('.modal-body #editNombre').val(nombre);
                modal.find('.modal-body #editCorreo').val(correo);
                modal.find('.modal-body #editLicenciatura').val(licenciatura);
                modal.find('.modal-body #editSemestre').val(semestre);
                modal.find('.modal-body #editTelefono').val(telefono);
                modal.find('.modal-body #editSexo').val(sexo);

                modal.find('.modal-body #deleteUser').data('matricula', matricula);
            });

            $('#deleteUser').click(function() {
                var matricula = $(this).data('matricula');
                if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
                    $.ajax({
                        url: 'eliminar_usuario.php',
                        type: 'POST',
                        data: { matricula: matricula },
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                alert('Usuario eliminado correctamente.');
                                $('#editModal').modal('hide'); // Cerrar el modal
                                location.reload(); // Recargar la página
                            } else {
                                alert('Error al eliminar usuario: ' + response.error);
                            }
                        },
                        error: function(xhr, status, error) {
                            alert('Error al eliminar usuario: ' + xhr.responseText);
                        }
                    });
                }
            });
        });
    </script>

</body>

</html>
