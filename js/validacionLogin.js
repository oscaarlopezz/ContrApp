document.addEventListener("DOMContentLoaded", function () 
{
    // Obtiene referencias a los campos de usuario y contraseña
    const userF = document.getElementById('user');
    const passF = document.getElementById('pass');

    // Agrega un evento de escucha para el campo de usuario
    userF.addEventListener('input', function () 
    {
        // Obtiene el valor del campo de usuario y la alerta de usuario
        const user = document.getElementById('user');
        const alertauser = document.getElementById('alertauser');

        // Comprueba si el valor del campo de usuario cumple con la validación de la función "validarUser"
        if (validarUser(user.value)) 
        {
            alertauser.style.display = 'none'; // Oculta la alerta de usuario si es válido
        } 
        
        else if (user.value.length < 1) {

            alertauser.style.display = 'none'; // Oculta la alerta de usuario si el campo está vacío
        } 
        
        else
        {
            alertauser.style.display = 'block'; // Muestra la alerta de usuario si no cumple con la validación
        }
    });

    // Agrega un evento de escucha para el campo de contraseña
    passF.addEventListener('input', function () 
    {
        // Obtiene el valor del campo de contraseña y la alerta de contraseña
        const pass = document.getElementById('pass');
        const alertapass = document.getElementById('alertapass');

        // Comprueba la longitud de la contraseña y muestra la alerta correspondiente
        if (pass.value.length !== 9) 
        {
            alertapass.style.display = 'block'; // Muestra la alerta de contraseña si no tiene 9 caracteres
        } 
        
        else 
        {
            alertapass.style.display = 'none'; // Oculta la alerta de contraseña en otros casos
        }
    });
});
