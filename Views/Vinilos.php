<?php
    require_once __DIR__ . '/../Config/Connection.php';
    require_once __DIR__ . '/../Controllers/ViniloController.php';

    $viniloController = new ViniloController($conn);
    $vinilos = $viniloController->obtenerVinilo();

    if (!$vinilos) {
        echo "Error: No se pudo recuperar la información de los vinilos.";
        $vinilos = [];
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Catálogo completo de vinilos disponibles en nuestra tienda.">
    <title>Catálogo</title>
    <link rel="stylesheet" href="Styles/styles.css">
</head>
<body>
    <?php include 'Includes/header.php'; ?>
    
    <section class="catalogo">
        <h2>Catalogo</h2>
        <br>
        <div class="producto">
            <?php if (!empty($vinilos)): ?>
                <?php foreach ($vinilos as $vinilo): ?>
                    <div class="vinilo-item">
                        <img src="<?php echo htmlspecialchars($vinilo['vin_imgURL']);?>" alt="<?php echo htmlspecialchars($vinilo['vin_nombre']);?>">
                        <h3><?php echo htmlspecialchars($vinilo['vin_nombre']); ?></h3>
                        <h3><?php echo htmlspecialchars($vinilo['art_nombre']); ?></h3>
                        <p>Precio: $<?php echo htmlspecialchars($vinilo['vin_precio']); ?></p>
                        <button class="btn-compra" onclick="addToCart(<?php echo htmlspecialchars($vinilo['vin_id']); ?>)">Agregar</button>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <span>No se encontraron vinilos para mostrar.</span>
            <?php endif; ?>
        </div>
    </section>

    <?php include 'Includes/footer.php'; ?>
</body>
</html>
