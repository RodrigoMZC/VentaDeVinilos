<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? null;

    if (!$action) {
        echo json_encode(['status' => 'error', 'message' => 'Acción no especificada.']);
        exit;
    }

    $id = $_POST['id'] ?? null;
    $name = $_POST['name'] ?? null;
    $price = $_POST['price'] ?? null;

    if ($action === 'add') {
        if (!$id || !$name || !$price) {
            echo json_encode(['status' => 'error', 'message' => 'Datos incompletos para agregar al carrito.']);
            exit;
        }

        $productExists = false;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['id'] == $id) {
                $productExists = true;
                if (isset($item['quantity'])) {
                    $item['quantity'] += 1;
                } else {
                    $item['quantity'] = 2; 
                }
                break;
            }
        }

        if (!$productExists) {
            $_SESSION['cart'][] = [
                'id' => $id,
                'name' => $name,
                'price' => $price,
                'quantity' => 1
            ];
        }

        echo json_encode(['status' => 'success', 'message' => 'Producto agregado al carrito.']);
        exit;

    } elseif ($action === 'remove') {
        if (!$id) {
            echo json_encode(['status' => 'error', 'message' => 'ID no especificado para eliminar.']);
            exit;
        }

        $productFound = false;
        foreach ($_SESSION['cart'] as $index => $item) {
            if ($item['id'] == $id) {
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
