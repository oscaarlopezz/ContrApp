<?php
include('../herramientas/conexion.php');

// Asegúrate de iniciar la sesión antes de usar $_SESSION
session_start();

$userSesion = $_SESSION['user'];

// Utiliza comillas simples para rodear la variable en la consulta SQL
$idSesion = "SELECT id FROM usuarios WHERE username = ?"; // Usamos marcadores de posición

// Prepara la consulta SQL
$stmtIdSesion = mysqli_prepare($conn, $idSesion);

// Vincula el marcador de posición con el valor de $userSesion
mysqli_stmt_bind_param($stmtIdSesion, "s", $userSesion);

// Ejecuta la consulta SQL
mysqli_stmt_execute($stmtIdSesion);

// Obtiene el resultado de la consulta
$resultadoIdSesion = mysqli_stmt_get_result($stmtIdSesion);

if ($resultadoIdSesion) 
{
    // Verifica si la consulta se realizó con éxito y si el usuario existe
    if (mysqli_num_rows($resultadoIdSesion) > 0) 
    {
        // Obtén el ID del usuario del formulario $_POST
        $usuarioPost = $_POST['user'];

        $idUserPost = "SELECT id FROM usuarios WHERE username = ?"; // Usamos marcadores de posición

        // Prepara la consulta SQL
        $stmtIdUserPost = mysqli_prepare($conn, $idUserPost);

        // Vincula el marcador de posición con el valor de $usuarioPost
        mysqli_stmt_bind_param($stmtIdUserPost, "s", $usuarioPost);

        // Ejecuta la consulta SQL
        mysqli_stmt_execute($stmtIdUserPost);

        // Obtiene el resultado de la consulta
        $resultadoIdUserPost = mysqli_stmt_get_result($stmtIdUserPost);

        if ($resultadoIdUserPost) 
        {
            // Verifica si la consulta se realizó con éxito
            if (mysqli_num_rows($resultadoIdUserPost) > 0) 
            {                
                $idSesion = mysqli_fetch_assoc($resultadoIdSesion)['id'];
                $idNuevoUsuario = mysqli_fetch_assoc($resultadoIdUserPost)['id'];

                // Comprueba si ya existe una relación en la tabla 'amistades' con ambos IDs
                $consultaAmistades = "SELECT id FROM amistades WHERE (usuario_1 = ? AND usuario_2 = ?) OR (usuario_1 = ? AND usuario_2 = ?)"; // Usamos marcadores de posición

                // Prepara la consulta SQL
                $stmtAmistades = mysqli_prepare($conn, $consultaAmistades);

                // Vincula los marcadores de posición con los valores de los IDs
                mysqli_stmt_bind_param($stmtAmistades, "iiii", $idSesion, $idNuevoUsuario, $idNuevoUsuario, $idSesion);

                // Ejecuta la consulta SQL
                mysqli_stmt_execute($stmtAmistades);

                // Obtiene el resultado de la consulta
                $resultadoAmistades = mysqli_stmt_get_result($stmtAmistades);

                if (mysqli_num_rows($resultadoAmistades) > 0) 
                {
                    // Redirige con un mensaje de error, ya son amigos
                    header('Location: ../CRUD/enviarSolicitud.php?yaSonAmigos');
                    exit();
                }
                else 
                {
                    // Comprueba si el usuario que se quiere agregar es el mismo que el de la sesión
                    if ($userSesion === $_POST['user']) {
                        header('Location: ../CRUD/enviarSolicitud.php?mismoUsuario'); // Redirige con un mensaje de error
                        exit;
                    } else 
                    {
                        // Continúa con el código para insertar la solicitud
                        $consultaSolicitudes = "SELECT id FROM solicitudes WHERE emisor = ? AND receptor = ?"; // Usamos marcadores de posición

                        // Prepara la consulta SQL
                        $stmtSolicitudes = mysqli_prepare($conn, $consultaSolicitudes);

                        // Vincula los marcadores de posición con los valores de los IDs
                        mysqli_stmt_bind_param($stmtSolicitudes, "ii", $idSesion, $idNuevoUsuario);

                        // Ejecuta la consulta SQL
                        mysqli_stmt_execute($stmtSolicitudes);

                        // Obtiene el resultado de la consulta
                        $resultadoSolicitudes = mysqli_stmt_get_result($stmtSolicitudes);

                        if (mysqli_num_rows($resultadoSolicitudes) > 0) 
                        {
                            header('Location: ../CRUD/enviarSolicitud.php?solicitudExiste');
                        }
                        else 
                        {
                            $insertarSolicitudes = "INSERT INTO solicitudes (emisor, receptor) VALUES (?, ?)"; // Usamos marcadores de posición

                            // Prepara la consulta SQL
                            $stmtInsertarSolicitudes = mysqli_prepare($conn, $insertarSolicitudes);

                            // Vincula los marcadores de posición con los valores de los IDs
                            mysqli_stmt_bind_param($stmtInsertarSolicitudes, "ii", $idSesion, $idNuevoUsuario);

                            // Ejecuta la consulta SQL
                            mysqli_stmt_execute($stmtInsertarSolicitudes);

                            if ($stmtInsertarSolicitudes) 
                            {
                                header('Location: ../view/exito.php?solicitudEnviada');
                            }
                            else 
                            {
                                header('Location: ../view/exito.php?solicitudNoEnviada');
                            }            
                        }
                    }
                }
            }
            else 
            {
                // Si el usuario con el nombre proporcionado no existe, puedes redirigir al usuario a la página deseada
                header('Location: ../CRUD/enviarSolicitud.php?ElUsuarioNoExiste');
                exit; // Asegura que el script se detiene después de redirigir
            }
        }
        else 
        {
            echo "Error en la consulta: " . mysqli_error($conn); // Muestra un mensaje de error si la consulta falla
        }
    }    
}
else 
{
    header('Location: ../CRUD/añadir.php?error1');
}

// Cierra la conexión a la base de datos
mysqli_close($conn);
?>
