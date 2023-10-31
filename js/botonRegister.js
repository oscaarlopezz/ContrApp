document.addEventListener("DOMContentLoaded", function() 
{
    // Obtiene referencias a los campos de usuario, email, contraseña y al botón de envío
    const campoUser = document.getElementById("user");
    const campoEmail = document.getElementById("email");
    const campoPass = document.getElementById("pass");
    const btnEnviar = document.getElementById("btnEnviar");

    // Agrega un evento de escucha para el evento "change" en los campos de usuario, email y contraseña
    campoUser.addEventListener("change", validateForm);
    campoEmail.addEventListener("change", validateForm);
    campoPass.addEventListener("change", validateForm);

    // Define la función "validateForm" que se ejecutará cuando cambie el contenido de los campos
    function validateForm() {
        // Comprueba si todos los campos no están vacíos (sin espacios en blanco)
        if (campoUser.value.trim() !== "" && campoEmail.value.trim() !== "" && campoPass.value.trim() !== "") 
        {
            // Habilita el botón de envío si todos los campos no están vacíos
            btnEnviar.removeAttribute("disabled");
        } 
        
        else 
        {
            // Deshabilita el botón de envío si al menos uno de los campos está vacío
            btnEnviar.setAttribute("disabled", "disabled");
        }
    }
});
