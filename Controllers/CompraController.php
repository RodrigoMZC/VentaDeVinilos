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

        public function obtenerCompras() {
            return $this->compra->obtenerCompras();
        }

        public function eliminarCompra($comp_id) {
            return $this->compra->eliminarCompra($comp_id);
        }

        public function actualizarEstadoEntrega($comp_id) {
            return $this->compra->actualizarEstadoEntrega($comp_id);
        }

        public function obtenerComprasCliente($cli_id) {
            return $this->compra->obtenerComprasCliente($cli_id);
        }
        
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $compraController = new CompraController($conn);

        // Verificar la acción es 'check'
        if ($_POST['action'] === 'check') {
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
    
            $response = $compraController->realizarCompra($cli_id, $direccion_id, $carrito);
            echo json_encode($response);
            exit;
        }

        // Verificar si la acción es 'entregar'
        if ($_POST['action'] === 'entregar') {
            if (isset($_POST['comp_id'])) {
                $comp_id = $_POST['comp_id'];
                // Llamar al método para actualizar el estado de entrega
                $response = $compraController->actualizarEstadoEntrega($comp_id);
                echo json_encode($response);
                exit;
            } else {
                echo json_encode(['status' => 'error', 'message' => 'ID de compra no proporcionado.']);
                exit;
            }
        }
    }

?>