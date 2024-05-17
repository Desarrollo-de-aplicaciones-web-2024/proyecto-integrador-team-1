<?php
require_once '../../../config/global.php';

define('RUTA_INCLUDE', '../../../'); //ajustar a necesidad
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

    <?php getSidebar() ?>

    <div id="content-wrapper">

        <div class="container-fluid">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Registro de datos</li>
                    <li class="breadcrumb-item active" aria-current="page">En este apartado ingresa tus datos del usuario</li>
                </ol>
            </nav>

            <div class="alert alert-danger" role="alert">
                <i class="fas fa-exclamation-triangle"></i> Uno de los formularios está vacío
            </div>


        </div>

        <!-- /.container-fluid -->

        <div class="container">
            <div class="row mb-5">
                <div class="col">
                    <button type="button" class="btn btn-success">Guardar</button>
                </div>
                <div class="col text-right">
                    <button type="button" class="btn btn-link">Cancelar</button>
                </div>
            </div>

            <form>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputNombre">Nombre(s)</label>
                        <input type="text" class="form-control" id="inputNombre">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Apellidos</label>
                        <input type="text" class="form-control" id="inputPassword4">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Email</label>
                        <input type="email" class="form-control" id="inputEmail4">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Matricula</label>
                        <input type="text" class="form-control" id="inputPassword4">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputNombre">Carrera</label>
                        <input type="text" class="form-control" id="inputNombre">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Semestre</label>
                        <input type="text" class="form-control" id="inputPassword4">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputAddress">Número Telefonico</label>
                    <input type="text" class="form-control" id="inputAddress" placeholder="229 923 2950">
                </div>
            </form>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Datos de la empresa</li>
                    <li class="breadcrumb-item active" aria-current="page">En este apartado ingresa los datos de la empresa</li>
                </ol>
            </nav>

                <div class="form-group">
                    <label for="inputAddress2">Nombre de la empresa</label>
                    <input type="text" class="form-control" id="inputAddress2">
                </div>
                <div class="form-group">
                    <label for="inputAddress2">Nombre del encargado</label>
                    <input type="text" class="form-control" id="inputAddress2">
                </div>
            <div class="form-group">
                <label for="inputAddress2">Dirección de la empresa</label>
                <input type="text" class="form-control" id="inputAddress2">
            </div>
            <div class="form-group">
                <label for="inputEmail4">Email</label>
                <input type="email" class="form-control" id="inputEmail4">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputNombre">Codigo postal</label>
                    <input type="text" class="form-control" id="inputNombre">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Número telefónico</label>
                    <input type="text" class="form-control" id="inputPassword4">
                </div>
            </div>
            </form>
        </div>
        <div class="container">
            <div class="row mb-5">
                <div class="col">
                    <button type="button" class="btn btn-success">Guardar</button>
                </div>
                <div class="col text-right">
                    <button type="button" class="btn btn-link">Cancelar</button>
                </div>
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