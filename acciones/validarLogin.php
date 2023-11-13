<?php
    session_start(); // Inicia la sesión.

    // Verifica si se ha llegado desde el formulario.
    if (!isset($_POST['btnEnviar'])) 
    {
        // Redirecciona a la página de login con un mensaje de error.
        header('Location: '.'../view/login.php?Debes rellenar el formulario.');
        exit();
    }

    $errores = ""; // Variable para almacenar mensajes de error.

    // Obtiene los valores del formulario.
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    // Incluye funciones necesarias desde un archivo externo.
    include_once('../herramientas/funciones.php');

    // Validación del campo de usuario.
    if (validaCampoVacio($user))
    {
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
        if(!preg_match("/^[a-zA-Z]*$/",$user))
        {
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

    // Validación del campo de contraseña.
    if (validaCampoVacio($pass)) 
    {
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
        if (!preg_match("/^.{9}$/", $pass)) 
        {
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

    // Si hay errores, redirecciona a la página de login con los mensajes de error.
    if ($errores != "") 
    {
        $datosRecibidos = array(
            'user' => $user,
            'pass' => $pass
        );

        $datosDevueltos = http_build_query($datosRecibidos);
        header('location: '.'../view/login.php'. $errores. "&". $datosDevueltos);
        exit();    
    }
    else
    {
        // Si no hay errores, establece las variables de sesión y redirecciona a la página de checkLogin.
        $_SESSION['user'] = $user;
        $_SESSION['pass'] = $pass;
        
        header('Location: '.'./checkLogin.php');
    }
?>
