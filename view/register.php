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
                <form action="../acciones/validarRegister.php" method="post">
                    <div class="field input">
                        <label for="name">Nombre:</label>
                        <input type="text" name="name" id="name">   
                        <?php  
                            if (isset($_GET['nameVacio'])) 
                            {
                                echo "<p style='color: red; font-weight: bold;'>Debes rellenar este campo.</p>";
                            }

                            if (isset($_GET['nameMal'])) 
                            {
                                echo "<p style='color: red; font-weight: bold;'>No puede contener números.</p>";
                            }
                        ?>               
                    </div>

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
                        <label for="email">Email:</label>
                        <input type="text" name="email" id="email">   
                        <?php
                            if (isset($_GET['emailVacio'])) {
                                echo "<p style='color: red; font-weight: bold;'>Debes rellenar este campo.</p>";
                            }

                            if (isset($_GET['emailMal'])) {
                                echo "<p style='color: red; font-weight: bold;'>Formato de correo electrónico inválido.</p>";
                            }

                            if (isset($_GET['emailDominioInvalido'])) {
                                echo "<p style='color: red; font-weight: bold;'>El correo electrónico debe ser de dominio @gmail.com.</p>";
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
                        <input type="submit" name="btnEnviar" id="btnEnviar" class="boton" value="Enviar">
                    </div>

                    <div class="links">
                        <p>¿Ya tienes cuenta? <a href="./login.php">Haz clic aquí e inicia sesión</a></p>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
