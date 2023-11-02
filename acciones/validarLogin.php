<?php
    session_start(); // Inicia la sesión.

    // Verifica si se ha llegado desde el formulario.
    if (!isset($_POST['btnEnviar'])) 
    {
        header('Location: '.'../view/login.php?Debes rellenar el formulario.');
        exit();
    }

    // Si se ha enviado un valor para 'user', lo almacenamos en una variable de sesión llamada 'user'
    if (isset($_POST['user'])) {
        $_SESSION['user'] = $_POST['user'];
    }

    // Si se ha enviado un valor para 'pass', lo almacenamos en una variable de sesión llamada 'pass'
    if (isset($_POST['pass'])) {
        $pass = $_POST['pass'];
        $_SESSION['pass'] = $pass;
    }

    // Redirige al usuario a la página 'comprobarLogin.php'
    header('Location: '.'./checkLogin.php');
    exit();
?>
