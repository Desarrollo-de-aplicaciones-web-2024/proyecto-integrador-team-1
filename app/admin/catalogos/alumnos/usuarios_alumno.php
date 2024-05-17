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

    <?php getSidebar() ?>

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
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Fecha de inicio</th>
                        <th>Etapa</th>
                        <th>Empresa</th>
                        <th>Supervisor</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Ximena Ruiz de la Peña</td>
                        <td>202160177@ucc.mx</td>
                        <td>01/04/2024</td>
                        <td>Reporte mensual 2</td>
                        <td>Grupo Más</td>
                        <td>Ing. Guillermo Gomez Fernández</td>
                        <td class="text-center">
                            <a href="#" class="btn btn-link btn-sm"
                               data-toggle="modal"
                               data-target="#editModal"
                               data-nombre="Ximena Ruiz de la Peña"
                               data-correo="202160177@ucc.mx"
                               data-fecha="2024-04-01"
                               data-etapa="Reporte mensual 2"
                               data-empresa="Grupo Más"
                               data-supervisor="Ing. Guillermo Gomez Fernández"><img src="../../../../img/edit-30x30.png" alt="Imagen Editar"></a>
                        </td>
                    </tr>
                    <tr>
                        <td>Bruno Rangel Zuñiga</td>
                        <td>201960861@ucc.mx</td>
                        <td>11/08/2023</td>
                        <td>Finalizado</td>
                        <td>UV Microna</td>
                        <td>Dr. Jaime Martínez Castillo</td>
                        <td class="text-center">
                            <a href="#" class="btn btn-link btn-sm"
                               data-toggle="modal"
                               data-target="#editModal"
                               data-nombre="Bruno Rangel Zuñiga"
                               data-correo="201960861@ucc.mx"
                               data-fecha="2023-08-11"
                               data-etapa="Finalizado"
                               data-empresa="UV Microna"
                               data-supervisor="Dr. Jaime Martínez Castillo"><img src="../../../../img/edit-30x30.png" alt="Imagen Editar"></a>
                        </td>
                    </tr>
                    <tr>
                        <td>Elisa Villa Caballero</td>
                        <td>202160467@ucc.mx</td>
                        <td>01/04/2024</td>
                        <td>Reporte mensual 2</td>
                        <td>Grupo Más</td>
                        <td>Ing. Guillermo Gomez Fernández</td>
                        <td  class="text-center">
                            <a href="#" class="btn btn-link btn-sm"
                               data-toggle="modal"
                               data-target="#editModal"
                               data-nombre="Elisa Villa Caballero"
                               data-correo="202160467@ucc.mx"
                               data-fecha="2024-04-01"
                               data-etapa="Reporte mensual 2"
                               data-empresa="Grupo Más"
                               data-supervisor="Ing. Guillermo Gomez Fernández"><img src="../../../../img/edit-30x30.png" alt="Imagen Editar"></a>
                        </td>
                    </tr>
                    <tr>
                        <td>Abimael Ochoa Hernández</td>
                        <td>202160177@ucc.mx</td>
                        <td>01/04/2024</td>
                        <td>Reporte mensual 2</td>
                        <td>Grupo Más</td>
                        <td>Ing. Guillermo Gomez Fernández</td>
                        <td  class="text-center">
                            <a href="#" class="btn btn-link btn-sm"
                               data-toggle="modal"
                               data-target="#editModal"
                               data-nombre="Abimael Ocho Hernández"
                               data-correo="202160171@ucc.mx"
                               data-fecha="2024-04-01"
                               data-etapa="Reporte mensual 2"
                               data-empresa="Grupo Más"
                               data-supervisor="Ing. Guillermo Gomez Fernández"><img src="../../../../img/edit-30x30.png" alt="Imagen Editar"></a>
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
                                <form id="editForm">
                                    <div class="form-group">
                                        <label for="editNombre">Nombre</label>
                                        <input type="text" class="form-control" id="editNombre" name="nombre">
                                    </div>
                                    <div class="form-group">
                                        <label for="editCorreo">Correo</label>
                                        <input type="email" class="form-control" id="editCorreo" name="correo">
                                    </div>
                                    <div class="form-group">
                                        <label for="editFecha">Fecha de Inicio</label>
                                        <input type="date" class="form-control" id="editFecha" name="fecha">
                                    </div>
                                    <div class="form-group">
                                        <label for="editEtapa">Etapa</label>
                                        <input type="text" class="form-control" id="editEtapa" name="etapa">
                                    </div>
                                    <div class="form-group">
                                        <label for="editEmpresa">Empresa</label>
                                        <input type="text" class="form-control" id="editEmpresa" name="empresa">
                                    </div>
                                    <div class="form-group">
                                        <label for="editSupervisor">Supervisor</label>
                                        <input type="text" class="form-control" id="editSupervisor" name="supervisor">
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
                                <form id="addForm">
                                    <div class="form-group">
                                        <label for="addNombre">Nombre</label>
                                        <input type="text" class="form-control" id="addNombre" name="nombre">
                                    </div>
                                    <div class="form-group">
                                        <label for="addCorreo">Correo</label>
                                        <input type="email" class="form-control" id="addCorreo" name="correo">
                                    </div>
                                    <div class="form-group">
                                        <label for="addFecha">Fecha de Inicio</label>
                                        <input type="date" class="form-control" id="addFecha" name="fecha">
                                    </div>
                                    <div class="form-group">
                                        <label for="addEtapa">Etapa</label>
                                        <input type="text" class="form-control" id="addEtapa" name="etapa">
                                    </div>
                                    <div class="form-group">
                                        <label for="addEmpresa">Empresa</label>
                                        <input type="text" class="form-control" id="addEmpresa" name="empresa">
                                    </div>
                                    <div class="form-group">
                                        <label for="addSupervisor">Supervisor</label>
                                        <input type="text" class="form-control" id="addSupervisor" name="supervisor">
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
            var nombre = button.data('nombre');
            var correo = button.data('correo');
            var fecha = button.data('fecha');
            var etapa = button.data('etapa');
            var empresa = button.data('empresa');
            var supervisor = button.data('supervisor');

            var modal = $(this);
            modal.find('.modal-body #editNombre').val(nombre);
            modal.find('.modal-body #editCorreo').val(correo);
            modal.find('.modal-body #editFecha').val(fecha);
            modal.find('.modal-body #editEtapa').val(etapa);
            modal.find('.modal-body #editEmpresa').val(empresa);
            modal.find('.modal-body #editSupervisor').val(supervisor);
        });

        $('#deleteUser').click(function () {
            // Aquí agregarías la lógica para eliminar al usuario
            alert('Usuario eliminado');
            $('#editModal').modal('hide');
        });
    });
</script>
<?php getBottomIncudes( RUTA_INCLUDE ) ?>

</body>

</html>
