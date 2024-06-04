<?php
// Se incluyen los archivos de configuración global y de la base de datos
require_once '../../../config/global.php';
require_once '../../../config/db.php';

define('RUTA_INCLUDE', '../../../'); // Definir la ruta de inclusión, ajusta según sea necesario

require_once('TCPDF/config/tcpdf_config.php');
require_once('tcpdf_include.php'); // Incluye la librería TCPDF.
// Conexión a la base de datos
$conn = new mysqli("database-team1-daw.c30w0agw4764.us-east-2.rds.amazonaws.com", "admin", "S1stemas_23", "PP_TEAM1");
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error); // Mostrar error si falla la conexión
}

// Obtener datos de la tabla solicitud practicas
$id = '1'; // Ajustar según sea necesario
$sql = "SELECT nombre, direccion FROM Catalogo_empresas WHERE id = '$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Obtener los datos del primer resultado
    $row = $result->fetch_assoc();
    $nombreEmpresa = $row['nombre'];
    $direccionEmpresa = $row['direccion'];
} else {
    die("No se encontraron datos de la empresa."); // Mostrar error si no se encuentran datos
}

// Obtener datos de la tabla usuarios_alumno
$matricula = '202160177'; // Ajustar según sea necesario
$sql = "SELECT nombre,semestre FROM usuarios_alumno WHERE matricula = '$matricula'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Obtener los datos del primer resultado
    $row = $result->fetch_assoc();
    $nombre = $row['nombre'];
    $semestre = $row['semestre'];
} else {
    die("No se encontraron datos del alumno."); // Mostrar error si no se encuentran datos
}


// Crear nuevo documento PDF en tamaño carta
$pdf = new TCPDF('P', PDF_UNIT, 'LETTER', true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Universidad Cristóbal Colón');
$pdf->SetTitle('Constancia de finalización de Prácticas Profesionales');
$pdf->SetSubject('Constancia');
$pdf->SetKeywords('constancia, prácticas, profesionales');

// Establecer márgenes
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Agregar página
$pdf->AddPage();

// Contenido HTML
$html = <<<EOD
<!DOCTYPE html>
<html>
<head>
<style>
body {
  font-family: sans-serif;
}
.header {
  text-align: center;
  margin-bottom: 20px;
}
.header img {
  width: 100px;
  height: auto;
}
.header .title {
  font-size: 14px;
  font-weight: bold;
}
.content {
  font-size: 12px;
  text-align: justify;
  margin-top: 20px;
}
.footer {
  margin-top: 50px;
  text-align: center;
}
.signature {
  width: 40%;
  display: inline-block;
  text-align: center;
  margin-top: 50px;
}
</style>
</head>
<body>
  <div class="header">
    <img src="img/OIP.jpeg" alt="Universidad Cristóbal Colón">
    <div class="title">
      Universidad Cristóbal Colón <br>
      Licenciatura en Ingeniería en Sistemas Computacionales <br>
      Constancia de finalización de Prácticas Profesionales
    </div>
    <div class="date" style="text-align: right;">Fecha</div>
  </div>
  <div class="content">
    <p>A QUIEN CORRESPONDA</p>
    <p>
      Por medio de la presente, los que al calce firman, dan fe que el alumno <strong>$nombre</strong>  , inscrito actualmente en el 
      <strong>$semestre</strong> semestre de la Licenciatura en Ingeniería en Sistemas Computacionales 
      de la Universidad Cristóbal Colón bajo la matrícula <strong>$matricula</strong>, concluyó 
      satisfactoriamente su periodo de prácticas profesionales en la empresa <strong>____________________</strong> 
      <strong>$nombreEmpresa</strong>, ubicada en la ciudad de <strong>_______________</strong> 
      <strong>veracruz</strong>, estado de <strong>veracruz</strong> 
      , con domicilio en <strong>$direccionEmpresa</strong> 
      cubriendo un total de <strong>____________</strong> horas.
    </p>
  </div>
  <div class="footer">
    <div class="signature">
      ____________________________________<br>
      Mtro. Ramón Palet Naranjo <br>
      Jefe de Área Académica
    </div>
    <div class="signature">
      ____________________________________<br>
      Mtra. María del Carmen Aguirre Torres <br>
      Aseguramiento de la Calidad Académica
    </div>
  </div>
</body>
</html>
EOD;

// Imprimir texto usando writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html,  0, 1, 0, true, '', true);

// Cerrar y generar el documento PDF
$pdf->Output('constancia_practicas.pdf', 'I');
