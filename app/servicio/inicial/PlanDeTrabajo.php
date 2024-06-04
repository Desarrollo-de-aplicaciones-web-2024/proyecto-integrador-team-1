<?php
// Se incluyen los archivos de configuración global y de la base de datos
require_once '../../../config/global.php';
require_once '../../../config/db.php';

define('RUTA_INCLUDE', '../../../'); // Definir la ruta de inclusión, ajusta según sea necesario

// Conexión a la base de datos
$conn = new mysqli("database-team1-daw.c30w0agw4764.us-east-2.rds.amazonaws.com", "admin", "S1stemas_23", "PP_TEAM1");
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error); // Mostrar error si falla la conexión
}

// Obtener datos de la tabla usuarios_alumno
$matricula = '202160171'; // Ajustar según sea necesario
$sql = "SELECT nombre, matricula, semestre, licenciatura FROM usuarios_alumno WHERE matricula = '$matricula'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Obtener los datos del primer resultado
    $row = $result->fetch_assoc();
    $nombre = $row['nombre'];
    $matricula = $row['matricula'];
    $semestre = $row['semestre'];
    $licenciatura = $row['licenciatura'];
} else {
    die("No se encontraron datos del alumno."); // Mostrar error si no se encuentran datos
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
// Definir el ID de la empresa que deseas buscar
$id_empresa = 1; // Cambia este valor al ID numérico deseado

// Consulta SQL para obtener la información de la empresa según su ID
$sql_empresa_por_id = "SELECT nombre FROM Catalogo_empresas WHERE id = $id_empresa";
$result_empresa_por_id = $conn->query($sql_empresa_por_id);

// Verificar si se encontraron resultados
if ($result_empresa_por_id->num_rows > 0) {
    // Obtener los datos del primer resultado (asumiendo que el ID es único)
    $row_empresa_por_id = $result_empresa_por_id->fetch_assoc();

    // Almacenar la información en variables
    $nombre_empresa = $row_empresa_por_id['nombre'];

    // Aquí puedes usar la información como desees, por ejemplo, imprimir en pantalla o almacenar en variables para usar en tu documento PDF
} else {
    echo "No se encontró ninguna empresa con el ID especificado."; // O un mensaje adecuado si no se encuentra ninguna empresa con ese ID.
}

// Obtener datos de la tabla plan_trabajo
$id_plan_trabajo = 1; // Define el ID del plan de trabajo a buscar.
$sql_plan_trabajo = "SELECT fecha_inicio, horario, descripcion FROM plan_trabajo WHERE id_plan_trabajo = $id_plan_trabajo";
$result_plan_trabajo = $conn->query($sql_plan_trabajo);
if ($result_plan_trabajo->num_rows > 0) {
    $row_plan_trabajo = $result_plan_trabajo->fetch_assoc();
    $fecha_inicio = $row_plan_trabajo['fecha_inicio'];
    $horario = $row_plan_trabajo['horario'];
    $descripcion = $row_plan_trabajo['descripcion'];
} else {
    echo "No se encontró ningún plan de trabajo con el ID especificado.";
}

// Obtener datos de la tabla solicitud_practicas
$id_solicitud_practicas = 2; // Define el ID de la solicitud de prácticas a buscar.
$sql_solicitud_practicas = "SELECT duracion_practicas, nombre_super FROM solicitud_practicas WHERE id_solicitud = $id_solicitud_practicas";
$result_solicitud_practicas = $conn->query($sql_solicitud_practicas);
if ($result_solicitud_practicas->num_rows > 0) {
    $row_solicitud_practicas = $result_solicitud_practicas->fetch_assoc();
    $duracion_practicas = $row_solicitud_practicas['duracion_practicas'];
    $supervisor = $row_solicitud_practicas['nombre_super'];
} else {
    echo "No se encontró ninguna solicitud de prácticas con el ID especificado.";
}

$conn->close(); // Cerrar la conexión a la base de datos

// Establecer la zona horaria a Ciudad de México
date_default_timezone_set('America/Mexico_City');
// Definir los nombres de los meses en español
$meses = [
    1 => 'enero', 2 => 'febrero', 3 => 'marzo', 4 => 'abril', 5 => 'mayo', 6 => 'junio',
    7 => 'julio', 8 => 'agosto', 9 => 'septiembre', 10 => 'octubre', 11 => 'noviembre', 12 => 'diciembre'
];

// Obtener la fecha actual en el formato deseado
$fecha_actual = date('d') . ' de ' . $meses[date('n')] . ' de ' . date('Y');

require_once('tcpdf_include.php'); // Incluir la biblioteca TCPDF

// Crear nuevo documento PDF en tamaño carta
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'LETTER', true, 'UTF-8', false);

