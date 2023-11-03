<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$dbserver= "localhost";
$dbusername="root";
$dbpassword="";
$dbbasedatos="db_contrapp";

try{
    $conn = @mysqli_connect($dbserver, $dbusername, $dbpassword, $dbbasedatos);
    echo "<script>console.log('Conexion a server correcta') </script>";


} catch (Exception $e){
    echo "Error en la conexión con la base de datos: " . $e->getMessage();
    echo "<script>console.log('Conexion a server fallida') </script>";
    die();
}


