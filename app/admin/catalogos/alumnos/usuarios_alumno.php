<?php
require_once '../../../../config/global.php';

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
   <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">-->
    <?php getTopIncludes(RUTA_INCLUDE ) ?>
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

           <!-- <div class="alert alert-success" role="alert">
                <i class="fas fa-check"></i> Mensaje de éxito
            </div>

            <div class="alert alert-danger" role="alert">
                <i class="fas fa-exclamation-triangle"></i> Mensaje de error
            </div> -->

            <div class="row my-3">
                <div class="col text-right">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus"></i> Agregar Usuario</button>
                </div>
            </div>

            <div class="table-responsive mb-3">
                <table class="table table-bordered table-striped dataTable">
                    <thead>
                    <tr>
                        <th>Matrícula</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Licenciatura</th>
                        <th>Semestre</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>202160177</td>
                        <td>Ximena Ruiz de la Peña</td>
                        <td>202160177@ucc.mx</td>
                        <td>Ing. En Sistemas Computacionales</td>
                        <td>6to</td>
                        <td>2294309616</td>
                        <td class="text-center">
                            <a href="#" class="btn btn-link btn-sm"
                               data-toggle="modal"
                               data-target="#editModal"
                               data-matricula="202160177"
                               data-nombre="Ximena Ruiz de la Peña"
                               data-correo="202160177@ucc.mx"
                               data-licenciatura="Ing. En Sistemas Computacionales"
                               data-semestre="6to"
                               data-telefono="2294309616"><img src="../../../../img/edit-30x30.png" alt="Imagen Editar"></a>
                        </td>
                    </tr>
                    <tr>
                        <td>201960861</td>
                        <td>Bruno Rangel Zuñiga</td>
                        <td>201960861@ucc.mx</td>
                        <td>Ing. En Sistemas Computacionales</td>
                        <td>6to</td>
                        <td>2299133607</td>
                        <td class="text-center">
                            <a href="#" class="btn btn-link btn-sm"
                               data-toggle="modal"
                               data-target="#editModal"
                               data-matricula="201960861"
                               data-nombre="Bruno Rangel Zuñiga"
                               data-correo="201960861@ucc.mx"
                               data-licenciatura="Ing. En Sistemas Computacionales"
                               data-semestre="6to"
                               data-telefono="2299133607"><img src="../../../../img/edit-30x30.png" alt="Imagen Editar"></a>
                        </td>
                    </tr>
                    <tr>
                        <td>202160467</td>
                        <td>Elisa Villa Caballero</td>
                        <td>202160467@ucc.mx</td>
                        <td>Ing. En Sistemas Computacionales</td>
                        <td>6to</td>
                        <td>2831231627</td>
                        <td class="text-center">
                            <a href="#" class="btn btn-link btn-sm"
                               data-toggle="modal"
                               data-target="#editModal"
                               data-matricula="202160467"
                               data-nombre="Elisa Villa Caballero"
                               data-correo="202160467@ucc.mx"
                               data-licenciatura="Ing. En Sistemas Computacionales"
                               data-semestre="6to"
                               data-telefono="2831231627"><img src="../../../../img/edit-30x30.png" alt="Imagen Editar"></a>
                        </td>
                    </tr>
                    <tr>
                        <td>202160171</td>
                        <td>Abimael Ochoa Hernández</td>
                        <td>202160171@ucc.mx</td>
                        <td>Ing. En Sistemas Computacionales</td>
                        <td>6to</td>
                        <td>2297732121</td>
                        <td class="text-center">
                            <a href="#" class="btn btn-link btn-sm"
                               data-toggle="modal"
                               data-target="#editModal"
                               data-matricula="202160171"
                               data-nombre="Abimael Ochoa Hernández"
                               data-correo="202160171@ucc.mx"
                               data-licenciatura="Ing. En Sistemas Computacionales"
                               data-semestre="6to"
                               data-telefono="2297732121"><img src="../../../../img/edit-30x30.png" alt="Imagen Editar"></a>
                        </td>
                    </tr>
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
                                <form id="editForm" method="post" action="editUser.php">
                                    <input type="hidden" id="editMatricula" name="matricula">
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
                                <form id="addForm" method="post" action="addUser.php">
                                    <div class="form-group">
                                        <label for="addNombre">Nombre</label>
                                        <input type="text" class="form-control" id="addNombre" name="nombre">
                                    </div>
                                    <div class="form-group">
                                        <label for="addCorreo">Correo</label>
                                        <input type="email" class="form-control" id="addCorreo" name="correo">
                                    </div>
                                    <div class="form-group">
                                        <label for="addLicenciatura">Licenciatura</label>
                                        <input type="text" class="form-control" id="addLicenciatura" name="licenciatura">
                                    </div>
                                    <div class="form-group">
                                        <label for="addSemestre">Semestre</label>
                                        <input type="text" class="form-control" id="addSemestre" name="semestre">
                                    </div>
                                    <div class="form-group">
                                        <label for="addTelefono">Teléfono</label>
                                        <input type="text" class="form-control" id="addTelefono" name="telefono">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Agregar Usuario</button>
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

    <!-- Incluir jQuery y Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
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

                var modal = $(this);
                modal.find('.modal-body #editMatricula').val(matricula);
                modal.find('.modal-body #editNombre').val(nombre);
                modal.find('.modal-body #editCorreo').val(correo);
                modal.find('.modal-body #editLicenciatura').val(licenciatura);
                modal.find('.modal-body #editSemestre').val(semestre);
                modal.find('.modal-body #editTelefono').val(telefono);
                modal.find('.modal-footer #deleteUser').data('matricula', matricula);
            });

            $('#deleteUser').click(function () {
                var matricula = $(this).data('matricula');
                if(confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
                    $.post('deleteUser.php', { matricula: matricula }, function(result) {
                        alert('Usuario eliminado');
                        location.reload();
                    });
                }
            });
        });
    </script>
<?php getBottomIncudes( RUTA_INCLUDE ) ?>

</body>

</html>
