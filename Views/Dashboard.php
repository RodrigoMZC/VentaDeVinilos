<?php
    require_once __DIR__ . '/../Config/Connection.php';
    require_once __DIR__ . '/../Controllers/GeneroController.php';

    $generosController = new GeneroController($conn);
    $generos = $generosController->obtenerGenero();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link rel="stylesheet" href="styles/styles.css">-->
    <script defer src="../Scripts/Dashboard.js"></script>
    <title>Document</title>
</head>
<body>
    <?php Include 'Includes/header.php'; ?>

    <section class="dashboard">
        <div class="artista-dashboard-container">
            <button id="btn-add-artista" class="btn-add-artista">Agregar Artista</button>
        </div>

    </section>

    <div id="add-artista-modal" class="modal-add-artista">
        <div class="modal-artista-content">
            <span class="close-modal">&times;</span>
            <h2>Agregar Artista</h2>

            <form id="artista-form">
                <label for="artista-name">Nombre del Artista</label>
                <input type="text" id="artista-name" name="artista-name" required>

                <label for="artista-desc">Descripción</label>
                <textarea id="artista-desc" name="artista-desc"></textarea>

                <label for="artista-fnac">Fecha de Nacimiento</label>
                <input type="date" id="artista-fnac" name="artista-fnac" required>

                <label for="artista-lugNaci">Lugar de Nacimiento</label>
                <input type="text" id="artista-lugNaci" name="artista-lugNaci">

                <label for="artista-imgURL">Imagen URL</label>
                <input type="text" id="artista-imgURL" name="artista-imgURL">

                <label for="artista-generos">Géneros</label>
                <div id="generos-container">
                    <select name="generos[]" id="artista-generos" class="artista-generos" required>
                        <option value="">Selecciona un género</option>
                            <?php foreach ($generos as $genero): ?>
                                <option value="<?php echo $genero['gen_gen']; ?>">
                                    <?php echo htmlspecialchars($genero['gen_gen']); ?>
                                </option>
                            <?php endforeach; ?>
                            <option value="">No hay géneros disponibles</option>
                    </select>
                </div>

                <!--<button type="button" id="add-genero-btn">Agregar otro género</button>-->
                <button type="submit">Guardar Artista</button>
            </form>
        </div>
    </div>


    <?php Include 'Includes/footer.php';?>
</body>
</html>