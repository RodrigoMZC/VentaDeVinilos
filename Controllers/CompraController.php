<?php
    require_once __DIR__ . '/../Config/Connection.php';
    require_once __DIR__ . '/../Models/Direccion.php';
    require_once __DIR__ . '/../Models/Compra.php';

    class CompraController {
        private $compra;

        public function __construct($conn) {
            $this->compra = new Compra($conn);
        }

        public function realizarCompra($cli_id, $direccion_id, $carrito) {
            if (empty($carrito)) {
                return ['success' => false, 'message' => 'El carrito está vacío.'];
            }
    
            if (!$direccion_id) {
                return ['success' => false, 'message' => 'No se ha seleccionado una dirección.'];
            }
    
            return $this->compra->registrarCompra($cli_id, $direccion_id, $carrito);
        }
    }

    // Manejo de solicitudes POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
        session_start();
    
        if ($_POST['action'] === 'check') {
            // Verificar si el usuario ha iniciado sesión
            if (!isset($_SESSION['cli_id'])) {
                echo json_encode(['success' => false, 'redirect' => '/Views/Login.php']);
                exit;
            }

            $cli_id = $_SESSION['cli_id'];
            $direccion = new Direccion($conn);
            $direcciones = $direccion->obtenerDirecciones($cli_id);
            
            if (empty($direcciones)) {
                echo json_encode(['success' => true, 'redirect' => '/Views/Perfil.php']);
                exit;
            }

            echo json_encode(['success' => true, 'direcciones' => $direcciones]);
            exit;
        }
    
        if ($_POST['action'] === 'create') {
            $cli_id = $_SESSION['cli_id'];
            $direccion_id = $_POST['direccion'] ?? null;
            $carrito = $_SESSION['cart'];
    
            $compraController = new CompraController($conn);
            $response = $compraController->realizarCompra($cli_id, $direccion_id, $carrito);
    
            echo json_encode($response);
            exit;
        }
    }

?>