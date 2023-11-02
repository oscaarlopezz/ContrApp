<?php
    session_start();
    include_once('../herramientas/conexion.php');

    // Comprobar si el correo electrónico ya existe en la base de datos
    $consultaVerificarExistenciaCorreo = "SELECT COUNT(*) as total FROM usuarios WHERE email = ?";
    $stmtVerificarExistenciaCorreo = mysqli_prepare($conn, $consultaVerificarExistenciaCorreo);
    mysqli_stmt_bind_param($stmtVerificarExistenciaCorreo, "s", $_SESSION['email']);
    mysqli_stmt_execute($stmtVerificarExistenciaCorreo);
    mysqli_stmt_bind_result($stmtVerificarExistenciaCorreo, $totalCorreo);
    mysqli_stmt_fetch($stmtVerificarExistenciaCorreo);
    mysqli_stmt_close($stmtVerificarExistenciaCorreo);

    if ($totalCorreo > 0) 
    {
        // El correo electrónico ya exist, mostrar un mensaje de error.
        header('Location: ../view/register.php?error=El correo electrónico ya está registrado');
        exit();
    } 

    // Comprobar si el usuario ya existe en la base de datos
    $consultaVerificarExistenciaUser = "SELECT COUNT(*) as total FROM usuarios WHERE username = ?";
    $stmtVerificarExistenciaUser = mysqli_prepare($conn, $consultaVerificarExistenciaUser);
    mysqli_stmt_bind_param($stmtVerificarExistenciaUser, "s", $_SESSION['user']);
    mysqli_stmt_execute($stmtVerificarExistenciaUser);
    mysqli_stmt_bind_result($stmtVerificarExistenciaUser, $totalUser);
    mysqli_stmt_fetch($stmtVerificarExistenciaUser);
    mysqli_stmt_close($stmtVerificarExistenciaUser);

    if ($totalUser > 0) 
    {
        // El nombre de usuario ya existe, mostrar un mensaje de error.
        header('Location: ../view/register.php?error=El nombre de usuario ya está registrado');
        exit();
    } 
     
    else 
    {
        // Si no existen, procede a insertar los datos en la base de datos
        $consultaInsertarUser = "INSERT INTO usuarios (username, email, contraseña) VALUES (?, ?, ?)";
        $stmtInsertarUser = mysqli_prepare($conn, $consultaInsertarUser);

        if ($stmtInsertarUser) 
        {
            $passEncriptada = hash("sha256", $_SESSION['pass']);
            mysqli_stmt_bind_param($stmtInsertarUser, "sss", $_SESSION['user'], $_SESSION['email'], $passEncriptada);
            mysqli_stmt_execute($stmtInsertarUser);
            mysqli_stmt_close($stmtInsertarUser);
            mysqli_close($conn);

            // Redirecciona a una página de éxito o a donde desees una vez que el usuario se haya registrado.
            header('Location: ../view/exito.php');
            exit();
        } 
        
        else {
            // Si hubo un error en la preparación de la consulta SQL, puedes manejarlo de la siguiente manera.
            header('Location: ../view/register.php?error=Error en la preparación de la consulta SQL');
            exit();
        }
    }
?>
