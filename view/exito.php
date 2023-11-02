<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Document</title>
</head>
<body>
    <div class="container">
        <?php 
            session_start();
            include_once('../herramientas/conexion.php');

            $user = $_SESSION['user'];

            $consultaIdUser = "SELECT id FROM usuarios WHERE username = ?";

            $stmtIdUser = mysqli_stmt_init($conn);

            if (mysqli_stmt_prepare($stmtIdUser, $consultaIdUser)) 
            {
                mysqli_stmt_bind_param($stmtIdUser, "s", $user);
                mysqli_stmt_execute($stmtIdUser);

                $resultadoIdUser = 0;
                mysqli_stmt_bind_result($stmtIdUser, $resultadoIdUser);
                mysqli_stmt_fetch($stmtIdUser);

                mysqli_stmt_close($stmtIdUser);
            }

            $consultaBuscarAmigos = "SELECT u.username as amigo FROM amistades a INNER JOIN usuarios u ON a.usuario_2 = u.id WHERE a.usuario_1 = ?";

            $stmtBuscarAmigos = mysqli_stmt_init($conn);

            if (mysqli_stmt_prepare($stmtBuscarAmigos, $consultaBuscarAmigos)) 
            {
                mysqli_stmt_bind_param($stmtBuscarAmigos, "i", $resultadoIdUser);
                mysqli_stmt_execute($stmtBuscarAmigos);
                $resultados = mysqli_stmt_get_result($stmtBuscarAmigos);
                ?>
                <div class="row">
                    <div class="col-md-12 text-center" style="font-size: 20px; margin-top: 10%; background: black; color: white;">
                        <h2>Bienvenido <?php echo $_SESSION['user']; ?></h2>
                        <p>Esta es tu lista de amigos</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="thead-dark text-center">
                                    <tr>
                                        <th scope="col">Amigos</th>
                                        <th scope="col">Editar Contacto</th>
                                        <th scope="col">Abrir chat</th>
                                        <th scope="col">Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($fila = mysqli_fetch_assoc($resultados)) {
                                        $usuarioAmigo = $fila['amigo'];
                                        echo "<tr>";
                                        echo "<td>$usuarioAmigo</td>";
                                        echo "<td class='align-middle'><a href='editar_contacto.php?amigo=$usuarioAmigo'><button type='button' class='btn btn-warning'>Editar</button></a></td>";
                                        echo "<td class='align-middle'><a href='abrir_chat.php?amigo=$usuarioAmigo'><button type='button' class='btn btn-primary'>Abrir chat</button></a></td>";
                                        echo "<td class='align-middle'><a href='eliminar_contacto.php?amigo=$usuarioAmigo'><button type='button' class='btn btn-danger'>Eliminar Amigo</button></a></td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php
                mysqli_stmt_close($stmtBuscarAmigos);
            }
        mysqli_close($conn);
        ?>
    </div>
    <!-- Enlace a Bootstrap JS (opcional, solo si necesitas componentes interactivos de Bootstrap) -->
</body>
</html>
