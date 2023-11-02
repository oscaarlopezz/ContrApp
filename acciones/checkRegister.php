<?php
    session_start();
    include_once('../herramientas/conexion.php');

    // Comprobar si el usuario y el correo electrónico ya existen en la base de datos
    $consultaVerificarExistencia = "SELECT COUNT(*) as total FROM usuarios WHERE email = ?";
    $stmtVerificarExistencia = mysqli_prepare($conn, $consultaVerificarExistencia);
    mysqli_stmt_bind_param($stmtVerificarExistencia, "s", $_SESSION['email']);
    mysqli_stmt_execute($stmtVerificarExistencia);
    mysqli_stmt_bind_result($stmtVerificarExistencia, $total);
    mysqli_stmt_fetch($stmtVerificarExistencia);
    mysqli_stmt_close($stmtVerificarExistencia);

    if ($total > 0) 
    {
        // El nombre de usuario o el correo electrónico ya existen, mostrar un mensaje de error.
        header('Location: ../view/register.php?error=El correo electrónico ya está registrado');
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
