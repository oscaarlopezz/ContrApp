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
                <header>Registrarse</header>
                <form action="" method="post">
                    <div class="field input">
                        <label for="user">Nombre de usuario:</label>
                        <input type="text" name="user" id="user" required>        
                    </div>

                    <div class="field input">
                        <label for="email">Email:</label>
                        <input type="text" name="email" id="email" required>        
                    </div>

                    <div class="field input">
                        <label for="pass">Contraseña:</label>
                        <input type="text" name="pass" id="pass" required>        
                    </div>

                    <div class="field">
                        <input type="submit" name="enviar" id="enviar" class="btn" value="Enviar">        
                    </div>

                    <div class="links">
                        <p>¿Ya tienes cuenta? <a href="./login.php">Haz clic aquí e inicia sesión</a></p>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>