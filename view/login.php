<?php
session_start();
session_destroy();

?>
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
                <form action="../acciones/validarLogin.php" method="post">
                    <div class="field input">
                        <label for="user">Nombre de usuario:</label>
                        <input type="text" name="user" id="user">
                        <?php  
                            if (isset($_GET['usernameVacio'])) 
                            {
                                echo "<p style='color: red; font-weight: bold;'>Debes rellenar este campo.</p>";
                            }

                            if (isset($_GET['usernameMal'])) 
                            {
                                echo "<p style='color: red; font-weight: bold;'>No puede contener números.</p>";
                            }
                        ?>               
                </div>
                    <div class="field input">
                        <label for="pass">Contraseña:</label>
                        <input type="password" name="pass" id="pass">
                        <?php  
                            if (isset($_GET['passwordVacio'])) 
                            {
                                echo "<p style='color: red; font-weight: bold;'>Debes rellenar este campo.</p>";
                            }

                            if (isset($_GET['passwordMal'])) 
                            {
                                echo "<p style='color: red; font-weight: bold;'>Contraseña incorrecta.</p>";
                            }
                        ?>               
                    </div>
                    <div class="field">
                        <input type="submit" name="btnEnviar" class="boton" id="btnEnviar" value="Enviar">
                    </div>
                    <div class="links">
                        <p>¿No tienes cuenta? <a href="./register.php">Haz clic aquí y crea una cuenta</a></p>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
