<?php
    session_start(); // Iniciamos sesión.

    $user = $_SESSION['user']; // Recuperamos el valor de la sesión user.
    $passEncriptada = hash("sha256", $_SESSION['pass']);

    include_once('../herramientas/conexion.php'); // Incluimos el fichero de conexión.

    $consultaSeleccionarUser = "SELECT * FROM usuarios WHERE username = ? AND contraseña = ?"; // Seleccionamos el contenido de la tabla user.

    $stmtSeleccionarUser = mysqli_stmt_init($conn); 

    if (mysqli_stmt_prepare($stmtSeleccionarUser, $consultaSeleccionarUser)) 
    {
        mysqli_stmt_bind_param($stmtSeleccionarUser, "ss", $user, $passEncriptada);

        if (mysqli_stmt_execute($stmtSeleccionarUser)) 
        {
            $result = mysqli_stmt_get_result($stmtSeleccionarUser);

            if ($row = mysqli_fetch_assoc($result)) 
            {   
                echo "¡Bienvenido " . $_SESSION['user'] . "! La contraseña es CORRECTA"; // Si las contraseñas coinciden te da la bienvenida
            }
                
            else
            {
                header('Location ../view/login.php?Usuario o contraseña incorrectos'); // Se muestra el mensaje de error.
            }
        }
                        
    } 
  
    
    else 
    {
        header('Location: ../view/login.php?Error al preparar la consulta.'); // Se muestra el mensaje de error.
    }
?>
