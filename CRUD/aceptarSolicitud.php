<?php
session_start();

include_once('../herramientas/conexion.php');

$usuarioSesion = $_SESSION['user'];

$sqlIdUserSesion = "SELECT id FROM usuarios WHERE username = '$usuarioSesion';";

$resultadoIdUserSesion = mysqli_query($conn, $sqlIdUserSesion);

if ($resultadoIdUserSesion) 
{
    if (isset($_POST['soli'])) 
    {
        $usuarios = $_POST['soli'];

        // Verifica si $usuarios es un array y, si no lo es, conviértelo en un array
        if (!is_array($usuarios)) 
        {
            $usuarios = array($usuarios);
        }

        foreach ($usuarios as $usuario) {
            $sqlIdUserPost = "SELECT id FROM usuarios WHERE username = ?";
            $stmtIdUserPost = mysqli_prepare($conn, $sqlIdUserPost);
            mysqli_stmt_bind_param($stmtIdUserPost, "s", $usuario);
            mysqli_stmt_execute($stmtIdUserPost);
            mysqli_stmt_bind_result($stmtIdUserPost, $resultadoIdUserPost);
            mysqli_stmt_fetch($stmtIdUserPost);
            mysqli_stmt_close($stmtIdUserPost); // Liberar los resultados

            if ($resultadoIdUserPost) 
            {
                // Comprobar si ya son amigos
                $sqlComprobarAmistad = "SELECT COUNT(*) FROM amistades WHERE (usuario_1 = ? AND usuario_2 = ?) OR (usuario_1 = ? AND usuario_2 = ?)";
                $stmtComprobarAmistad = mysqli_prepare($conn, $sqlComprobarAmistad);
                mysqli_stmt_bind_param($stmtComprobarAmistad, "iiii", $resultadoIdUserPost, $resultadoIdUserSesion, $resultadoIdUserSesion, $resultadoIdUserPost);
                mysqli_stmt_execute($stmtComprobarAmistad);
                mysqli_stmt_bind_result($stmtComprobarAmistad, $amistadExistente);
                mysqli_stmt_fetch($stmtComprobarAmistad);
                mysqli_stmt_close($stmtComprobarAmistad); // Liberar los resultados

                if ($amistadExistente > 0) 
                {
                    header('Location: ../view/exito.php?mensaje=Ya%20son%20amigos');
                } 
                
                else 
                {
                    // Insertar nueva amistad
                    $sqlInsertarAmistad = "INSERT INTO amistades (usuario_1, usuario_2) VALUES (?, ?)";
                    $stmtInsertarAmistad = mysqli_prepare($conn, $sqlInsertarAmistad);
                    mysqli_stmt_bind_param($stmtInsertarAmistad, "ii", $resultadoIdUserPost, $resultadoIdUserSesion);
                    mysqli_stmt_execute($stmtInsertarAmistad);
                    mysqli_stmt_close($stmtInsertarAmistad); // Liberar los resultados

                    // Eliminar solicitud
                    $sqlEliminarSolicitud = "DELETE FROM solicitudes WHERE emisor = ? AND receptor = ?";
                    $stmtEliminarSolicitud = mysqli_prepare($conn, $sqlEliminarSolicitud);
                    mysqli_stmt_bind_param($stmtEliminarSolicitud, "ii", $resultadoIdUserPost, $resultadoIdUserSesion);

                    if (mysqli_stmt_execute($stmtEliminarSolicitud)) 
                    {
                        header('Location: ../view/exito.php?mensaje=Amistad%20añadida%20con%20éxito');
                    } 
                    
                    else 
                    {
                        header('Location: ../view/exito.php?mensaje=Ocurrió%20un%20error%20al%20procesar%20la%20amistad');
                    }

                    mysqli_stmt_close($stmtEliminarSolicitud); // Liberar la consulta preparada
                }
            } 
            
            else 
            {
                header('Location: ../view/exito.php?mensaje=El%20usuario%20emisor%20no%20existe');
            }
        }
    } 
    
    else 
    {
        header('Location: ../view/exito.php?mensaje=El%20usuario%20receptor%20no%20existe');
    }
} 

else 
{
    header('Location: ../view/exito.php?mensaje=El%20usuario%20de%20la%20sesión%20no%20existe');
}
?>
