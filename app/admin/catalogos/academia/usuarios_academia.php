<?php
require_once '../../../../config/global.php';
require_once '../../../../config/db.php';

define('RUTA_INCLUDE', '../../../../');
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
    <?php getTopIncludes(RUTA_INCLUDE) ?>
</head>
<body id="page-top">

<?php getNavbar() ?>
<div id="wrapper">
    <?php getSidebar($rutas) ?>
    <div id="content-wrapper">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Catálogos</li>
                    <li class="breadcrumb-item active" aria-current="page">Usuarios Academia</li>
                </ol>
            </nav>
            <div class="row my-3">
                <div class="col text-right">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus"></i> Agregar Usuario</button>
                </div>
            </div>
            <div class="table-responsive mb-3">
                <table class="table table-bordered table-striped dataTable">
                    <thead>
                    <tr>
                        <th>Nombre Completo</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Cargo</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if ($conexion) {
                        $sql = "SELECT * FROM academia_usuarios";
                        if ($result = mysqli_query($conexion, $sql)) {
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $row['nombre_completo'] . "</td>";
                                    echo "<td>" . $row['correo'] . "</td>";
                                    echo "<td>" . $row['telefono'] . "</td>";
                                    echo "<td>" . $row['cargo'] . "</td>";
                                    echo "<td>" . $row['rol'] . "</td>";
                                    echo "<td class='text-center'>";
                                    echo "<a href='#' class='btn btn-link btn-sm' data-toggle='modal' data-target='#editModal' data-id='" . $row['id'] . "' data-nombre_completo='" . $row['nombre_completo'] . "' data-correo='" . $row['correo'] . "' data-telefono='" . $row['telefono'] . "' data-cargo='" . $row['cargo'] . "' data-rol='" . $row['rol'] . "'><img src='../../../../img/edit-30x30.png' alt='Imagen Editar'></a>";
                                    echo "<button class='btn btn-link btn-sm deleteUser' data-id='" . $row['id'] . "'>Eliminar</button>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                mysqli_free_result($result);
                            } else {
                                echo "<tr><td colspan='6'>No se encontraron registros.</td></tr>";
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
                                    <input type="hidden" name="id" id="editId">
                                    <div class="form-group">
                                        <label for="editNombreCompleto">Nombre Completo</label>
                                        <input type="text" class="form-control" id="editNombreCompleto" name="nombre_completo">
                                    </div>
                                    <div class="form-group">
                                        <label for="editCorreo">Correo</label>
                                        <input type="email" class="form-control" id="editCorreo" name="correo">
                                    </div>
                                    <div class="form-group">
                                        <label for="editTelefono">Teléfono</label>
                                        <input type="text" class="form-control" id="editTelefono" name="telefono">
                                    </div>
                                    <div class="form-group">
                                        <label for="editCargo">Cargo</label>
                                        <input type="text" class="form-control" id="editCargo" name="cargo">
                                    </div>
                                    <div class="form-group">
                                        <label for="editRol">Rol</label>
                                        <input type="text" class="form-control" id="editRol" name="rol">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
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
                                        <label for="addNombreCompleto">Nombre Completo</label>
                                        <input type="text" class="form-control" id="addNombreCompleto" name="nombre_completo" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="addCorreo">Correo</label>
                                        <input type="email" class="form-control" id="addCorreo" name="correo" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="addTelefono">Teléfono</label>
                                        <input type="text" class="form-control" id="addTelefono" name="telefono" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="addCargo">Cargo</label>
                                        <input type="text" class="form-control" id="addCargo" name="cargo" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="addRol">Rol</label>
                                        <input type="text" class="form-control" id="addRol" name="rol" required>
                                    </div>
                                    <button type="submit" class="btn btn-success">Agregar Usuario</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <?php getFooter() ?>
    </div>
</div>

<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
<?php getModalLogout() ?>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        // Editar Usuario
        $('#editModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var nombre_completo = button.data('nombre_completo');
            var correo = button.data('correo');
            var telefono = button.data('telefono');
            var cargo = button.data('cargo');
            var rol = button.data('rol');
            var modal = $(this);
            modal.find('.modal-body #editId').val(id);
            modal.find('.modal-body #editNombreCompleto').val(nombre_completo);
            modal.find('.modal-body #editCorreo').val(correo);
            modal.find('.modal-body #editTelefono').val(telefono);
            modal.find('.modal-body #editCargo').val(cargo);
            modal.find('.modal-body #editRol').val(rol);
        });
        // Eliminar Usuario
        $('.deleteUser').click(function() {
            var id = $(this).data('id');
            if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
                $.post('eliminar_usuario.php', { id: id }, function(result) {
                    alert('Usuario eliminado');
                    location.reload();
                });
            }
        });
    });
</script>
<?php getBottomIncudes(RUTA_INCLUDE) ?>
</body>
</html>