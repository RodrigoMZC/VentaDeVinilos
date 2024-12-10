<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    require_once __DIR__ . '/../Config/Connection.php';
    require_once __DIR__ . '/../Controllers/UsuarioController.php';
    require_once __DIR__ . '/../Controllers/DireccionController.php';
    require_once __DIR__ . '/../Controllers/CompraController.php';

    if (!isset($_SESSION['usr_id'])) {
        header("Location: Login.php");
        exit;
    }

    $usr_id = $_SESSION['usr_id'];

    $auth = new Autenticacion($conn);
    $dir  = new DireccionController($conn); 

    $clienteData = $auth->obtenerCliente($usr_id);
    $direcciones = $dir->obtenerDireccion($usr_id);

    $compraController = new CompraController($conn);
    $conpras = $compraController->obtenerComprasCliente($usr_id);

    if (!$clienteData) {
        echo "Error: No se pudo recuperar la información del usuario.";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/Styles/styles.css">
</head>
<body>
    <?php include 'Includes/header.php'; ?>
    
    <section class="profile-section">
        <div class="form-container">
            <!-- Formulario de perfil de usuario -->
            <div class="profile-form-container">
                <h2>Perfil de Usuario</h2>
                <form action="/Controllers/UsuarioController.php" method="POST" class="profile-form">
                    <input type="hidden" name="action" value="update_cliente">

                    <div class="campo">
                        <label for="email">Correo Electrónico:</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($clienteData['cli_email']); ?>" required>
                    </div>

                    <div class="campo">
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($clienteData['cli_nombre']); ?>" required>
                    </div>

                    <div class="campo">
                        <label for="sNombre">Segundo Nombre:</label>
                        <input type="text" id="sNombre" name="sNombre" value="<?php echo htmlspecialchars($clienteData['cli_sNombre']); ?>">
                    </div>

                    <div class="campo">
                        <label for="apellido">Apellido:</label>
                        <input type="text" id="apellido" name="apellido" value="<?php echo htmlspecialchars($clienteData['cli_apelloidos']); ?>" required>
                    </div>

                    <div class="campo">
                        <label for="fNacimiento">Fecha de Nacimiento:</label>
                        <input type="date" id="fNacimiento" name="fNacimiento" value="<?php echo htmlspecialchars($clienteData['cli_fNacimiento']); ?>" readonly>
                    </div>

                    <div class="campo">
                        <label for="rfc">RFC:</label>
                        <input type="text" id="rfc" name="rfc" value="<?php echo htmlspecialchars($clienteData['cli_rfc']); ?>" required>
                    </div>

                    <button type="submit" class="btn-actualizar">Guardar Cambios</button>
                </form>
            </div>

            <!-- Formulario de Dirección -->
            <div class="address-form-container">
                <h2>Direcciones</h2>
                <form action="/Controllers/DireccionController.php" method="POST" class="address-form">
                    <input type="hidden" name="action" value="insert_direccion">
                    <!-- Campos de la dirección -->
                    <div class="campo">
                        <label for="estado">Estado:</label>
                        <input type="text" id="estado" name="estado" required>
                    </div>
                    <div class="campo">
                        <label for="ciudad">Ciudad:</label>
                        <input type="text" id="ciudad" name="ciudad" required>
                    </div>
                    <div class="campo">
                        <label for="cPostal">Código Postal:</label>
                        <input type="text" id="cPostal" name="cPostal" required>
                    </div>
                    <div class="campo">
                        <label for="direccion">Dirección:</label>
                        <input type="text" id="direccion" name="direccion" required>
                    </div>
                    <div class="campo">
                        <label for="descripcion">Descripción:</label>
                        <input type="text" id="descripcion" name="descripcion" required>
                    </div>
                    <button type="submit" class="btn-actualizar">Agregar Dirección</button>
                </form>
            </div>

            <div class="address-list-container">
                <!-- Lista de Direcciones -->
                <h3>Tus Direcciones</h3>
                <ul class="address-list">
                    <?php if(!empty($direcciones)): ?>
                        <?php foreach($direcciones as $direccion): ?>
                            <li class="address-list-item">
                                <?php echo htmlspecialchars($direccion['dic_direccion']); ?>
                                <?php echo htmlspecialchars($direccion['dir_ciudad']); ?>
                                <?php echo htmlspecialchars($direccion['dir_estado']); ?><br>
                                Codigo Postal: <?php echo htmlspecialchars($direccion['dir_cPostal']); ?> <br>
                                Descripción: <?php echo htmlspecialchars($direccion['dir_descrip']); ?>

                                <form action="/Controllers/DireccionController.php" method="POST" onsubmit="return confirm('¿Estas seguro de eliminaresta la direccion?');">
                                    <input type="hidden" name="action" value="delete_direccion">
                                    <input type="hidden" name="dir_descrip" value="<?php echo $direccion['dir_descrip']; ?>">
                                    <button type="submit" class="btn-eliminar">Eliminar</button>
                                </form>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li>No hay Direcciones para mostrar.</li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="purchases-list-container">
                <!-- Lista de Compras -->
                <h3>Tus Compras</h3>
                <ul class="purchases-list">
                    <?php if(!empty($compras)): ?>
                        <?php foreach($compras as $compra): ?>
                            <li class="purchases-list-item">
                                <strong>Compra ID:</strong> <?php echo htmlspecialchars($compra['comp_id']); ?><br>
                                <strong>Fecha del Pedido:</strong> <?php echo htmlspecialchars($compra['comp_fPedio']); ?><br>
                                <strong>Total:</strong> $<?php echo htmlspecialchars(number_format($compra['comp_total'], 2)); ?><br>
                                <strong>Estado:</strong> <?php echo htmlspecialchars($compra['comp_status']); ?><br>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li>No hay Compras para mostrar.</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

    </section>

    <?php include 'Includes/footer.php'; ?>
</body>
</html>