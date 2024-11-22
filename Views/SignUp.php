<?php
    require_once '../Config/Connection.php';
    require_once '../Controllers/UsuarioController.php';

    $auth = new Autenticacion($conn);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $usuario = $_POST['usuario'];
        $psw = $_POST['psw'];
        $email = $_POST['email'];
        $nombre = $_POST['nombre'];
        $sNombre = $_POST['sNombre'];
        $apellido = $_POST['apellido'];
        $rfc = $_POST['rfc'];
        $fNacimiento = $_POST['fNacimiento'];
        $auth->registrar($usuario, $psw, $email, $nombre, $sNombre, $apellido, $fNacimiento, $rfc);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/log-sign.css">
    <title>Document</title>
</head>
<body>
<div class="login">
        <div class="logo-login">
            Logo
            <h1>Crea tu cuenta aqui.</h1>
            <span class="login-icon">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" height="40" width="40">
                    <path fill-rule="evenodd" d="M16.75 6.25a4.75 4.75 0 1 1-9.5 0 4.75 4.75 0 0 1 9.5 0Zm-1.5 0a3.25 3.25 0 1 1-6.5 0 3.25 3.25 0 0 1 6.5 0Z M12 12.5c-2.397 0-4.827.238-6.684.991-.935.38-1.767.907-2.367 1.64-.611.746-.949 1.665-.949 2.752V20h1.5v-2.117c0-.753.226-1.334.61-1.802.393-.48.986-.881 1.77-1.2C7.464 14.238 9.66 14 12 14c2.348 0 4.542.214 6.124.845.783.312 1.373.71 1.765 1.192.382.47.61 1.063.61 1.847L20.5 20H22v-2.116c0-1.107-.335-2.04-.947-2.793-.602-.74-1.436-1.266-2.374-1.64-1.858-.74-4.29-.951-6.679-.951Z"></path>
                </svg>
            </span>
        </div>
        <form class="signup-form" action="" method="POST">
            <input type="text" name="usuario" placeholder="Usuario" require>
            <input type="password" name="psw" placeholder="Contraseña" require>
            <input type="email" id="email" name="email" placeholder="Correo electrónico" require>
            <input type="text" name="nombre" placeholder="Nombre" require>
            <input type="text" id="sNombre" name="sNombre" placeholder="Segundo nombre (OPCIONAL)">
            <input type="text" name="apellido" placeholder="Apellido" require>
            <input type="text" id="rfc" name="rfc" placeholder="RFC" require>
            <input type="date" id="fecha_nacimiento" name="fNacimiento" require>
            <button class="btn-login" type="submit">Crear Usuario</button>
        </form>
        <p class="crear-cuneta-p">
            Si tienes una cuenta <a href="Login.php">Inicia Sesion</a>
        </p>
    </div>
</body>
</html>