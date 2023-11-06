<?php
include('../herramientas/conexion.php');

// Asegúrate de iniciar la sesión antes de usar $_SESSION
session_start();

$userSesion = $_SESSION['user'];

// Utiliza comillas simples para rodear la variable en la consulta SQL
$idSesion = "SELECT id FROM usuarios WHERE username = '$userSesion';";

// Ejecuta la consulta SQL
$resultadoIdSesion = mysqli_query($conn, $idSesion);

if ($resultadoIdSesion) 
{
    // Verifica si la consulta se realizó con éxito y si el usuario existe
    if (mysqli_num_rows($resultadoIdSesion) > 0) 
    {
        // Obtén el ID del usuario del formulario $_POST
        $usuarioPost = $_POST['user'];

        $idUserPost = "SELECT id FROM usuarios WHERE username = '$usuarioPost';"; // Agrega comillas simples

        $resultadoIdUserPost = mysqli_query($conn, $idUserPost);

        if ($resultadoIdUserPost) 
        {
            // Verifica si la consulta se realizó con éxito
            if (mysqli_num_rows($resultadoIdUserPost) > 0) 
            {                
                $idSesion = mysqli_fetch_assoc($resultadoIdSesion)['id'];
                $idNuevoUsuario = mysqli_fetch_assoc($resultadoIdUserPost)['id'];

                // Comprueba si ya existe una relación en la tabla 'amistades' con ambos IDs
                $consultaAmistades = "SELECT id FROM amistades WHERE (usuario_1 = '$idSesion' AND usuario_2 = '$idNuevoUsuario') OR (usuario_1 = '$idNuevoUsuario' AND usuario_2 = '$idSesion')";
                $resultadoAmistades = mysqli_query($conn, $consultaAmistades);

                if (mysqli_num_rows($resultadoAmistades) > 0) 
                {
                    // Redirige con un mensaje de error, ya son amigos
                    header('Location: ../CRUD/enviarSolicitud.php?yaSonAmigos');
                }
                else 
                {
                    // Continúa con el código para insertar la solicitud
                    $consultaSolicitudes = "SELECT id FROM solicitudes WHERE emisor = '$idSesion' AND receptor = '$idNuevoUsuario'";
                    $resultadoSolicitudes = mysqli_query($conn, $consultaSolicitudes);

                    if (mysqli_num_rows($resultadoSolicitudes) > 0) 
                    {
                        header('Location: ../CRUD/enviarSolicitud.php?solicitudExiste');
                    }
                    else 
                    {
                        $insertarSolicitudes = "INSERT INTO solicitudes (emisor, receptor) VALUES ('$idSesion', '$idNuevoUsuario')";
                        $resultadoInsertarSolicitudes = mysqli_query($conn, $insertarSolicitudes);
                
                        if ($resultadoInsertarSolicitudes) 
                        {
                            header('Location'.'../view/exito.php?solicitudEnviada');
                        }
                        else 
                        {
                            header('Location'.'../view/exito.php?solicitudNoEnviada');
                        }            
                    }
                }
            }
            else 
            {
                // Si el usuario con el nombre proporcionado no existe, puedes redirigir al usuario a la página deseada
                header('Location: ../CRUD/enviarSolicitud.php?usuarioNoExiste');
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
