<?php
    if (!isset($_SESSION['user']) || !isset($_SESSION['email']) || !isset($_SESSION['pass'])) 
    {
        header('Location: ../view/register.php?error=Debes rellenar el formulario para acceder a check.php');
        exit();
    } 
    
    else
    {
        include_once('./herramientas/conexion.php');

        $consultaComprobarUsuario = "INSERT INTO usuarios (username, email, contraseña) VALUES (?, ?, ?)";

        $stmtComprobarUser = mysqli_prepare($conn, $consultaComprobarUsuario);

        if ($stmtComprobarUser) 
        {   
            $passEncriptada = $_SESSION['pass'];
            mysqli_stmt_bind_param($stmtComprobarUser, "sss", $_SESSION['user'], $_SESSION['email'], $passEncriptada);
            mysqli_stmt_execute($stmtComprobarUser);
            mysqli_stmt_close($stmtComprobarUser);
            mysqli_close($conn);
    
            // Redirecciona a una página de éxito o a donde desees una vez que el usuario se haya registrado.
            header('Location: ../view/exito.php');
            exit();
        } 
        
        else 
        {
            // Si hubo un error en la preparación de la consulta SQL, puedes manejarlo de la siguiente manera.
            header('Location: ../view/register.php?error=Error en la preparación de la consulta SQL');
            exit();
        }    
    }
?>