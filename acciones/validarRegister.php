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
    $email = $_POST['email'];
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

    if (validaCampoVacio($email)) 
    {
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
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
        {
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
            // Verificar que el dominio sea gmail.com
            $dominio = explode('@', $email);
            if ($dominio[1] !== 'gmail.com') 
            {
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

    if ($errores != "") 
    {
        $datosRecibidos = array(
            'user' => $user,
            'pass' => $pass,
            'email' => $email
        );

        $datosDevueltos=http_build_query($datosRecibidos);
        header('location: '.'../view/register.php'. $errores. "&". $datosDevueltos);
        exit();    
    }
    
    else
    {
        $_SESSION['user'] = $user;
        $_SESSION['pass'] = $pass;
        $_SESSION['email'] = $email;
        
        header('Location: '.'./checkRegister.php');
    }
?>
