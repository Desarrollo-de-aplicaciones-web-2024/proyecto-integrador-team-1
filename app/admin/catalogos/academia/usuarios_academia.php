<?php
require_once '../../../../config/global.php';
require_once '../../../../config/db.php';
define('RUTA_INCLUDE', '../../../../'); //ajustar a necesidad
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

    <?php getSidebar() ?>

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
                        <th>Correo Electrónico</th>
                        <th>Número de Teléfono</th>
                        <th>Cargo</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql = "SELECT * FROM Prueba";
                    $result = $conexion->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>".$row["nombre"]."</td>";
                            echo "<td>".$row["correo"]."</td>";
                            echo "<td>".$row["telefono"]."</td>";
                            echo "<td>".$row["cargo"]."</td>";
                            echo '<td class="text-center">
                    <a href="#" class="btn btn-link btn-sm" data-toggle="modal" data-target="#editModal"
                    data-id="'.$row["id"].'"
                    data-nombre="'.$row["nombre"].'"
                    data-correo="'.$row["correo"].'"
                    data-telefono="'.$row["telefono"].'"
                    data-cargo="'.$row["cargo"].'"><img src="../../../../img/edit-30x30.png"></a>
                    </td>';
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No hay usuarios registrados</td></tr>";
                    }
                    ?>
                    </tbody>

                </table>
            </div>

        </div>

        <?php getFooter() ?>

    </div>
</div>

<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<?php getModalLogout() ?>

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
                <form id="editForm">
                    <input type="hidden" id="editId" name="id">
                    <div class="form-group">
                        <label for="editNombre">Nombre</label>
                        <input type="text" class="form-control" id="editNombre" name="nombre">
                    </div>
                    <div class="form-group">
                        <label for="editCorreo">Correo</label>
                        <input type="email" class="form-control" id="editCorreo" name="correo">
                    </div>
                    <div class="form-group">
                        <label for="editTelefono">Número de Teléfono</label>
                        <input type="text" class="form-control" id="editTelefono" name="telefono">
                    </div>
                    <div class="form-group">
                        <label for="editCargo">Cargo</label>
                        <input type="text" class="form-control" id="editCargo" name="cargo">
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    <button type="button" class="btn btn-danger" id="deleteUser">Eliminar Usuario</button>
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
                <form id="addForm" method="post">
                    <div class="form-group">
                        <label for="addNombre">Nombre Completo</label>
                        <input type="text" class="form-control" id="addNombre" name="nombre_completo" required>
                    </div>
                    <div class="form-group">
                        <label for="addCorreo">Correo Electronico</label>
                        <input type="email" class="form-control" id="addCorreo" name="correo_electronico" required>
                    </div>
                    <div class="form-group">
                        <label for="addTelefono">Número de Teléfono</label>
                        <input type="text" class="form-control" id="addTelefono" name="numero_telefono" required>
                    </div>
                    <div class="form-group">
                        <label for="addCargo">Cargo</label>
                        <input type="text" class="form-control" id="addCargo" name="cargo" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar Usuario</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php getBottomIncudes(RUTA_INCLUDE) ?>

<!-- Incluir jQuery y Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function(){
        $('#addForm').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                url: 'agregar_usuario.php',
                method: 'POST',
                data: $(this).serialize(),
                success: function(data){
                    alert(data);
                    $('#addForm')[0].reset();
                    $('#addModal').modal('hide');
                    location.reload(); // Recargar la página para ver los cambios
                }
            });
        });

        $('#editModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var nombre = button.data('nombre');
            var correo = button.data('correo');
            var telefono = button.data('telefono');
            var cargo = button.data('cargo');

            var modal = $(this);
            modal.find('.modal-body #editId').val(id);
            modal.find('.modal-body #editNombre').val(nombre);
            modal.find('.modal-body #editCorreo').val(correo);
            modal.find('.modal-body #editTelefono').val(telefono);
            modal.find('.modal-body #editCargo').val(cargo);
        });

        $('#editForm').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                url: 'editar_usuario.php',
                method: 'POST',
                data: $(this).serialize(),
                success: function(data){
                    alert(data);
                    $('#editForm')[0].reset();
                    $('#editModal').modal('hide');
                    location.reload(); // Recargar la página para ver los cambios
                }
            });
        });

        $('#deleteUser').on('click', function(event){
            var id = $('#editId').val();
            if(confirm('¿Estás seguro de que quieres eliminar este usuario?')){
                $.ajax({
                    url: 'eliminar_usuario.php',
                    method: 'POST',
                    data: { id: id },
                    success: function(data){
                        alert(data);
                        $('#editModal').modal('hide');
                        location.reload(); // Recargar la página para ver los cambios
                    }
                });
            }
        });
    });
</script>

</body>

</html>
