<?php
require_once '../../../../config/global.php';
require_once '../../../../config/db.php';
define('RUTA_INCLUDE', '../../../../');

// Conexión a la base de datos
$conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Verificar conexión
if ($conexion->connect_error) {
    die("La conexión falló: " . $conexion->connect_error);
}

function getImageData($conexion, $idimages) {
    $sql = "SELECT images_name, images_url FROM images WHERE idimages = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $idimages);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $stmt->close();
    return $data ? $data : ['images_name' => '', 'images_url' => ''];
}

// Obtener datos de las imágenes para cada tarjeta
$imageData1 = getImageData($conexion, 4);
$imageData2 = getImageData($conexion, 5);
$imageData3 = getImageData($conexion, 6);
$imageData4 = getImageData($conexion, 7);
$imageData5 = getImageData($conexion, 8);
$imageData6 = getImageData($conexion, 9);

$conexion->close();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo htmlspecialchars(PAGE_TITLE); ?></title>

    <?php getTopIncludes(RUTA_INCLUDE); ?>
    <style>
        .card {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 10px;
            margin-top: 10px;
        }
    </style>
    <script>
        $(document).ready(function() {
            // Tu código JavaScript aquí
        });
    </script>
</head>

<body id="page-top">

<?php getNavbar(); ?>

<div id="wrapper">

    <?php getSidebar($rutas)?>

    <div id="content-wrapper">

        <div class="container-fluid">
            <section class="jumbotron text-center">
                <div class="container">
                    <h1 class="jumbotron-heading">Vacantes de empresas</h1>
                    <p class="lead text-muted">Aquí encontrarás una lista de las distintas vacantes disponibles en diferentes empresas<br><b>NOTA:</b> la información desplegada puede cambiar sin previo aviso.</p>
                </div>
            </section>

            <div class="album py-5 bg-light">
                <div class="container">

                    <div class="row">
                        <!-- Tarjeta 1 con imagen dinámica -->
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <img src="<?php echo htmlspecialchars($imageData1['images_url']); ?>" class="card-img-top" alt="Imagen dinámica 1">
                                <div class="card-body">

                                    <p class="card-text"><b>Empresa:</b> Grupo Bimbo<br><b>Giro:</b> Panificadora a nivel nacional<br><b>Vacante:</b> Administración de redes</p>
                                </div>
                            </div>
                        </div>

                        <!-- Tarjeta 2 con imagen dinámica -->
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <img src="<?php echo htmlspecialchars($imageData2['images_url']); ?>" class="card-img-top" alt="Imagen dinámica 2">
                                <div class="card-body">

                                    <p class="card-text"><b>Empresa:</b> Grupo Tony<br><b>Giro:</b> Papelería y oficina<br><b>Vacante:</b> Administrador de BD</p>
                                </div>
                            </div>
                        </div>

                        <!-- Tarjeta 3 con imagen dinámica -->
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <img src="<?php echo htmlspecialchars($imageData3['images_url']); ?>" class="card-img-top" alt="Imagen dinámica 3">
                                <div class="card-body">

                                    <p class="card-text"><b>Empresa:</b> Grupo Chedraui<br><b>Giro:</b> Supermercado<br><b>Vacante:</b> Gestor de comunicaciones</p>
                                </div>
                            </div>
                        </div>

                        <!-- Tarjeta 4 con imagen dinámica -->
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <img src="<?php echo htmlspecialchars($imageData4['images_url']); ?>" class="card-img-top" alt="Imagen dinámica 4">
                                <div class="card-body">

                                    <p class="card-text"><b>Empresa:</b> Telmex<br><b>Giro:</b> Telefonía e Internet<br><b>Vacante:</b> Desarrollador Web</p>
                                </div>
                            </div>
                        </div>

                        <!-- Tarjeta 5 con imagen dinámica -->
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <img src="<?php echo htmlspecialchars($imageData5['images_url']); ?>" class="card-img-top" alt="Imagen dinámica 5">
                                <div class="card-body">

                                    <p class="card-text"><b>Empresa:</b> Grupo Lala<br><b>Giro:</b> Lácteos<br><b>Vacante:</b> Analista de Datos</p>
                                </div>
                            </div>
                        </div>

                        <!-- Tarjeta 6 con imagen dinámica -->
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <img src="<?php echo htmlspecialchars($imageData6['images_url']); ?>" class="card-img-top" alt="Imagen dinámica 6">
                                <div class="card-body">

                                    <p class="card-text"><b>Empresa:</b> Centro MICRONA<br><b>Giro:</b> Centro de investigación<br><b>Vacante:</b> Coordinador de Logística</p>
                                </div>
                            </div>
                        </div>
                        <!-- Fin de las tarjetas originales -->
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

        <?php getFooter(); ?>

    </div>
    <!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<?php getModalLogout(); ?>

<?php getBottomIncudes(RUTA_INCLUDE); ?>
</body>

</html>
