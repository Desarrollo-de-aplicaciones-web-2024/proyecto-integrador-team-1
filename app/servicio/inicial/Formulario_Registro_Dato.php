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
                    <li class="breadcrumb-item">Registro </li>
                    <li class="breadcrumb-item active" aria-current="page">Registro de datos para realizar prácticas profesionales
                    </li>
                </ol>
            </nav>

        </div>

        <!-- /.container-fluid -->

        <div class="container">
            <form>
                <div class="form-group">
                    <label for="inputAddress2">Empresa:    </label>

                <select class="form-select" aria-label="Default select example">
                <option selected>Nombre de la empresa</option>
                <option value="1">Empresa 1</option>
                <option value="2">Empresa 2</option>
                <option value="3">Empresa 3</option>
                </select>
                </div>
                <div class="form-group">
                    <label for="inputAddress2">Nombre del supervisor directo</label>
                    <input type="text" class="form-control" id="inputAddress2">
                </div>
                <div class="form-group">
                <label for="inputAddress2">Puesto del supervisor directo</label>
                <input type="text" class="form-control" id="inputAddress2">
                 </div>
            <div class="form-group">
                <label for="inputEmail4">Email:</label>
                <input type="email" class="form-control" id="inputEmail4">
            </div>

            <div class="form-group">
                <label for="inputAddress2">Duración de las prácticas:    </label>

                <select class="form-select" aria-label="Default select example">
                    <option selected> # meses</option>
                    <option value="1">3 meses</option>
                    <option value="2">4 meses</option>
                    <option value="3">5 meses</option>
                    <option value="3">6 meses</option>
                </select>
            </div>
            <div class="form-group">
                <label for="inputEmail4">Departamento:</label>
                <input type="text" class="form-control" id="inputEmail4">
            </div>
            <div class="form-group">
                <label for="inputEmail4">Puesto tentativo a desempeñar:</label>
                <input type="text" class="form-control" id="inputEmail4">
            </div>
            </form>
            <div class="row mb-5">
                <div class="col">
                    <button onclick="window.location.href='plan_trabajo.php'" class="btn btn-primary">Guardar</button>
                </div>
                <div class="col text-right">
                    <button type="button" class="btn btn-danger">Cancelar</button>
                </div>
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