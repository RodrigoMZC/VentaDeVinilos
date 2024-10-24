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
    <?php include 'Backend/Views/Includes/header.php'; ?>

    <section id="home">
        <h2>Bienvenido</h2>
        <p>Descubre nuestra colección de vinilos clásicos y modernos. ¡Encuentra el vinilo perfecto para ti!</p>
        <!--<a href="productos.html" class="btn">Ver Catálogo Completo</a>-->
    </section>

    <section id="productos">
        <h2>Vinilos Destacados</h2>
        <br><br>
        <div class="producto">
            <img src="Images/JJSecretos.avif" alt="Secretos">
            <h3>Secretos <br> José José</h3>
            <p>Precio: $1250</p>
            <button class="btn-compra">Comprar</button>
        </div>

        <div class="producto">
            <img src="Images/ElDiablito(Caifanes).jpg" alt="El Diablito">
            <h3>El Diablito <br> Caifanes</h3>
            <p>Precio: $850</p>
            <button class="btn-compra">Comprar</button>
        </div>

        <div class="producto">
            <img src="Images/NochesDeSalos(Enjambre).jpg" alt="Noches De Salos">
            <h3>Noches De Salon<br> Enjambre</h3>
            <p>Precio: $1450</p>
            <button class="btn-compra">Comprar</button>
        </div>

        <div class="producto">
            <img src="Images/TheTouchOfYourLips(NKC).jpg" alt="The Touch Of Your Lips">
            <h3>The Touch Of Your Lips</h3>
            <p>Precio: $1500</p>
            <button class="btn-compra">Comprar</button>
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

    <?php include 'Backend/Views/Includes/footer.php'; ?>
</body>
</html>
