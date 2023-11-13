<?php
    session_start(); // Inicia la sesión.

    // Verifica si se ha llegado desde el formulario.
    if (!isset($_POST['btnEnviar'])) 
    {
        header('Location: '.'../view/login.php?Debes rellenar el formulario.');
        exit();
    }

    $errores = "";

    $user = $_POST['user'];
    $pass = $_POST['pass'];

    include_once('../herramientas/funciones.php');

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

    if ($errores != "") 
    {
        $datosRecibidos = array(
            'user' => $user,
            'pass' => $pass
        );

        $datosDevueltos=http_build_query($datosRecibidos);
        header('location: '.'../view/login.php'. $errores. "&". $datosDevueltos);
        exit();    
    }
    
    else
    {
        $_SESSION['user'] = $user;
        $_SESSION['pass'] = $pass;
        
        header('Location: '.'./checkLogin.php');
    }
?>
