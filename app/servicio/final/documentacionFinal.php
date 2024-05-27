<?php
require_once '../../../config/global.php';

define('RUTA_INCLUDE', '../../../'); // ajustar a necesidad
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="estilos.css" >

    <title><?php echo "Documentos Finales" ?></title>

    <?php getTopIncludes(RUTA_INCLUDE) ?>

    <style>
        .circle-pendiente{
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: 	#FF8000;
            display: inline-block;
            margin-right: 10px;
        }

        .circle-aprobado{
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: #008000;
            display: inline-block;
            margin-right: 10px;
        }

        .circle-rechazado{
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: #FF0000;
            display: inline-block;
            margin-right: 10px;
        }

        #archivo {
            display: none; /* Oculta el input de tipo file */
        }

        #mensaje-error {
            display: none;
        }
    </style>
</head>

<body id="page-top">

<?php getNavbar() ?>

<div id="wrapper">

    <?php getSidebar();?>

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Page Content -->
            <h1>Documentos Finales</h1>
            <hr>
            <p><b>En este espacio descargarás los documentos necesarios para el final de tus prácticas profesionales, así como llenar todos los documentos necesarios
            </p></b>
            <div class="alert alert-info" role="alert">
                <strong>Nota:</strong>
                <ul class="mb-0">
                    <li>No subir archivos manchados o maltratados.</li>
                    <li>Recuerda cumplir con todos los documento necesarios para poder completar tu periodo de practicas</li>
                    <li>Los nombres de los archivos PDF deben de ser: "Reporte_Global.pdf", "Reseña_Practicas.pdf" y "Constancia.pdf"</li>

                </ul>
            </div>
            <div class="container">
                <h4><b>Archivos por subir</b></h4>

                <p id="mensaje-error" class="alert alert-danger"></p>

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="align-middle">Archivos</th>
                        <th class="align-middle text-center">Estatus</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="align-middle">Reporte global</td>
                        <td class="align-middle text-center"><div class="circle-rechazado"></div></td>
                    </tr>
                    <tr>
                        <td class="align-middle">Reseña practicas profesionales
                        </td>
                        <td class="align-middle text-center"><div class="circle-rechazado"></div></td>
                    </tr>
                    <tr>
                        <td class="align-middle">Constancia finalizacion</td>
                        <td class="align-middle text-center"><div class="circle-rechazado"></div></td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <form id="formulario-subida" action="subir.php" method="post" enctype="multipart/form-data">
            <div class="row my-3 justify-content-center">
                <div class="col-auto">
                    <button type="button" class="btn btn-primary">Descargar archivos</button>
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-primary" id="boton-subir">Subir Archivos</button>
                    <input type="file" name="archivo" id="archivo" accept="application/pdf">

                </div>
               </div>
                <div class="archivos_subidos">

                </div>

            <div class="d-flex flex-column" style="height: 15vh;">
                <div class="flex-grow-1"></div>
                <div class="row my-3">
                    <div class="col text-right">
                        <input type="submit" value="Subir Archivos" class="btn btn-success"</input>
                    </div>
                </div>
            </div>
            </form>


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

<?php getBottomIncudes(RUTA_INCLUDE) ?>

<script>

    //Mostrar archivos ya subidos
    const crearElemento = (texto)=>{
        let div = document.querySelector('.archivos_subidos');
        let li = document.createElement('li');
        li.className = 'list-group-item list-group-item-primary';
        li.textContent = texto;
        div.appendChild(li);

    }

    //BOTON SUBIDA
    document.getElementById('boton-subir').addEventListener('click', function() {
        document.getElementById('archivo').click();
    });

    //Validacion archivo pdf
    document.getElementById('archivo').addEventListener('change', function() {
        const archivo = this.files[0];
        const mensajeError = document.getElementById('mensaje-error');

        if(archivo.name === 'Reporte_Global.pdf' || archivo.name === 'Reseña_Practicas.pdf' || archivo.name === 'Constancia.pdf'){
            if (archivo && archivo.type === 'application/pdf') {
                crearElemento(archivo.name);
                mensajeError.style.display = 'none'; // Oculta el mensaje de error si el archivo es válido
            } else {
                mensajeError.style.display = 'block'; // Muestra el mensaje de error si el archivo no es un PDF
                mensajeError.textContent = "Solo se permiten archivos PDF";
                this.value = ''; // Resetea el input de archivo para permitir una nueva selección
            }
        } else{
            document.getElementById('boton-subir').textContent = 'Seleccionar Archivo';
            mensajeError.style.display = 'block'; // Muestra el mensaje de error si el archivo no es un PDF
            mensajeError.textContent = "Escoge un nombre valido";
            this.value = ''; // Resetea el input de archivo para permitir una nueva selección
        }

    });



</script>
</body>

</html>
