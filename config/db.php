<?php
define('DB_HOST', 'database-team1-daw.c30w0agw4764.us-east-2.rds.amazonaws.com');
define('DB_USER', 'admin');
define('DB_PASS', 'S1stemas_23');
define('DB_NAME', 'PP_TEAM1');

$conexion = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conexion === false) { //¿error?
    exit('Error en la conexión con la bd');
}

mysqli_set_charset($conexion, 'utf8');
?>
