document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector(".signup-form");

    form.addEventListener("submit", (event) => {
        // Obtener valores de los campos
        const usuario = form.usuario.value.trim();
        const psw = form.psw.value.trim();
        const email = form.email.value.trim();
        const nombre = form.nombre.value.trim();
        const apellido = form.apellido.value.trim();
        const rfc = form.rfc.value.trim();
        const fechaNacimiento = form.fNacimiento.value;

        // Regex para validar cada campo
        const regexUsuario = /^[a-zA-Z0-9]{3,20}$/; // Letras y números, entre 3 y 20 caracteres
        const regexPsw = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/; // Al menos una letra, un número, 8 caracteres
        const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Email válido
        const regexNombre = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/; // Letras y espacios
        const regexRFC = /^[A-ZÑ&]{3,4}\d{6}[A-Z\d]{3}$/; // RFC válido

        // Validar Usuario
        if (!regexUsuario.test(usuario)) {
            alert("El nombre de usuario debe tener entre 3 y 20 caracteres y solo puede contener letras y números.");
            event.preventDefault();
            return;
        }

        // Validar Contraseña
        if (!regexPsw.test(psw)) {
            alert("La contraseña debe tener al menos 8 caracteres, incluyendo una letra y un número.");
            event.preventDefault();
            return;
        }

        // Validar Email
        if (!regexEmail.test(email)) {
            alert("Por favor, ingresa un correo electrónico válido.");
            event.preventDefault();
            return;
        }

        // Validar Nombre
        if (!regexNombre.test(nombre)) {
            alert("El nombre solo puede contener letras y espacios.");
            event.preventDefault();
            return;
        }

        // Validar Apellido
        if (!regexNombre.test(apellido)) {
            alert("El apellido solo puede contener letras y espacios.");
            event.preventDefault();
            return;
        }

        // Validar RFC
        if (!regexRFC.test(rfc)) {
            alert("El RFC debe ser válido y cumplir con el formato estándar.");
            event.preventDefault();
            return;
        }

        // Validar Fecha de Nacimiento
        if (!fechaNacimiento) {
            alert("Por favor, ingresa una fecha de nacimiento válida.");
            event.preventDefault();
            return;
        }

        // Validación exitosa
        alert("Formulario enviado correctamente.");
    });
});
