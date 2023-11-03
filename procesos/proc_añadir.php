<?php 
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
        echo "El usuario existe";
    } 

    else 
    {
        header('Location: ../../CRUD/añadir.php?error=userInvalido');
    }
?>
