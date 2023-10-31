<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/styles.css">
        <title>Log in / Sign in</title>
    </head>

    <body>
        <div class="container">
            <div class="box form-box">
                <header>Iniciar Sesión</header>
                <form action="" method="post">
                    <div class="field input">
                        <label for="user">Nombre de usuario:</label>
                        <input type="text" name="user" id="user" required>        
                    </div>

                    <div class="field input">
                        <label for="pass">Contraseña:</label>
                        <input type="text" name="pass" id="pass" required>        
                    </div>

                    <div class="field">
                        <input type="submit" name="enviar" id="enviar" class="btn" value="Enviar">        
                    </div>

                    <div class="links">
                        <p>¿No tienes cuenta? <a href="./register.php">Haz clic aquí y crea una cuenta</a></p>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>