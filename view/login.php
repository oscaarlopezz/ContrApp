<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/styles.css">
        <script src="../js/botonLogin.js"></script>
        <title>Log in / Sign in</title>
    </head>
    
    <body>
        <div class="container">
            <div class="box form-box">
                <header>Iniciar Sesión</header>
                <form action="" method="post">
                    <div class="field input">
                        <label for="user">Nombre de usuario:</label>
                        <input type="text" name="user" id="user">
                        <p style="display: none; color: red; font-size: 15px;" id="alertauser">¡El formato de usuario que intenta introducir no es valido!</p> <!-- El mensaje de error permanece oculto hasta que el script detecta un error en el formato del texto introducido -->
                    </div>
                    <div class="field input">
                        <label for="pass">Contraseña:</label>
                        <input type="text" name="pass" id="pass">
                        <p style="display: none; color: red; font-size: 15px;" id="alertapass">¡La contraseña debe de tener almenos 9 caracteres!</p> <!-- El mensaje de error permanece oculto hasta que detecta que la contraseña es lo suficientemente larga. -->
                    </div>
                    <div class="field">
                        <input type="submit" name="enviar" class="btn" id="btnEnviar" value="Enviar" disabled>
                    </div>
                    <div class="links">
                        <p>¿No tienes cuenta? <a href="./register.php">Haz clic aquí y crea una cuenta</a></p>
                    </div>
                    <script src="../js/validacionLogin.js"></script> <!-- Este script valida el formato y si los campos están vacíos -->
                </form>
            </div>
        </div>
    </body>
</html>
