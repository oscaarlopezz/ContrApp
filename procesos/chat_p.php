<?php
include_once('../herramientas/conexion.php');

// Recuperar los datos enviados a través de POST
$id_user2 = $_POST['user'];
$receptor2 = $_POST['amigo'];
$id_user = intval($id_user2);
$receptor = intval($receptor2);

// echo gettype($id_user); // Esto mostrará "integer" osea el tipo de datos que en este caso es numeral

// echo gettype($receptor); // Esto mostrará "integer"


// Consulta SQL con sentencia preparada
$sql = "SELECT DISTINCT emisor_usuario.username AS emisor, m.emisor as id_emisor, receptor_usuario.username AS receptor, m.mensaje, m.fecha_envio
        FROM mensajes AS m
        INNER JOIN usuarios AS emisor_usuario ON m.emisor = emisor_usuario.id
        INNER JOIN usuarios AS receptor_usuario ON m.receptor = receptor_usuario.id
        WHERE (m.emisor = ? AND m.receptor = ?) OR (m.emisor = ? AND m.receptor = ?)
        ORDER BY m.fecha_envio DESC";

// Preparar la sentencia
$stmt = mysqli_prepare($conn, $sql);

// Vincular los parámetros a la sentencia
mysqli_stmt_bind_param($stmt, "iiii", $id_user, $receptor, $receptor, $id_user);

// Ejecutar la sentencia
mysqli_stmt_execute($stmt);

// Obtener el resultado
$resultado = mysqli_stmt_get_result($stmt);


if (mysqli_num_rows($resultado) > 0) {
    while ($row = mysqli_fetch_assoc($resultado)) {
        $id_emisor = intval($row['id_emisor']);
        if ($id_emisor === $id_user) {
            $float = "right";
        } else{
            $float = "left";
        }
        echo '<div class="mensaje" style="text-align: ' . $float . '; width: 100%">';
        echo '<h6>' . $row['emisor'] . '</h6>';
        echo '<label for="mensaje">' . $row['mensaje'] . '</label>';
        echo '<p>' . $row['fecha_envio'] . '</p>';
        echo '</div>';
    }
} else {
    echo "No hay mensajes.";
}

// Cerrar la sentencia y la conexión
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
