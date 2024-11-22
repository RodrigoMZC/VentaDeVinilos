<?php
    require_once __DIR__ . '/Config/Connection.php';
    require_once __DIR__ . '/Controllers/ViniloController.php';

    $viniloController = new ViniloController($conn);
    $vinilos = $viniloController->obtenerVinilo();

    if (!$vinilos) {
        echo "Error: No se pudo recuperar la información de los vinilos.";
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Tienda de vinilos - Los mejores discos de vinilo al mejor precio.">
    <title>Tienda de Vinilos | Home</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <?php include 'Views/Includes/header.php'; ?>

    <section class="productos">
        <!-- Carrusel de tarjetas-->
        <h2>Destacados</h2>
        <br><br>
        <div class="producto">
            <?php if (!empty($vinilos)): ; ?>
                <?php for ($i = 0; $i < 4; $i++): ?>
                    <div class="vinilo-item">
                        <img src="<?php echo htmlspecialchars($vinilos[$i]['vin_imgURL']);?>" alt="<?php echo htmlspecialchars($vinilo[$i]['vin_nombre']);?>">
                        <h3><?php echo htmlspecialchars($vinilos[$i]['vin_nombre']); ?></h3>
                        <h3><?php echo htmlspecialchars($vinilos[$i]['art_nombre']); ?></h3>
                        <p>Precio: $<?php echo htmlspecialchars($vinilos[$i]['vin_precio']); ?></p>
                        <button class="btn-compra">Agregar</button>
                    </div>
                <?php endfor; ?>
              
            <?php else: ?>
                <span>No se encontraron vinilos para mostrar.</span>
            <?php endif; ?>
        </div>
        <!--<a href="productos.html" class="btn">Ver Más Vinilos</a>-->
    </section>

    <!--<section id="ofertas">
        <h2>Ofertas Especiales</h2>
        <p>¡Aprovecha nuestras ofertas en vinilos seleccionados!</p>
    </section>-->

    <section id="contacto">
        <h2>Contacto</h2>
        <form action="rdgmcz14@gmail.com" method="post" enctype="text/plain" class="formulario">
            <!--<fieldset>-->
            <legend>Envíanos un mensaje</legend>

            <div class="contenedor-campos">
                <div class="campo">
                <label for="nombre">Nombre:</label>
                <input class="input-text" type="text" name="nombre" placeholder="Tu Nombre">
                </div>

                <div class="campo">
                <label for="email">Email:</label>
                <input class="input-text" type="email" name="email" placeholder="Tu Email">
                </div>

                <div class="campo-textarea">
                <label for="mensaje">Mensaje:</label>
                <textarea class="input-text" name="mensaje"></textarea>
                </div>
            </div>
            <button class="btn-compra" type="submit">Enviar</button>
        </form>
    </section>

    <?php include 'Views/Includes/footer.php'; ?>
</body>
</html>
