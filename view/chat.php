<?php
    // Inicia la sesión
    session_start();

    // Comprueba si los valores están presentes en la URL y configúralos en las variables de sesión
    if (isset($_POST['id_user'])) {
        $_SESSION['id_user'] = $_POST['id_user'];
    }

    if (isset($_POST['amigo'])) {
        $_SESSION['receptor'] = $_POST['amigo'];
    }

    // Ahora puedes acceder a estos valores en cualquier lugar del script o en otras páginas
    $id_user = $_SESSION['id_user'];
    $receptor = $_SESSION['receptor'];
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Chat</title>
        <link rel="stylesheet" href="../css/style.css">
        <!-- FUENTE -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@300&family=Lora&family=Nunito:wght@300&display=swap" rel="stylesheet">
    </head>

    <body>
        <button type="button" id="botonVolver"><a href="../view/exito.php" style="text-decoration: none; color: white;">Volver</a></button>

        <div class="pagina"><div class="chat" id="chat-container"></div>

            <form id="enviarM" style="margin-bottom: 5px;">
                <input type="text" id="mensaje">
                <button type="submit" onclick="Enviar(event)" id="botonEnviar">Enviar</button>
            </form>
        </div>

        <script>
            function fetchMessages() {
                const chatContainer = document.getElementById('chat-container');
                const id_user = <?php echo $id_user; ?>;
                const receptor = <?php echo $receptor; ?>;
                const url = '../procesos/chat_p.php'; // Reemplaza con la URL de tu script PHP

                const xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        chatContainer.innerHTML = xhr.responseText; // Actualizar solo el contenido de chat-container
                        // setInterval(fetchMessages, 5000); // Cambia el intervalo según tus necesidades
                    }
                };

                xhr.open('POST', url, true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                
                // Define los datos que deseas enviar en el cuerpo de la solicitud
                const data = `user=${id_user}&amigo=${receptor}`;
                
                xhr.send(data);
            }

            // Llamar a fetchMessages al cargar la página por primera vez
            document.addEventListener("DOMContentLoaded", fetchMessages);

            // Obtén el elemento input por su ID
            const inputMensaje = document.getElementById('mensaje');

            // Agrega un event listener para el evento 'input'
            inputMensaje.addEventListener('input', function() {
                // Cuando el input cambie, ejecuta la función fetchMessages
                fetchMessages();
            });

            function Enviar(event) {
                event.preventDefault(); // Evita que se envíe el formulario automáticamente

                const id_user = <?php echo $id_user; ?>;
                const receptor = <?php echo $receptor; ?>;
                const mensajeValor = document.getElementById('mensaje');
                const mensaje = mensajeValor.value;

                // Verifica si el mensaje no está vacío
                if (mensaje.trim() === '') {
                    return; // No se envía si el mensaje está vacío
                }

                const url = '../procesos/enviarM.php'; // Reemplaza con la URL de tu script PHP

                const xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        // chatContainer.innerHTML = xhr.responseText;
                        fetchMessages();
                    }
                };

                xhr.open('POST', url, true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                // Define los datos que deseas enviar en el cuerpo de la solicitud
                const data = `id_user=${id_user}&receptor=${receptor}&mensaje=${mensaje}`;

                xhr.send(data);
            }
        </script>
    </body>
</html>
