<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar que la acción esté definida
    $action = $_POST['action'] ?? null;

    if (!$action) {
        echo json_encode(['status' => 'error', 'message' => 'Acción no especificada.']);
        exit;
    }

    // Obtener el ID del producto, nombre y precio si están presentes
    $id = $_POST['id'] ?? null;
    $name = $_POST['name'] ?? null;
    $price = $_POST['price'] ?? null;

    if ($action === 'add') {
        // Validar que todos los campos necesarios estén presentes
        if (!$id || !$name || !$price) {
            echo json_encode(['status' => 'error', 'message' => 'Datos incompletos para agregar al carrito.']);
            exit;
        }

        // Verificar si el producto ya está en el carrito
        $productExists = false;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['id'] == $id) { // Si el producto ya existe
                $productExists = true;
                if (isset($item['quantity'])) {
                    $item['quantity'] += 1; // Incrementar la cantidad
                } else {
                    $item['quantity'] = 2; // Inicializar cantidad si no existe
                }
                break;
            }
        }

        // Si el producto no existe, agregarlo al carrito
        if (!$productExists) {
            $_SESSION['cart'][] = [
                'id' => $id,
                'name' => $name,
                'price' => $price,
                'quantity' => 1 // Establecer cantidad inicial
            ];
        }

        echo json_encode(['status' => 'success', 'message' => 'Producto agregado al carrito.']);
        exit;

    } elseif ($action === 'remove') {
        // Validar que el ID esté presente para eliminar
        if (!$id) {
            echo json_encode(['status' => 'error', 'message' => 'ID no especificado para eliminar.']);
            exit;
        }

        // Buscar y eliminar el producto en el carrito
        $productFound = false;
        foreach ($_SESSION['cart'] as $index => $item) {
            if ($item['id'] == $id) { // Comparación flexible para evitar errores de tipo
                unset($_SESSION['cart'][$index]);
                $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindexar el array
                $productFound = true;
                echo json_encode(['status' => 'success', 'message' => 'Producto eliminado del carrito.']);
                exit;
            }
        }

        // Si no se encuentra el producto
        if (!$productFound) {
            echo json_encode(['status' => 'error', 'message' => 'Producto no encontrado en el carrito.']);
        }
    } else {
        // Acción no válida
        echo json_encode(['status' => 'error', 'message' => 'Acción no válida.']);
        exit;
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método no permitido.']);
}
