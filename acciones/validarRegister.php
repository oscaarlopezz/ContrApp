<?php
    // Inicia la sesión.
    session_start();

    // Verifica si se ha llegado desde el formulario.
    if (!isset($_POST['btnEnviar'])) 
    {
        // Redirecciona a la página de login con un mensaje de error.
        header('Location: '.'../view/login.php?Debes rellenar el formulario.');
        exit();
    }

    // Variable para almacenar mensajes de error.
    $errores = "";

    // Obtiene los valores del formulario.
    $user = $_POST['user'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    // Incluye funciones necesarias desde un archivo externo.
    include_once('../herramientas/funciones.php');

    // Validación del campo de usuario.
    if (validaCampoVacio($user))
    {
        // Agrega un parámetro a la cadena de errores si el campo de usuario está vacío.
        if (!$errores)
        {
            $errores .="?usernameVacio=true";
        } 
        else 
        {
            $errores .="&usernameVacio=true";        
        }
    } 
    else 
    {
        // Verifica si el campo de usuario contiene solo letras.
        if(!preg_match("/^[a-zA-Z]*$/",$user))
        {
            // Agrega un parámetro a la cadena de errores si el campo de usuario contiene caracteres no permitidos.
            if (!$errores)
            {
                $errores .="?usernameMal=true";
            } 
            else 
            {
                $errores .="&usernameMal=true";        
            }
        }
    }

    // Validación del campo de usuario.
    if (validaCampoVacio($user))
    {
        // Agrega un parámetro a la cadena de errores si el campo de usuario está vacío.
        if (!$errores)
        {
            $errores .="?nameVacio=true";
        } 
        else 
        {
            $errores .="&nameVacio=true";        
        }
    } 
    else 
    {
        // Verifica si el campo de usuario contiene solo letras.
        if(!preg_match("/^[a-zA-Z]*$/",$user))
        {
            // Agrega un parámetro a la cadena de errores si el campo de usuario contiene caracteres no permitidos.
            if (!$errores)
            {
                $errores .="?nameMal=true";
            } 
            else 
            {
                $errores .="&nameMal=true";        
            }
        }
    }
    

    // Validación del campo de contraseña.
    if (validaCampoVacio($pass)) 
    {
        // Agrega un parámetro a la cadena de errores si el campo de contraseña está vacío.
        if (!$errores) 
        {
            $errores .= "?passwordVacio=true";
        } 
        else 
        {
            $errores .= "&passwordVacio=true";
        }
    } 
    else 
    {
        // Verifica si el campo de contraseña tiene exactamente 9 caracteres.
        if (!preg_match("/^.{9}$/", $pass)) 
        {
            // Agrega un parámetro a la cadena de errores si el campo de contraseña no tiene la longitud adecuada.
            if (!$errores) 
            {
                $errores .= "?passwordMal=true";
            } 
            else 
            {
                $errores .= "&passwordMal=true";
            }
        }
    }

    // Validación del campo de correo electrónico.
    if (validaCampoVacio($email)) 
    {
        // Agrega un parámetro a la cadena de errores si el campo de correo electrónico está vacío.
        if (!$errores) 
        {
            $errores .= "?emailVacio=true";
        } 
        else 
        {
            $errores .= "&emailVacio=true";
        }
    } 
    else 
    {
        // Verifica si el formato del correo electrónico es válido.
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
        {
            // Agrega un parámetro a la cadena de errores si el formato del correo electrónico es inválido.
            if (!$errores) 
            {
                $errores .= "?emailMal=true";
            } 
            else 
            {
                $errores .= "&emailMal=true";
            }
        } 
        else 
        {
            // Verifica que el dominio sea gmail.com
            $dominio = explode('@', $email);
            if ($dominio[1] !== 'gmail.com') 
            {
                // Agrega un parámetro a la cadena de errores si el dominio del correo electrónico no es gmail.com.
                if (!$errores) 
                {
                    $errores .= "?emailDominioInvalido=true";
                } 
                else 
                {
                    $errores .= "&emailDominioInvalido=true";
                }
            }
        }
    }

    // Si hay errores, redirecciona a la página de registro con los mensajes de error y los datos recibidos.
    if ($errores != "") 
    {
        // Almacena los datos recibidos en un array.
        $datosRecibidos = array(
            'user' => $user,
            'pass' => $pass,
            'email' => $email
        );

        // Convierte los datos en una cadena de consulta y redirecciona.
        $datosDevueltos = http_build_query($datosRecibidos);
        header('location: '.'../view/register.php'. $errores. "&". $datosDevueltos);
        exit();    
    }
    else
    {
        // Si no hay errores, establece las variables de sesión y redirecciona a la página de checkRegister.
        $_SESSION['user'] = $user;
        $_SESSION['pass'] = $pass;
        $_SESSION['email'] = $email;
        
        header('Location: '.'./checkRegister.php');
    }
?>
