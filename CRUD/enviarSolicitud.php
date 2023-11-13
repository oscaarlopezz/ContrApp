<?php
    session_start();

    $user = $_SESSION['user'];
    if (isset($_GET['aviso'])){
        echo '<script>alert("' . $_GET['aviso'] . '");</script>';
    }
    
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
        <link rel="stylesheet" href="../css/styles.css">
        <!-- JS -->
        <script src="../js/botonAñadir.js"></script>
        <title>Agregar</title>
    </head>

    <body>
        <div class="container">
            <div class="box form-box">
                <header>¡Hey, <?php echo $user ?>! ¿A quién agregas?</header>
                <label for="username">Usuario:</label>
                <input type="text" id="username" name="username">
                <table>
                    <thead>
                        <tr>
                            <td>Usuario</td>
                            <td>Nombre</td>
                            <td>Agregar</td>
                        </tr>
                    </thead>
                    <tbody id="resultado">
                    </tbody>
                </table>
                <!-- <div class="usuarios"></div> -->

                <script src="../js/validacionAñadir.js"></script> <!-- Este script valida el formato y si los campos están vacíos -->
                <a href="../view/exito.php" class="botonRojo">Volver</a>
            </div>
        </div>
    </body>
</html>