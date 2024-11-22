<?php
    require_once __DIR__ . '/../../Config/Connection.php';
    require_once __DIR__ . '/../../Controllers/UsuarioController.php';

    $conn = require __DIR__ . '/../../Config/Connection.php';

    $auth = new Autenticacion($conn);
    $auth->logout();
?>