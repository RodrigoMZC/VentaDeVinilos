<?php
    require_once __DIR__ . '/../Config/Connection.php';
    require_once __DIR__ . '/../Controllers/GeneroController.php';
    require_once __DIR__ . '/../Controllers/ArtistaController.php';
    require_once __DIR__ . '/../Controllers/ViniloController.php';
    require_once __DIR__ . '/../Controllers/CompraController.php';
    require_once __DIR__ . '/../Controllers/PDFController.php';

    $generosController = new GeneroController($conn);
    $generos = $generosController->obtenerGenero();

    $artistaController = new ArtistaController($conn);
    $artistas = $artistaController->obtenerArtista();

    $vinController = new ViniloController($conn);
    $productos = $vinController->obtenerVinilo();

    $compController = new CompraController($conn);
    $compras = $compController->obtenerCompras();

    if (isset($_GET['action']) && $_GET['action'] === 'generar_pdf' && isset($_GET['comp_id'])) {
        $pdfController = new PDFController($conn);
        $pdfController->generarPDF($_GET['comp_id']);
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/styles.css">
    <script defer src="../Scripts/Dashboard.js"></script>
    <title>Document</title>
</head>
<body>
    <?php Include 'Includes/header.php'; ?>

    <section class="dashboard">
        <div class="btns-add-dasboard-container">
            <button id="btn-add-artista" class="btn-add-dashboard">Agregar Artista</button>
            <button id="btn-add-vinilo" class="btn-add-dashboard">Agregar Vinilo</button>
        </div>

        <div class="tabs-dashboards-container">
            <!-- Tabla de productos -->
            <h2>Vinilos Disponibles</h2>
            <table class="table-vinilos" border="1">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Artista</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($productos): ?>
                        <?php foreach ($productos as $producto): ?>
                            <tr>
                                <td><?php echo $producto['vin_nombre']; ?></td>
                                <td><?php echo $producto['art_nombre']; ?></td>
                                <td><?php echo $producto['vin_precio']; ?></td>
                                <td><?php echo $producto['vin_stok']; ?></td>
                                <td>
                                    <button class="btn-dashboard-edit">Editar</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="6">No hay productos disponibles.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <!-- Tabla de compras -->
            <h2>Compras Realizadas</h2>
            <table class="table-ventas" border="1">
                <thead>
                    <tr>
                        <th>Estado</th>
                        <th>Fecha Pedido</th>
                        <th>Fecha Entrega</th>
                        <th>Total</th>
                        <th>Correo Cliente</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($compras): ?>
                        <?php foreach ($compras as $compra): ?>
                            <tr>
                                <td><?php echo $compra['comp_status']; ?></td>
                                <td><?php echo $compra['comp_fPedio']; ?></td>
                                <td><?php echo $compra['comp_fEntrega']; ?></td>
                                <td><?php echo $compra['comp_total']; ?></td>
                                <td><?php echo $compra['cli_email']; ?></td>
                                <td>

                                <?php if ($compra['comp_status'] !== 'Entregado'): ?>
                                    <form action="Dashboard.php" method="POST" onsubmit="return confirm('¿Estás seguro de marcar esta compra como entregada?')">
                                        <input type="hidden" name="comp_id" value="<?php echo $compra['comp_id']; ?>">
                                        <input type="hidden" name="action" value="entregar">
                                        <button type="submit" class="btn-dashboard-delivered">Entregar</button>
                                    </form>
                                    <?php else: ?>
                                        <button class="btn-dashboard-delivered" disabled>Entregado</button>
                                <?php endif; ?>

                                <!--<form action="Dashboard.php" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta compra?')">
                                    <input type="hidden" name="comp_id" value="<?php echo $compra['comp_id']; ?>">
                                    <input type="hidden" name="action" value="delete">
                                    <button type="submit" class="btn-dashboard-delete">Eliminar</button>
                                </form>-->
                                <form action="Dashboard.php" method="GET" target="_blank">
                                    <input type="hidden" name="comp_id" value="<?php echo $compra['comp_id']; ?>">
                                    <input type="hidden" name="action" value="generar_pdf">
                                    <button type="submit" class="btn-dashboard-pdf">PDF</button>
                                </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="6">No hay compras disponibles.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>

        </div>

    </section>

    <div id="add-artista-modal" class="modal-add-dashboard">
        <div class="modal-add-dasboard-content">
            <span class="close-modal">&times;</span>
            <h2>Agregar Artista</h2>

            <form id="artista-form" method="POST" action="/Controllers/ArtistaController.php">
                <label for="artista-name">Nombre del Artista</label>
                <input class="dashboard-imputs" type="text" id="artista-name" name="art_nombre" required>

                <label for="artista-desc">Descripción</label>
                <textarea class="dashboard-imputs" id="artista-desc" name="art_desc"></textarea>

                <label for="artista-fnac">Fecha de Nacimiento</label>
                <input class="dashboard-imputs" type="number" id="artista-fnac" name="art_fNacim" min="1900" max="2024" required>

                <label for="artista-lugNaci">Lugar de Nacimiento</label>
                <input class="dashboard-imputs" type="text" id="artista-lugNaci" name="art_lugNaci">

                <label for="artista-imgURL">Imagen URL</label>
                <input class="dashboard-imputs" type="text" id="artista-imgURL" name="art_imgURL">

                <label for="artista-generos">Géneros</label>
                <div id="generos-container">
                    <select class="dashboard-imputs" name="art_generos[]" id="artista-generos" class="artista-generos" required>
                        <?php foreach ($generos as $genero): ?>
                            <option value="<?php echo $genero['gen_gen']; ?>">
                                <?php echo htmlspecialchars($genero['gen_gen']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button class="btn-dasboard-modals" type="submit">Guardar Artista</button>
            </form>
        </div>
    </div>

    <div id="add-vinilo-modal" class="modal-add-dashboard">
        <div class="modal-add-dasboard-content">
            <span class="close-modal">&times;</span>
            <h2>Agregar Vinilo</h2>

            <form id="vinilo-form" method="POST" action="/Controllers/ViniloController.php">
                <input type="hidden" name="action" value="insert_vinilo">
                <label for="vinilo-name">Nombre del Vinilo</label>
                <input class="dashboard-imputs" type="text" id="vinilo-name" name="vin_nombre" required>

                <label for="vinilo-fLanz">Fecha de Lanzamiento</label>
                <input class="dashboard-imputs" type="date" id="vinilo-fLanz" name="vin_fechaLanz" required>

                <label for="vinilo-stock">Stock</label>
                <input class="dashboard-imputs" type="number" id="vinilo-stock" name="vin_stock" requiered>

                <label for="vinilo-imgURL">Imagen URL</label>
                <input class="dashboard-imputs" type="text" id="vinilo-imgURL" name="vin_imgURL">

                <label for="vinilo-artista">Artista</label>
                <div id="artistas-container">
                    <select class="dashboard-imputs" name="vin_artista" id="vinilo-artista" class="vinilo-artistas" required>
                        <?php foreach ($artistas as $artista): ?>
                            <option value="<?php echo  $artista['art_nombre']; ?>">
                                <?php echo htmlspecialchars($artista['art_nombre']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <label for="vinilo-precio">Precio</label>
                <input class="dashboard-imputs" type="number" id="vinilo-precio" name="vin_precio" required>

                <label for="vinilo-generos">Géneros</label>
                <div id="generos-container-vin">
                    <select class="dashboard-imputs" name="vin_generos[]" id="artista-generos" class="artista-generos" required>
                            <?php foreach ($generos as $genero): ?>
                                <option value="<?php echo $genero['gen_gen']; ?>">
                                    <?php echo htmlspecialchars($genero['gen_gen']); ?>
                                </option>
                            <?php endforeach; ?>
                    </select>
                </div>

                <!--<button type="button" id="add-genero-btn">Agregar otro género</button>-->
                <button class="btn-dasboard-modals" type="submit">Guardar Vinilo</button>
            </form>
        </div>
    </div>

    <div id="aupdate-vinilo-modal" class="modal-add-dashboard">
        <div class="modal-add-dasboard-content">
            <span class="close-modal">&times;</span>
            <h2>Modificar Vinilo</h2>

            <form id="vinilo-update-form" method="POST" action="/Controllers/ViniloController.php">
                <input type="hidden" name="action" value="update_vinilo">
                <input type="hidden" id="vin-id" name="vin_id">

                <label for="vinilo-name">Nombre del Vinilo</label>
                <input class="dashboard-imputs" type="text" id="vinilo-name" name="vin_nombre" required>

                <label for="vinilo-fLanz">Fecha de Lanzamiento</label>
                <input class="dashboard-imputs" type="date" id="vinilo-fLanz" name="vin_fechaLanz" required>

                <label for="vinilo-stock">Stock</label>
                <input class="dashboard-imputs" type="number" id="vinilo-stock" name="vin_stock" requiered>

                <label for="vinilo-imgURL">Imagen URL</label>
                <input class="dashboard-imputs" type="text" id="vinilo-imgURL" name="vin_imgURL">

                <label for="vinilo-artista">Artista</label>
                <div id="artistas-container">
                    <select class="dashboard-imputs" name="vin_artista" id="vinilo-artista" class="vinilo-artistas" required>
                        <?php foreach ($artistas as $artista): ?>
                            <option value="<?php echo  $artista['art_nombre']; ?>">
                                <?php echo htmlspecialchars($artista['art_nombre']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <label for="vinilo-precio">Precio</label>
                <input class="dashboard-imputs" type="number" id="vinilo-precio" name="vin_precio" required>

                <label for="vinilo-generos">Géneros</label>
                <div id="generos-container-vin">
                    <select class="dashboard-imputs" name="vin_generos[]" id="artista-generos" class="artista-generos" required>
                            <?php foreach ($generos as $genero): ?>
                                <option value="<?php echo $genero['gen_gen']; ?>">
                                    <?php echo htmlspecialchars($genero['gen_gen']); ?>
                                </option>
                            <?php endforeach; ?>
                    </select>
                </div>

                <!--<button type="button" id="add-genero-btn">Agregar otro género</button>-->
                <button class="btn-dasboard-modals" type="submit">Guardar Vinilo</button>
            </form>
        </div>
    </div>


    <?php Include 'Includes/footer.php';?>
</body>
</html>