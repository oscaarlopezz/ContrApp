<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/styles.css">
        <script src="../js/boton.js"></script>
        <title>Log in / Sign in</title>
    </head>
    <body>
        <div class="container">
            <div class="box form-box">
                <header>Registrarse</header>
                <form action="../acciones/validarRegister.php" method="post">
                    <div class="field input">
                        <label for="user">Nombre de usuario:</label>
                        <input type="text" name="user" id="user">   
                        <p style="display: none; color: red; font-size: 15px;" id="alertauser">¡El formato de usuario que intenta introducir no es valido!</p> <!-- El mensaje de error permanece oculto hasta que el script detecta un error en el formato del texto introducido -->     
                    </div>

                    <div class="field input">
                        <label for="email">Email:</label>
                        <input type="text" name="email" id="email">   
                        <p style="display: none; color: red; font-size: 15px;" id="alertaEmail">¡Has de introducir un email válido!</p> <!-- El mensaje de error permanece oculto hasta que detecta que la contraseña es lo suficientemente larga. -->     
                    </div>

                    <div class="field input">
                        <label for="pass">Contraseña:</label>
                        <input type="password" name="pass" id="pass">    
                        <p style="display: none; color: red; font-size: 15px;" id="alertapass">¡La contraseña debe de tener almenos 9 caracteres!</p> <!-- El mensaje de error permanece oculto hasta que detecta que la contraseña es lo suficientemente larga. -->         
                    </div>

                    <div class="field">
                        <input type="submit" name="btnEnviar" id="btnEnviar" class="boton" value="Enviar" disabled>
                    </div>

                    <div class="links">
                        <p>¿Ya tienes cuenta? <a href="./login.php">Haz clic aquí e inicia sesión</a></p>
                    </div>

                    <script src="../js/validacionRegister.js"></script> <!-- Este script valida el formato y si los campos están vacíos -->
                </form>
            </div>
        </div>
    </body>
</html>
