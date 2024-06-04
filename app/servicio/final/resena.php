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

$id = '1'; // Ajustar según sea necesario

// Consulta SQL para obtener los datos de la empresa y el nombre del sector
$sql = "
    SELECT 
        s.nombre AS nombreSector 
    FROM 
        Catalogo_empresas e 
    INNER JOIN 
        sectores s 
    ON 
        e.sector_id = s.id 
    WHERE 
        e.id = '$id'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Obtener los datos del primer resultado
    $row = $result->fetch_assoc();
    $nombreSector = $row['nombreSector'];
} else {
    die("No se encontraron datos de la empresa."); // Mostrar error si no se encuentran datos
}

// Obtener datos de la tabla usuarios_alumno
$matricula = '202160177'; // Ajustar según sea necesario
$sql = "SELECT licenciatura,semestre FROM usuarios_alumno WHERE matricula = '$matricula'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Obtener los datos del primer resultado
    $row = $result->fetch_assoc();
    $licenciatura = $row['licenciatura'];
    $semestre = $row['semestre'];
} else {
    die("No se encontraron datos del alumno."); // Mostrar error si no se encuentran datos
}




$conn->close(); // Cerrar la conexión a la base de datos

// Crear nuevo documento PDF en tamaño carta
$pdf = new TCPDF('P', PDF_UNIT, 'LETTER', true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Universidad Cristóbal Colón');
$pdf->SetTitle('Descripción de Actividades Realizadas');
$pdf->SetSubject('Prácticas en empresa del sector petrolero, logístico y energía');
$pdf->SetKeywords('prácticas, empresa, sector petrolero, logístico, energía');

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
.container {
  width: 100%;
  text-align: center;
}
.header, .footer {
  width: 100%;
  text-align: center;
  margin-bottom: 20px;
}
.header img {
  width: 300px;
  
  height: auto;
}
.content {
  width: 100%;
  text-align: left;
}
.section {
  margin-bottom: 15px;
}
.bold {
  font-weight: bold;
}
.border {
  border: 1px solid black;
  padding: 5px;
}
.signature {
  width: 30%;
  height: 100px;
  border: 1px solid black;
  display: inline-block;
}
</style>
</head>
<body>
  <div class="container">
    <div class="header">
      <img src="img/OIP.jpeg" alt="Universidad Cristóbal Colón">
    </div>
    <div class="content">
      <div class="section">
        <span class="bold">$licenciatura</span>
        <br>
        $semestre º semestre
      </div>
      <div class="section">
        <span class="bold">Giro de la empresa:</span>
        <br>
        $nombreSector
      </div>
      <div class="section">
        <span class="bold">Periodo:</span>
        <br>
        Del __________ al __________
      </div>
      <div class="section border">
        <span class="bold">Descripción de Actividades Realizadas:</span>
        <ul>
          <li>....</li>
        </ul>
      </div>
      <div class="section">
        En mi opinión el haber realizado prácticas en la empresa fue:
      </div>
    </div>
    </div>
  </div>
</body>
</html>
EOD;

// Imprimir texto usando writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html,  0, 1, 0, true, '', true);

// Cerrar y generar el documento PDF
$pdf->Output('resena.pdf', 'I');
