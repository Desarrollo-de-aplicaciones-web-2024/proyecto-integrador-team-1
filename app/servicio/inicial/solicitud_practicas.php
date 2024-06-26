<?php
require_once '../../../config/global.php';
require_once '../../../config/db.php';

define('RUTA_INCLUDE', '../../../'); // ajustar a necesidad

// Conexión a la base de datos
$conn = new mysqli("database-team1-daw.c30w0agw4764.us-east-2.rds.amazonaws.com", "admin", "S1stemas_23", "PP_TEAM1");
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error); // Verifica si hay un error en la conexión y termina la ejecución si es así.
}

// Obtener datos de la tabla usuarios_alumno
$matricula = '202160172'; // Define la matrícula del alumno a buscar.
$sql = "SELECT nombre, matricula, licenciatura, semestre, correo, sexo FROM usuarios_alumno WHERE matricula = '$matricula'";// Consulta SQL para obtener los datos del alumno.

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // Obtener los datos del primer resultado
    $row = $result->fetch_assoc();
    $nombre = $row['nombre'];
    $matricula = $row['matricula'];
    $licenciatura = $row['licenciatura'];
    $semestre = $row['semestre'];
    $correo = $row['correo'];
    $sexo = $row['sexo'];
} else {
    die("No se encontraron datos del alumno."); // Termina la ejecución si no se encuentran datos.
}

$aseguramiento = '14';
$jefe = '15';

// Consulta SQL para el ID 14 (aseguramiento de calidad)
$sql_academia_aseguramiento = "SELECT nombre_completo FROM academia_usuarios WHERE id = '$aseguramiento'";
$result_academia_aseguramiento = $conn->query($sql_academia_aseguramiento);
if ($result_academia_aseguramiento->num_rows > 0) {
    $row_academia_aseguramiento = $result_academia_aseguramiento->fetch_assoc();
    $nombre_academia_aseguramiento = $row_academia_aseguramiento['nombre_completo'];
} else {
    $nombre_academia_aseguramiento = "Nombre no encontrado"; // O un mensaje adecuado si no se encuentra el nombre.
}

// Consulta SQL para el ID 15 (jefe de academia)
$sql_academia_jefe = "SELECT nombre_completo FROM academia_usuarios WHERE id = '$jefe'";
$result_academia_jefe = $conn->query($sql_academia_jefe);
if ($result_academia_jefe->num_rows > 0) {
    $row_academia_jefe = $result_academia_jefe->fetch_assoc();
    $nombre_academia_jefe = $row_academia_jefe['nombre_completo'];
} else {
    $nombre_academia_jefe = "Nombre no encontrado"; // O un mensaje adecuado si no se encuentra el nombre.
}
//Consulta tabla solicitud_practicas
$id_solicitud_practicas = 0; // Define el ID de la solicitud de prácticas a buscar.
$sql_solicitud_practicas = "SELECT duracion_practicas, nombre_super,puesto_super,email,departamento,puesto_tentativo FROM solicitud_practicas WHERE id_solicitud = $id_solicitud_practicas";
$result_solicitud_practicas = $conn->query($sql_solicitud_practicas);
if ($result_solicitud_practicas->num_rows > 0) {
    $row_solicitud_practicas = $result_solicitud_practicas->fetch_assoc();
    $duracion_practicas = $row_solicitud_practicas['duracion_practicas'];
    $supervisor = $row_solicitud_practicas['nombre_super'];
    $puesto_supervisor = $row_solicitud_practicas['puesto_super'];
    $email = $row_solicitud_practicas['email'];
    $departamento = $row_solicitud_practicas['departamento'];
    $puesto_tentativo = $row_solicitud_practicas['puesto_tentativo'];
} else {
    echo "No se encontró ninguna solicitud de prácticas con el ID especificado.";
}

// Definir el ID de la empresa que deseas buscar
$id_empresa = 1; // Cambia este valor al ID numérico deseado

// Consulta SQL para obtener la información de la empresa según su ID
$sql_empresa_por_id = "SELECT nombre, telefono, direccion FROM Catalogo_empresas WHERE id = $id_empresa";
$result_empresa_por_id = $conn->query($sql_empresa_por_id);

// Verificar si se encontraron resultados
if ($result_empresa_por_id->num_rows > 0) {
    // Obtener los datos del primer resultado (asumiendo que el ID es único)
    $row_empresa_por_id = $result_empresa_por_id->fetch_assoc();

    // Almacenar la información en variables
    $nombre_empresa = $row_empresa_por_id['nombre'];
    $telefono_empresa = $row_empresa_por_id['telefono'];
    $direccion_empresa = $row_empresa_por_id['direccion'];

    // Aquí puedes usar la información como desees, por ejemplo, imprimir en pantalla o almacenar en variables para usar en tu documento PDF
} else {
    echo "No se encontró ninguna empresa con el ID especificado."; // O un mensaje adecuado si no se encuentra ninguna empresa con ese ID.
}

$conn->close(); // Cierra la conexión a la base de datos.

// Establecer la zona horaria a Ciudad de México
date_default_timezone_set('America/Mexico_City');
// Definir los nombres de los meses en español
$meses = [
    1 => 'enero', 2 => 'febrero', 3 => 'marzo', 4 => 'abril', 5 => 'mayo', 6 => 'junio',
    7 => 'julio', 8 => 'agosto', 9 => 'septiembre', 10 => 'octubre', 11 => 'noviembre', 12 => 'diciembre'
];

// Obtener la fecha actual en el formato deseado
$fecha_actual = date('d') . ' de ' . $meses[date('n')] . ' de ' . date('Y');


require_once('tcpdf_include.php'); // Incluye la librería TCPDF.

