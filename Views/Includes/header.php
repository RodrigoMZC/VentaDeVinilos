<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/styles.css">
    <script src="/Scripts/Carrito.js"></script>
    <script defer src="/Scripts/Compra.js"></script>
    <title>Document</title>
</head>
<body>
    <header class="header">
        <nav class="main-nav">
            <div class="div-main-nav">
                <div class="right-nav">
                    <div class="logo">
                        <a class="mian-logo" href="../../index.php">
                            <!--<img src="images/logo.png" alt="LOGO" class="logo">-->
                            LOGO
                        </a>
                    </div>

                    <div class="right-nav-side-logo-container">
                        <div class="right-nav-side-logo">
                            <nav class="second-nav">
                                <ul class="ul-rigth-nav">
                                    <li class="right-nav-item"> 
                                        <a class="a-nav-item" href="/Views/Vinilos.php"><span>Vinilos</span></a>
                                    </li>
                                    <li class="right-nav-item"> 
                                        <a class="a-nav-item" href="/Views/Artistas.php"><span>Artistas</span></a>
                                    </li>
                                    <li class="right-nav-item"> 
                                        <a class="a-nav-item" href="Categorias.html"><span>Categorias</span></a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="left-nav">
                    <ul class="ul-left-nav">

                        <li class="left-nav-item"> 
                            <?php if (isset($_SESSION['usr_usuario']) && $_SESSION['usr_usuario'] === 'rodrigo'): ?>
                                <a class="a-nav-item" href="/Views/Dashboard.php">
                                    <span>Dashboard</span>
                                </a>
                            <?php endif; ?>
                        </li>

                        <li class="left-nav-item"> 
                            <button class="search-button-header" type="button">
                                <span class="search-icon">
                                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                                        <path fill-rule="evenodd" d="M14.391 15.452a7 7 0 1 1 1.06-1.06l5.86 5.858-1.061 1.06-5.859-5.858ZM15.5 10a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0Z"></path>
                                    </svg>
                                </span>
                            </button>
                        </li>
                        
                        <!-- Verificar si el usuario ha iniciado sesión -->
                    <?php if (isset($_SESSION['usr_usuario'])): ?>
                    <!-- Si el usuario ha iniciado sesion mostrar su nombre y un botón para cerrar sesión -->
                        <li class="left-nav-item">
                            <div class="user-info-container">
                                <a class="a-nav-item" href="/Views/Perfil.php">
                                    <span class="person-icon" style="margin-right: 5px;">
                                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                                            <path fill-rule="evenodd" d="M16.75 6.25a4.75 4.75 0 1 1-9.5 0 4.75 4.75 0 0 1 9.5 0Zm-1.5 0a3.25 3.25 0 1 1-6.5 0 3.25 3.25 0 0 1 6.5 0Z M12 12.5c-2.397 0-4.827.238-6.684.991-.935.38-1.767.907-2.367 1.64-.611.746-.949 1.665-.949 2.752V20h1.5v-2.117c0-.753.226-1.334.61-1.802.393-.48.986-.881 1.77-1.2C7.464 14.238 9.66 14 12 14c2.348 0 4.542.214 6.124.845.783.312 1.373.71 1.765 1.192.382.47.61 1.063.61 1.847L20.5 20H22v-2.116c0-1.107-.335-2.04-.947-2.793-.602-.74-1.436-1.266-2.374-1.64-1.858-.74-4.29-.951-6.679-.951Z"></path>
                                        </svg>
                                    </span>
                                    <span class="user-name"><?php echo htmlspecialchars($_SESSION['usr_usuario']); ?></span>
                                </a>
                            </div>
                        </li>

                        <li class="left-nav-item">
                            <div class="user-logout-container">
                                <!-- Formulario para cerrar sesion -->
                                <form action="/Views/Includes/Logout.php" method="POST">
                                    <button class="person-button-header" type="submit" action="/Views/Includes/Logout.php" method="POST">
                                    <span class="person-icon" style="margin-right: 5px;">
                                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                                            <path fill-rule="evenodd" d="M16.75 6.25a4.75 4.75 0 1 1-9.5 0 4.75 4.75 0 0 1 9.5 0Zm-1.5 0a3.25 3.25 0 1 1-6.5 0 3.25 3.25 0 0 1 6.5 0Z M12 12.5c-2.397 0-4.827.238-6.684.991-.935.38-1.767.907-2.367 1.64-.611.746-.949 1.665-.949 2.752V20h1.5v-2.117c0-.753.226-1.334.61-1.802.393-.48.986-.881 1.77-1.2C7.464 14.238 9.66 14 12 14c2.348 0 4.542.214 6.124.845.783.312 1.373.71 1.765 1.192.382.47.61 1.063.61 1.847L20.5 20H22v-2.116c0-1.107-.335-2.04-.947-2.793-.602-.74-1.436-1.266-2.374-1.64-1.858-.74-4.29-.951-6.679-.951Z"></path>
                                        </svg>
                                    </span>
                                    <span>Cerrar Sesión</span>
                                    </button>
                                </form>
                            </div>
                        </li>

                    <?php else: ?>
                        <!-- Si el usuario NO ha iniciado sesion mostrar el botón de "Iniciar sesión" -->
                        <li class="left-nav-item">
                            <a target="_self" rel="noreferrer" class="person-button-header" id="nav-person" label="LogIn" href="../Views/Login.php">
                                    <span class="person-icon">
                                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                                            <path fill-rule="evenodd" d="M16.75 6.25a4.75 4.75 0 1 1-9.5 0 4.75 4.75 0 0 1 9.5 0Zm-1.5 0a3.25 3.25 0 1 1-6.5 0 3.25 3.25 0 0 1 6.5 0Z M12 12.5c-2.397 0-4.827.238-6.684.991-.935.38-1.767.907-2.367 1.64-.611.746-.949 1.665-.949 2.752V20h1.5v-2.117c0-.753.226-1.334.61-1.802.393-.48.986-.881 1.77-1.2C7.464 14.238 9.66 14 12 14c2.348 0 4.542.214 6.124.845.783.312 1.373.71 1.765 1.192.382.47.61 1.063.61 1.847L20.5 20H22v-2.116c0-1.107-.335-2.04-.947-2.793-.602-.74-1.436-1.266-2.374-1.64-1.858-.74-4.29-.951-6.679-.951Z"></path>
                                        </svg>
                                </span>
                            </a>
                        </li>
                    <?php endif; ?>

                        <li class="left-nav-item">
                            <a target="_self" rel="noreferrer" class="favorite-button-header" id="nav-favourites" label="Favoritos" href="Favoritos.html">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                                    <path d="M13.035 4.54a5.25 5.25 0 1 1 7.425 7.424L12 20.424l-8.46-8.459a5.25 5.25 0 0 1 7.424-7.425l1.037 1.034 1.034-1.034ZM19.4 5.6a3.75 3.75 0 0 0-5.303 0l-2.093 2.094-2.098-2.092a3.75 3.75 0 0 0-5.304 5.303l7.4 7.397 7.398-7.398a3.75 3.75 0 0 0 0-5.304Z"></path>
                                </svg>
                                <!--<span class="span-facorite-button-header">Favoritos</span>-->
                            </a>
                        </li>

                        <li class="left-nav-item">
                            <div class="bag-button-header-container">
                                <button id="cart-button" class="bag-button-header" type="button">
                                    <span class="bag-icon">
                                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                                            <path fill-rule="evenodd" d="M12 2c-1.17 0-2.436.262-3.437.853-1.02.601-1.813 1.586-1.813 2.97v1.178H5.126L2 7.003V21h20V7h-4.75V5.872c0-1.4-.783-2.399-1.806-3.011C14.442 2.26 13.174 2 12 2Zm3.75 6.5V12h1.5V8.5h3.25v11h-17V8.502h3.25V12h1.5V8.5h7.5Zm0-1.5V5.872c0-.75-.389-1.313-1.076-1.724-.71-.424-1.692-.648-2.674-.648-.977 0-1.961.224-2.674.644-.694.41-1.076.962-1.076 1.679v1.178L15.75 7Z"></path>
                                        </svg>
                                    </span>
                                </button>
                            </div>
                        </li>
                        <!-- Carrito de Compras -->
                        <div id="cart-sidebar" class="cart-sidebar">
                            <h2>Carrito de Compras</h2>
                            <ul id="cart-items">
                            <!-- Los productos se agregarán dinámicamente aquí -->
                            <?php if (!empty($_SESSION['cart'])): ?>
                                <?php foreach ($_SESSION['cart'] as $item): ?>
                                    <li>
                                        <?php echo htmlspecialchars($item['name']) . ' - $' . htmlspecialchars($item['price']); ?>
                                        <button class="remove-item" data-id="<?php echo $item['id']; ?>">Eliminar</button>
                                    </li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li>Tu carrito está vacío.</li>
                            <?php endif; ?>
                            </ul>

                            <?php if (!empty($_SESSION['cart'])): ?>    
                                <button id="purchase-button" class="purchase-button">Realizar Compra</button>
                            <?php endif; ?>
                            <button id="close-sidebar" class="close-sidebar">Cerrar</button>
                        </div>
                            <!-- Modal para Confirmar Compra -->
                        <div id="purchase-modal" class="purchase-modal" style="display: none;">
                            <div class="modal-content">
                                <span id="close-modal" class="close-modal">&times;</span>
                                <h2>Confirmar Compra</h2>
                                <h3>Productos:</h3>
                                <ul id="modal-cart-items">
                                    <?php foreach ($_SESSION['cart'] as $item): ?>
                                        <li>
                                            <?php echo htmlspecialchars($item['name']) . ' - $' . htmlspecialchars($item['price']); ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                                <p>Total: $    
                                    <?php echo array_reduce($_SESSION['cart'], fn($total, $item) => $total + $item['price'], 0); ?>
                                </p>

                                <h3>Selecciona una Dirección:</h3>
                                <?php if (!empty($direcciones)): ?>
                                    <ul>
                                        <?php foreach ($direcciones as $direccion): ?>
                                        <li>
                                            <input type="radio" name="direccion" value="<?php echo $direccion['dir_id']; ?>" required>
                                            <?php echo htmlspecialchars($direccion['dic_direccion']) . ', ' . htmlspecialchars($direccion['dir_ciudad']) . ', ' . htmlspecialchars($direccion['dir_estado']); ?>
                                        </li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <!--<button id="confirm-purchase" class="confirm-purchase">Confirmar Compra</button>-->
                                    <form id="confirm-purchase" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
                                        <input type="hidden" name="cmd" value="_s-xclick" />
                                        <input type="hidden" name="hosted_button_id" value="9VYY26FH4N8T4" />
                                        <input type="hidden" name="currency_code" value="MXN" />
                                        <input type="image" src="https://www.paypalobjects.com/es_XC/MX/i/btn/btn_buynowCC_LG.gif" 
                                               border="0" name="submit" title="PayPal es una forma segura y fácil de pagar en línea." 
                                               alt="Comprar ahora" />
                                    </form>
                                    <?php else: ?>
                                        <p>No tienes direcciones guardadas. <a href="/Views/Perfil.php">Agrega una dirección aquí</a>.</p>
                                <?php endif; ?>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
</body>
</html>