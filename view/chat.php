<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php
$id_user = 1;
        $receptor = 2;
            // include_once('../procesos/conexion.php');
            ?>
    <div class="chat" id="chat-container">

    </div>
    <form id="enviarM">
            <input type="text" style="width: 80%; float: left" id="mensaje">
            <button type="submit" style="margin-left: 3%; border-radius: 10px;" onclick="Enviar()">Enviar</button>
    </form>
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
            setInterval(fetchMessages, 5000); // Cambia el intervalo según tus necesidades
        }
    };

    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    // Define los datos que deseas enviar en el cuerpo de la solicitud
    const data = `id_user=${id_user}&receptor=${receptor}`;
    
    xhr.send(data);
}

// Llamar a fetchMessages al cargar la página por primera vez
document.addEventListener("DOMContentLoaded", fetchMessages);


    

    function Enviar() {
        const id_user = <?php echo $id_user; ?>;
        const receptor = <?php echo $receptor; ?>;
        const mensajeValor = document.getElementById('mensaje');
        const mensaje = mensajeValor.value;
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
