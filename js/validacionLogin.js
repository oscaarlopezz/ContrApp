document.addEventListener("DOMContentLoaded", function () 
{
    // Obtiene referencias a los campos de usuario, email, contraseña y el botón de envío
    const userField = document.getElementById('user');
    const passField = document.getElementById('pass');
    const btnEnviar = document.getElementById('btnEnviar');

    // Expresión regular para validar el usuario (solo letras mayúsculas y minúsculas)
    const userRegex = /^[a-zA-Z]*$/;

    // Agrega eventos de escucha para los campos de usuario, email y contraseña
    userField.addEventListener('input', validateForm);
    passField.addEventListener('input', validateForm);

    // Define la función "validateForm" que se ejecutará cuando cambie el contenido de los campos
    function validateForm() 
    {
        const userValue = userField.value.trim();
        const passValue = passField.value.trim();

        // Valida el campo de usuario
        const alertaUser = document.getElementById('alertauser');
        if (userValue.length < 1 || !userRegex.test(userValue)) 
        {
            alertaUser.style.display = 'block'; // Muestra la alerta de usuario si no cumple con la validación
        } 
        
        else 
        {
            alertaUser.style.display = 'none'; // Oculta la alerta de usuario si es válido
        }

        // Valida el campo de contraseña
        const alertaPass = document.getElementById('alertapass');
        if (passValue.length !== 9) 
        {
            alertaPass.style.display = 'block'; // Muestra la alerta de contraseña si no tiene exactamente 9 caracteres
        } 
        
        else 
        {
            alertaPass.style.display = 'none'; // Oculta la alerta de contraseña en otros casos
        }

        // Comprueba si todos los campos son válidos y habilita/deshabilita el botón de envío
        if (userRegex.test(userValue) && passValue.length === 9) 
        {
            btnEnviar.removeAttribute("disabled"); // Habilita el botón de envío si todos los campos son válidos
        } 
        
        else 
        {
            btnEnviar.setAttribute("disabled", "disabled"); // Deshabilita el botón de envío si al menos uno de los campos no es válido
        }
    }
});