// Información del documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Generated by Abimael');
$pdf->SetTitle('Plan de Trabajo de Prácticas Profesionales');
$pdf->SetSubject('Plan de Trabajo');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// Eliminar la cabecera y pie de página predeterminados
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// Establecer márgenes
$pdf->SetMargins(15, 20, 15); // Ajustar los márgenes (izquierda, arriba, derecha)

// Establecer salto de página automático
$pdf->SetAutoPageBreak(TRUE, 30); // Ajustar el margen inferior para el salto de página

// Factor de escala de imagen
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Establecer modo de subconfiguración de fuente predeterminado
$pdf->setFontSubsetting(true);

// Establecer fuente
$pdf->SetFont('dejavusans', '', 10, '', true);

// Añadir una página
$pdf->AddPage();

// Definir el contenido HTML con estilo CSS
$html = <<<EOD
<style>
    .title {
        text-align: right;
        font-weight: bold;
        margin-bottom: 5px;
    }
    .subtitle {
        text-align: right;
        font-weight: bold;
        margin-bottom: 5px;
    }
    .content {
        text-align: justify;
        margin-bottom: 5px;
    }
    .signature {
        text-align: center;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 5px;
    }
    th, td {
        border: 1px solid black;
        padding: 5px;
        margin-bottom: 5px;
    }
    .no-border {
        border: none;
    }
    .header-cell {
        background-color: #9b9b9b;
        color: white;
        font-weight: bold;
    }
</style>
<table>
    <tr>
        <td class="no-border">
            <div style="margin-top: 10px;"><img src="unnamed.jpg" width="200" alt="Logo Universidad Cristobal"></div>
        </td>
        
    </tr>
    <tr>
        <td class="no-border title" colspan="2" >Universidad Cristóbal Colón</td>
    </tr>
    
    <tr>
        <td class="no-border subtitle" colspan="2">Licenciatura en Ingeniería en Sistemas Computacionales</td>
    </tr>
    <tr>
        <td class="no-border subtitle" colspan="2">Plan de Trabajo de Prácticas Profesionales</td>
    </tr>
</table>



<table>
    <tr>
        <td class="header-cell">1. Nombre del alumno:</td>
        <td>{$nombre}</td>
        <td class="header-cell">2. Matrícula:</td>
        <td>{$matricula}</td>
    </tr>
    <tr>
        <td class="header-cell">3. Licenciatura:</td>
        <td>{$licenciatura}</td>
        <td class="header-cell">4. Semestre:</td>
        <td>{$semestre}</td>
    </tr>
    <tr>
        <td class="header-cell">5. Nombre de la empresa:</td>
        <td colspan="3">{$nombre_empresa}</td>
    </tr>
    <tr>
        <td class="header-cell">6. Fecha de inicio de las prácticas:</td>
        <td colspan="3">{$fecha_inicio}</td>
    </tr>
    <tr>
        <td class="header-cell">7. Duración en horas (estimadas):</td>
        <td colspan="3">{$duracion_practicas}</td>
    </tr>
    <tr>
        <td class="header-cell">8. Horario:</td>
        <td colspan="3">{$horario}</td>
    </tr>
    <tr>
        <td class="header-cell">10. Descripción general de las actividades a realizar:</td>
               <td colspan="3">{$descripcion}</td>
    </tr>
</table>

<p class="content">H. Veracruz, Ver., a {$fecha_actual}</p>

<br><br>

<table>
    <tr>
        <br><br><br><td class="no-border signature">___________________________________<br>$nombre<br>Alumno</td>
        <td class="no-border signature">_____________________________________<br>{$supervisor}<br>Supervisor</td>
    </tr>
    <tr>
        <br><br><br><br><td class="no-border signature">_____________________________________<br>Mtro.{$nombre_academia_jefe}<br>Vo. Bo. Jefe de Área Académica</td>
        <td class="no-border signature">_____________________________________<br>Mtra.{$nombre_academia_aseguramiento}<br>Vo. Bo. Aseguramiento de la Calidad</td>
    </tr>
</table>
EOD;

// Imprimir texto usando writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// Cerrar y generar el documento PDF
$pdf->Output('plan_trabajo_practicas.pdf', 'I');
?>