// Crear nuevo documento PDF en tamaño carta
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'LETTER', true, 'UTF-8', false);

// Información del documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Generated by Abimael');
$pdf->SetTitle('Solicitud para realización de Prácticas Profesionales');
$pdf->SetSubject('Solicitud de Prácticas');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// Eliminar la cabecera y pie de página predeterminados
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// Establecer márgenes
$pdf->SetMargins(10, 20, 10);

// Establecer salto de página automático
$pdf->SetAutoPageBreak(TRUE, 10);

// Factor de escala de imagen
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Establecer modo de subconfiguración de fuente predeterminado
$pdf->setFontSubsetting(true);

// Establecer fuente
$pdf->SetFont('dejavusans', '', 10, '', true);

// Añadir una página
$pdf->AddPage();

// Contenido HTML
$html = <<<EOD
<style>
    table {
        border-collapse: collapse;
    }
    td, th {
        border: 1px solid black;
        padding: 4px;
    }
    th h3, th h4 {
        border: none; /* Elimina los bordes de los encabezados h3 y h4 */
    }
    .no-border {
        border: none;
    }
    .center {
        text-align: center;
    }
    #imagen {
        border: none; /* Elimina el borde de la imagen */
    }
</style>
<table class="no-border" cellpadding="4">
    <tr>
        <td class="no-border" id="imagen"><img src="unnamed.jpg" width="200" alt="Logo Universidad Cristobal"></td> <!-- Ajusta el ancho de la imagen según tus necesidades -->
        <td class="no-border" colspan="2" class="center">
            <h3>Universidad Cristóbal Colón</h3>
            <h4>Licenciatura en Ingeniería en Sistemas Computacionales</h4>
            <h4>Solicitud para realización de Prácticas Profesionales</h4>
        </td>
        <td class="no-border" rowspan="3" style="width: 100px; text-align: center; border: 1px solid black;">
            <br><br>
            <p>Fotografía reciente tamaño infantil</p>
        </td>
    </tr>
</table>

<p style="text-align: justify; font-weight: bold;">
    Mtro. Ramón Palet Naranjo<br>
   Jefe Académico de las Licenciaturas en Ingeniería en Sistemas Computacionales, Ingeniería en <br>
    Telecomunicaciones y Sistemas Electrónicos, Ingeniería Biónica e Ingeniería Mecatrónica.<br>
    Universidad Cristóbal Colón</p>
<p>Por medio de la presente hago de su conocimiento mi deseo de realizar prácticas profesionales en la empresa que a continuación se detalla. Esto con el fin de fortalecer mi formación académica y vincularme con el medio laboral.</p>

<h4>Datos del alumno</h4>
<table>
    <tr>
        <th>1. Nombre:</th>
        <td>{$nombre}</td>
        <th>2. Matrícula:</th>
        <td>{$matricula}</td>
    </tr>
    <tr>
        <th>3. Licenciatura:</th>
        <td>{$licenciatura}</td>
        <th>4. Semestre:</th>
        <td>{$semestre}</td>
    </tr>
    <tr>
        <th>5. E-mail:</th>
        <td>{$correo}</td>
        <th>6. Sexo:</th>
        <td>{$sexo}</td>
    </tr>
</table>

<h4>Datos de la empresa</h4>
<table>
    <tr>
        <th>1. Nombre o razón social:</th>
        <td colspan="3">{$nombre_empresa}</td>
    </tr>
    <tr>
        <th>2. Domicilio:</th>
        <td colspan="3">{$direccion_empresa}</td>
    </tr>
    <tr>
        <th>3. Teléfono:</th>
        <td>{$telefono_empresa}</td>
        <th>4. E-mail:</th>
        <td>{$email}</td>
    </tr>
    <tr>
        <th>5. Duración de las prácticas:</th>
        <td colspan="3">{$duracion_practicas}</td>
    </tr>
    <tr>
        <th>6. Puesto tentativo a desempeñar:</th>
        <td>{$puesto_tentativo}</td>
        <th>7. Departamento:</th>
        <td>{$departamento}</td>
    </tr>
    <tr>
        <th>8. Nombre del supervisor directo:</th>
        <td>{$nombre}</td>
        <th>9. Puesto del supervisor directo:</th>
        <td>{$puesto_supervisor}</td>
    </tr>
</table>

<p style="text-align: justify;">
    <br>Doy fe de los datos anteriores son fidedignos y me comprometo a cumplir con los lineamientos establecidos por la empresa, así como por el reglamento general de alumnos de la Universidad Cristóbal Colón.
</p>
<p style="text-align: right;">H. Veracruz, Ver., a {$fecha_actual}</p>
<br><br>
<table><br><br><br><br>
    <tr>
        <td class="no-border center" style="width: 50%; padding-top: 20px;">
            _______________________________<br>
            {$nombre}<br>
            Alumno<br><br><br>
        </td>
        <td class="no-border center" style="width: 50%; padding-top: 20px;">
            _______________________________<br>
            {$nombre}<br>
            Supervisor
        </td>
    </tr>
    <tr>
        <td class="no-border center" style="width: 50%; padding-top: 20px;">
            _______________________________<br>
            Mtro. {$nombre_academia_jefe}<br>
            Vo. Bo. Jefe de Área Académica
        </td>
        <td class="no-border center" style="width: 50%; padding-top: 20px;">
            _______________________________<br>
            Mtra. {$nombre_academia_aseguramiento}<br>
            Vo. Bo. Aseguramiento de la Calidad
        </td>
    </tr>
</table>

EOD;

// Imprimir el contenido usando writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);



// Cerrar y generar el documento PDF
$pdf->Output('solicitud_practicas.pdf', 'I');

?>
