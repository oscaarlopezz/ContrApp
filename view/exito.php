<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>

    <body>
        <?php 
            session_start();

            echo "Se ha introducido el usuario " . $_SESSION['user'] . " , con la cuenta de correo " . $_SESSION['email'] . " y con la contraseña " . $_SESSION['pass'];
        ?>
    </body>
</html>