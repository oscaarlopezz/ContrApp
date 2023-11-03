<?php
    session_start();

    $user = $_SESSION['user'];
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
                <form action="../procesos//proc_añadir.php" method="post">
                    <div class="field input">
                        <label for="user">Nombre de usuario:</label>
                        <input type="text" name="user" id="user">
                        <p style="display: none; color: red; font-size: 15px;" id="alertauser">¡El formato de usuario que intenta introducir no es valido!</p> <!-- El mensaje de error permanece oculto hasta que el script detecta un error en el formato del texto introducido -->
                    </div>

                    <div class="field input">
                        <label for="text">Correo:</label>
                        <input type="email" name="email" id="email">
                        <p style="display: none; color: red; " id="alertaemail">¡El email debe ser válido!</p> <!-- El mensaje de error permanece oculto hasta que detecta que la contraseña es lo suficientemente larga. -->
                    </div>

                    <div class="field">
                        <input type="submit" name="btnEnviar" class="boton" id="btnEnviar" value="Enviar" disabled>
                    </div>

                    <script src="../js/validacionAñadir.js"></script> <!-- Este script valida el formato y si los campos están vacíos -->
                </form>

                <a href="../view/exito.php" class="botonRojo">Volver</a>
            </div>
        </div>
    </body>
</html>