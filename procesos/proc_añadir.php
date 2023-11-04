<?php
session_start();
$userSesion = $_SESSION['user'];
$user = $_POST['user'];
$email = $_POST['email'];

include_once('../herramientas/conexion.php');

// Comprobar si existe un registro que coincida en ambos username y email
$consultaVerificarExistencia = "SELECT COUNT(*) as total FROM usuarios WHERE email = ? AND username = ?";
$stmtVerificarExistencia = mysqli_prepare($conn, $consultaVerificarExistencia);
mysqli_stmt_bind_param($stmtVerificarExistencia, "ss", $email, $user);
mysqli_stmt_execute($stmtVerificarExistencia);
mysqli_stmt_bind_result($stmtVerificarExistencia, $totalExistencia);
mysqli_stmt_fetch($stmtVerificarExistencia);
mysqli_stmt_close($stmtVerificarExistencia);

if ($totalExistencia > 0) {
    // Obtener el ID del emisor y receptor
    $seleccionarIDEmisor = "SELECT id FROM usuarios WHERE username = ?";
    $stmtEmisor = mysqli_prepare($conn, $seleccionarIDEmisor);
    mysqli_stmt_bind_param($stmtEmisor, "s", $userSesion);
    mysqli_stmt_execute($stmtEmisor);
    mysqli_stmt_bind_result($stmtEmisor, $idEmisor);
    mysqli_stmt_fetch($stmtEmisor);
    mysqli_stmt_close($stmtEmisor);

    $seleccionarIDReceptor = "SELECT id FROM usuarios WHERE username = ? AND email = ?";
    $stmtReceptor = mysqli_prepare($conn, $seleccionarIDReceptor);
    mysqli_stmt_bind_param($stmtReceptor, "ss", $user, $email);
    mysqli_stmt_execute($stmtReceptor);
    mysqli_stmt_bind_result($stmtReceptor, $idReceptor);
    mysqli_stmt_fetch($stmtReceptor);
    mysqli_stmt_close($stmtReceptor);

    // Consulta SQL para insertar una solicitud en la tabla "Solicitudes"
    $sqlInsertarSolicitud = "INSERT INTO Solicitudes (id, emisor, receptor) VALUES (NULL, ?, ?)";
    $stmtInsertarSolicitud = mysqli_prepare($conn, $sqlInsertarSolicitud);
    
    if ($stmtInsertarSolicitud) {
        // Vincula los valores a los marcadores de posición en la consulta
        mysqli_stmt_bind_param($stmtInsertarSolicitud, "ii", $idEmisor, $idReceptor);

        // Ejecuta la consulta
        if (mysqli_stmt_execute($stmtInsertarSolicitud)) {
            echo "Solicitud de amistad insertada correctamente.";
        } else {
            echo "Error al ejecutar la consulta: " . mysqli_error($conn);
        }

        // Cierra la declaración preparada
        mysqli_stmt_close($stmtInsertarSolicitud);
    } else {
        echo "Error en la preparación de la consulta: " . mysqli_error($conn);
    }

    // Cierra la conexión a la base de datos
    mysqli_close($conn);
} else {
    header('Location: ../../CRUD/añadir.php?error=userInvalido');
}
?>
