<?php
require_once '../../../config/global.php';
require_once '../../../config/db.php';

define('RUTA_INCLUDE', '../../../'); // ajustar a necesidad

// Conexión a la base de datos
$conn = new mysqli("database-team1-daw.c30w0agw4764.us-east-2.rds.amazonaws.com", "admin", "S1stemas_23", "PP_TEAM1");
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos de la tabla usuarios_alumno
$matricula = '202160172'; // Ajusta según sea necesario
$sql = "SELECT nombre, matricula, semestre, licenciatura FROM usuarios_alumno WHERE matricula = '$matricula'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Obtener los datos del primer resultado
    $row = $result->fetch_assoc();
    $nombre = $row['nombre'];
    $matricula = $row['matricula'];
    $semestre = $row['semestre'];
} else {
    die("No se encontraron datos del alumno.");
}

$conn->close();
// Establecer la zona horaria a Ciudad de México
date_default_timezone_set('America/Mexico_City');
// Definir los nombres de los meses en español
$meses = [
    1 => 'enero', 2 => 'febrero', 3 => 'marzo', 4 => 'abril', 5 => 'mayo', 6 => 'junio',
    7 => 'julio', 8 => 'agosto', 9 => 'septiembre', 10 => 'octubre', 11 => 'noviembre', 12 => 'diciembre'
];

// Obtener la fecha actual en el formato deseado
$fecha_actual = date('d') . ' de ' . $meses[date('n')] . ' de ' . date('Y');


require_once('tcpdf_include.php');

// Extender TCPDF para agregar un pie de página personalizado
class MYPDF extends TCPDF {
    // Pie de página
    public function Footer() {
        // Posición del pie de página a 15 mm del final
        $this->SetY(-15);
        // Fuente
        $this->SetFont('dejavusans', '', 8);
        // Información del pie de página
        $html = '<table style="width: 100%; font-size: 8px; color: #808080;">
            <tr>
                <td style="width: 70%; text-align: right;">
                    LICENCIATURAS EN INGENIERÍA EN SISTEMAS COMPUTACIONALES,<br>
                    INGENIERÍA EN TELECOMUNICACIONES Y SISTEMAS ELECTRÓNICOS,<br>
                    INGENIERÍA BIÓNICA E INGENIERÍA MECATRÓNICA
                </td>
                <td style="width: 2%; border-right: 1px solid #000000;">&nbsp;</td>
                <td style="width: 28%; text-align: right;">
                    Tel. (229) 923 29 50 ext. 5327<br>
                    <a href="mailto:rpaletn@ucc.mx" style="color: #0000EE;">rpaletn@ucc.mx</a>
                </td>
            </tr>
        </table>';
        // Imprimir el HTML
        $this->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
    }
}

// Crear nuevo documento PDF en tamaño carta
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'LETTER', true, 'UTF-8', false);

// Información del documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Generated by Abimael');
$pdf->SetTitle('Carta de Presentacion');
$pdf->SetSubject('Carta de Presentacion');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// Eliminar la cabecera y pie de página predeterminados
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(true);

// Establecer márgenes
$pdf->SetMargins(15, 20, 15); // Ajustar los márgenes

// Establecer salto de página automático
$pdf->SetAutoPageBreak(TRUE, 30); // Ajustar el margen inferior para que no se sobreponga con el pie de página

// Factor de escala de imagen
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Establecer modo de subconfiguración de fuente predeterminado
$pdf->setFontSubsetting(true);

// Establecer fuente
$pdf->SetFont('dejavusans', '', 10, '', true);

// Añadir una página
$pdf->AddPage();

$html = <<<EOD
<style>
    .title {
        text-align: right;
    }
    .content {
        text-align: justify;
    }
    .signature {
        text-align: center;
    }
</style>
<p class="title">{$fecha_actual}</p>
<p style="text-align: justify" ><b>
       LIC. GUILLERMO GÓMEZ FERNÁNDEZ<br>
       DEPARTAMENTO DE TIC<br>
       COMPAÑÍA DE AGUA DEL MUNICIPIO DE BOCA DEL RÍO SAPI DE CV<br>
       PRESENTE</p></b>
<p class="content" >
    <br>Por este medio solicito de la manera más atenta su autorización para que el C. <b>{$nombre}</b>,
    estudiante cursando el <b>{$semestre}</b> semestre de la carrera de la Licenciatura en Ingeniería en Sistemas Computacionales con
    matrícula <b>{$matricula}</b>, pueda realizar en la dependencia a su digno cargo sus prácticas profesionales, debiendo reunir
    un total de 240 horas, durante un periodo no menor a 3 meses.
</p>
<p class="content">
    Agradeciendo su gentil atención, reciba un cordial saludo.<br><br><br><br>
</p>
<br><br>
<p class="signature"><b>ATENTAMENTE<br><br><br><br><br><br><br></b>
    _____________________________________<br>
    Mtro. Ramón Palet Naranjo<br>
    Jefe de Área</p>
EOD;

// Imprimir texto usando writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// Cerrar y generar el documento PDF
$pdf->Output('Reporte_Global.pdf', 'I');
?>