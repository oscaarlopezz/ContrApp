<?php
include_once('../herramientas/conexion.php');
$id_user2 = $_POST['id_user'];
$receptor2 = $_POST['receptor'];
$mensaje = $_POST['mensaje'];
$id_user = intval($id_user2);
$receptor = intval($receptor2);
// $id_user = 1;
// $receptor = 2;
// $mensaje = "Hola me llamo Oscar";
echo "<script>console.log(" . $id_user . " " . $receptor . " " . $mensaje . ");</script>";
// echo " . $id_user . $receptor . " " . $mensaje . ";

$sql = "INSERT INTO `mensajes` (`id`, `emisor`, `receptor`, `mensaje`, `fecha_envio`) VALUES (NULL, ?, ?, ?, current_timestamp());";
// Preparar la sentencia
$stmt = mysqli_prepare($conn, $sql);

// Vincular los parámetros a la sentencia
mysqli_stmt_bind_param($stmt, "iis", $id_user, $receptor, $mensaje);

// Ejecutar la sentencia
mysqli_stmt_execute($stmt);

// Obtener el resultado
$resultado = mysqli_stmt_get_result($stmt);