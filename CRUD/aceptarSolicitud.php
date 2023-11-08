<?php
session_start(); // Iniciamos la sesión.

include_once('../herramientas/conexion.php'); // Incluimos el fichero de conexión a la base de datos.

$usuarioSesion = $_SESSION['user']; // Almacenamos en una variable la sesión con el nombre de usuario.

// Sentencia SQL para recoger el ID del usuario de la sesión.
$sql1 = "SELECT id FROM usuarios WHERE username = ?"; // Usamos marcadores de posición.

// Preparamos la consulta.
$stmt1 = mysqli_prepare($conn, $sql1);

// Vinculamos el marcador de posición con el valor de $usuarioSesion.
mysqli_stmt_bind_param($stmt1, "s", $usuarioSesion);

// Ejecutamos la consulta preparada.
mysqli_stmt_execute($stmt1);

// Obtenemos el resultado de la consulta.
$resultadosql1 = mysqli_stmt_get_result($stmt1);

// Comprobamos si se han encontrado resultados en la consulta.
if (mysqli_num_rows($resultadosql1) > 0) {
    $usuariosSolicitudes = $_POST['soli']; // Guardamos en una variable el usuario de la solicitud. Realmente se trata de un array.

    // Recorremos el array de usuarios solicitados.
    foreach ($usuariosSolicitudes as $usuariosSolicitud) {
        // Sentencia SQL para recoger el ID de los usuarios del array.
        $sql2 = "SELECT id FROM usuarios WHERE username = ?"; // Usamos marcadores de posición.

        // Preparamos la consulta.
        $stmt2 = mysqli_prepare($conn, $sql2);

        // Vinculamos el marcador de posición con el valor de $usuariosSolicitud.
        mysqli_stmt_bind_param($stmt2, "s", $usuariosSolicitud);

        // Ejecutamos la consulta preparada.
        mysqli_stmt_execute($stmt2);

        // Obtenemos el resultado de la consulta.
        $resultadosql2 = mysqli_stmt_get_result($stmt2);

        // Comprobamos si se han encontrado resultados en la consulta.
        if (mysqli_num_rows($resultadosql2) > 0) {
            // Obtenemos los IDs de los usuarios.
            $row1 = mysqli_fetch_assoc($resultadosql1);
            $row2 = mysqli_fetch_assoc($resultadosql2);
            $usuarioID1 = $row1['id'];
            $usuarioID2 = $row2['id'];

            // Comprobamos si ya son amigos consultando la tabla de amistades.
            $sql5 = "SELECT * FROM amistades WHERE (usuario_1 = ? AND usuario_2 = ?) OR (usuario_1 = ? AND usuario_2 = ?)"; // Usamos marcadores de posición.

            // Preparamos la consulta.
            $stmt5 = mysqli_prepare($conn, $sql5);

            // Vinculamos los marcadores de posición con los valores de los IDs.
            mysqli_stmt_bind_param($stmt5, "iiii", $usuarioID1, $usuarioID2, $usuarioID2, $usuarioID1);

            // Ejecutamos la consulta preparada.
            mysqli_stmt_execute($stmt5);

            // Obtenemos el resultado de la consulta.
            $resultadosql5 = mysqli_stmt_get_result($stmt5);

            // Comprobamos si se han encontrado resultados en la consulta de amistades.
            if (mysqli_num_rows($resultadosql5) > 0) {
                header('Location: ../view/exito.php?YaSonAmigos'); // Redirige y muestra el mensaje de error.
                exit();
            } else {
                // Si no son amigos, insertamos una nueva amistad.
                $sql3 = "INSERT INTO amistades (id, usuario_1, usuario_2) VALUES (NULL, ?, ?)"; // Usamos marcadores de posición.

                // Preparamos la consulta.
                $stmt3 = mysqli_prepare($conn, $sql3);

                // Vinculamos los marcadores de posición con los valores de los IDs.
                mysqli_stmt_bind_param($stmt3, "ii", $usuarioID1, $usuarioID2);

                // Ejecutamos la consulta preparada.
                mysqli_stmt_execute($stmt3);

                // Eliminamos la solicitud de amistad correspondiente.
                $sql4 = "DELETE FROM solicitudes WHERE emisor = ? AND receptor = ?"; // Usamos marcadores de posición.

                // Preparamos la consulta.
                $stmt4 = mysqli_prepare($conn, $sql4);

                // Vinculamos los marcadores de posición con los valores de los IDs.
                mysqli_stmt_bind_param($stmt4, "ii", $usuarioID2, $usuarioID1);

                // Ejecutamos la consulta preparada.
                mysqli_stmt_execute($stmt4);

                header('Location: ../view/exito.php?Sehaañadidolaamistadysehaeliminadolasolicitud');
            }
        } else {
            header('Location: ../view/exito.php?NoSeHaEncontradoElIDDelPost'); // Redirige y muestra el mensaje de error.
            exit();
        }
    }
} else {
    header('Location: ../view/exito.php?IDde' . $usuarioSesion . 'NoEncontrado'); // Redirige y muestra el mensaje de error.
    exit();
}
?>
