<?php
    session_start();

    if (!isset($_SESSION['user'])) 
    {
        header('Location: '.'../view/login.php?error=NoSesion');
    }

    else
    {
        ?>

        <!DOCTYPE html>
        <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <!-- Bootstrap -->
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
                <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
                <!-- CSS -->
                <link rel="stylesheet" href="../css/stylesCrud.css">
                <!-- TÍTULO -->
                <title>Página de amigos de <?php echo $_SESSION['user'] ?></title>
            </head>

            <body>
                <div class="container">
                    <?php
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

                    $consultaBuscarAmigos = "SELECT u.username as amigo, a.FechaConfirmacion as fecha FROM amistades a INNER JOIN usuarios u ON a.usuario_2 = u.id WHERE a.usuario_1 = ?";

                    $stmtBuscarAmigos = mysqli_stmt_init($conn);

                    if (mysqli_stmt_prepare($stmtBuscarAmigos, $consultaBuscarAmigos)) 
                    {
                        mysqli_stmt_bind_param($stmtBuscarAmigos, "i", $resultadoIdUser);
                        mysqli_stmt_execute($stmtBuscarAmigos);
                        $resultados = mysqli_stmt_get_result($stmtBuscarAmigos);
                        
                        // Comprobar si el usuario no tiene amigos
                        if (mysqli_num_rows($resultados) > 0) 
                        {
                        ?>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" style="background: #FFFF;">
                                    <thead class="thead-dark text-center">
                                        <tr>
                                            <th colspan="4">¡Bienvenido <?php echo $user ?>! Esta es tu lista de amigos:</th>
                                            <th class="text-right">
                                                <button type="button" class="btn btn-success">
                                                    <a href="../acciones/añadir.php" style="color: white; text-decoration: none;">Añadir</a>
                                                </button>
                                                
                                                <button type="button" class="btn btn-danger">
                                                    <a href="../acciones/cerrar_sesion.php" style="color: white; text-decoration: none;">Volver</a>
                                                </button>
                                                
                                            </th>
                                        </tr>
                                    </thead>

                                        <thead class="thead-dark text-center">
                                            <tr>
                                                <th scope="col">Amigos</th>
                                                <th scope="col">Fecha y hora de la confirmación</th>
                                                <th scope="col" class="text-center">Editar Contacto</th>
                                                <th scope="col" class="text-center">Abrir chat</th>
                                                <th scope="col" class="text-center">Eliminar</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            $numPerPage = 5;
                                            $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                            $start = ($currentPage - 1) * $numPerPage;
                                            $end = $start + $numPerPage;

                                            $count = 0;
                                            while ($fila = mysqli_fetch_assoc($resultados)) {
                                                if ($count >= $start && $count < $end) {
                                                    $usuarioAmigo = $fila['amigo'];
                                                    $fecha = $fila['fecha'];
                                                    echo "<tr>";
                                                    echo "<td>$usuarioAmigo</td>";
                                                    echo "<td>$fecha</td>";
                                                    echo "<td class='align-middle text-center'><a href='../CRUD/editar.php?amigo=$usuarioAmigo'><i class='fas fa-edit'></i></a></td>";
                                                    echo "<td class='align-middle text-center'><a href='../CRUD/chat.php?amigo=$usuarioAmigo'><i class='fas fa-paper-plane'></i></a></td>";
                                                    echo "<td class='align-middle text-center'><a href='../CRUD/eliminar.php?amigo=$usuarioAmigo'><i class='fas fa-trash-alt'></i></a></td>";
                                                    echo "</tr>";
                                                }
                                                $count++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="text-center pagination-container">
                            <nav aria-label="Page navigation">
                                <ul class="pagination">
                                    <?php
                                        $totalPages = ceil($count / $numPerPage);
                                        for ($i = 1; $i <= $totalPages; $i++) 
                                        {
                                            echo "<li class='page-item " . ($i == $currentPage ? 'active' : '') . "'>";
                                                echo "<a class='page-link' href='?page=$i'>$i</a>";
                                            echo "</li>";
                                        }
                                    ?>
                                </ul>
                            </nav>
                        </div>
                        
                        <?php
                        } 
                        
                        else 
                        {
                            ?>
                                <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
                                    <div style="background: white; padding: 20px; text-align: center; border-radius: 10px; width: 45vw;">
                                        <div class="d-flex flex-column justify-content-center align-items-center" style="margin-bottom: 20px;">
                                            <h2 style="border-bottom: 1px solid grey;">No tienes amigos</h2>
                                        </div>

                                        <div style="margin-bottom: 20px;">
                                            <img src="../img/gatoLlorando.jpg" alt="Gato Llorando" style="width: 20vw;">
                                        </div>

                                        <div>
                                            <button type="button" class="btn btn-success">
                                                <a href="../CRUD/añadir.php" style="color: white; text-decoration: none;">Añadir Amigo</a>
                                            </button>

                                            <button type="button" class="btn btn-danger">
                                                <a href="../acciones/cerrar_sesion.php" style="color: white; text-decoration: none;">Volver</a>
                                            </button>
                                        </div>
                                    </div>
                                </div>      
                            <?php
                        }
                        mysqli_stmt_close($stmtBuscarAmigos);
                    }
                    mysqli_close($conn);

    }
                ?>
        </div>
    </body>
</html>
