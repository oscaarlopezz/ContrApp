<?php
include_once('../herramientas/conexion.php');

// Recuperar los datos enviados a través de POST
$id_user2 = $_POST['id_user'];
$receptor2 = $_POST['amigo'];
$id_user = intval($id_user2);
$receptor = intval($receptor2);

$sql_select = "SELECT usuario_1 FROM amistades WHERE usuario_1 = ? AND usuario_2 = ?";
$stmt_select = mysqli_prepare($conn, $sql_select);

// Vincular los parámetros a la sentencia SELECT
mysqli_stmt_bind_param($stmt_select, "ii", $id_user, $receptor);

// Ejecutar la sentencia SELECT
mysqli_stmt_execute($stmt_select);

// Obtener el resultado
mysqli_stmt_store_result($stmt_select);

// Verificar si se encontraron registros
if (mysqli_stmt_num_rows($stmt_select) > 0) {
    // Si se encontraron registros, ejecutar la sentencia DELETE original
    $sql_delete = "DELETE FROM amistades WHERE usuario_1 = ? AND usuario_2 = ?";
    $stmt_delete = mysqli_prepare($conn, $sql_delete);

    // Vincular los parámetros a la sentencia DELETE original
    mysqli_stmt_bind_param($stmt_delete, "ii", $id_user, $receptor);
    
    // Ejecutar la sentencia DELETE
    if (mysqli_stmt_execute($stmt_delete)) {
    header('Location: ../view/exito.php?elimacionOK');    
    } else {
        header('Location: ../view/exito.php?elimacionMal');    
    }
} else {
    // Si no se encontraron registros con la primera combinación, usar la segunda combinación
    $sql_delete = "DELETE FROM amistades WHERE usuario_1 = ? AND usuario_2 = ?";
    $stmt_delete = mysqli_prepare($conn, $sql_delete);

    // Vincular los parámetros a la sentencia DELETE alternativa
    mysqli_stmt_bind_param($stmt_delete, "ii", $receptor, $id_user);
    
    // Ejecutar la sentencia DELETE alternativa
    if (mysqli_stmt_execute($stmt_delete)) {
        header('Location: ../view/exito.php?elimacionOK');    
    } else {
        header('Location: ../view/exito.php?elimacionMal');    
    }
}
