<?php
    require_once __DIR__ . '/../Config/Connection.php';
    require_once __DIR__ . '/../Models/Vinilo.php';

    class ViniloController {
        private $vinilo;

        public function __construct($conn) {
            $this->vinilo = new Vinilo($conn);
        }

        public function obtenerVinilo() {
            try {
                return $this->vinilo->obtenerVinilo();
            } catch (Exception $e) {
                echo "Error al obtener vinilos: " . $e->getMessage();
                return false;
            }
        }

        public function agregarVinilo($data) {
            try {
                if (empty($data['vin_nombre']) || empty($data['vin_fechaLanz']) || empty($data['vin_stock']) ||
                    empty($data['vin_imgURL']) || empty($data['vin_artista']) || empty($data['vin_precio']) || 
                    empty($data['vin_generos'])) {
                    throw new Exception("Todos los campos son obligatorios.");
                }
        
                return $this->vinilo->agregarVinilo($data);
            } catch (Exception $e) {
                throw new Exception("Error al agregar vinilo: " . $e->getMessage());
            }
        }

        public function obtenerViniloPorId($id) {
            try {
                $vinilos = $this->vinilo->obtenerVinilo();
                $vinSelec = null;

                foreach ($vinilos as $vinilo) {
                    if ($vinilo['vin_id'] == $id) {
                        $vinSelec = $vinilo;
                        break;
                    }
                }

                if ($vinSelec) {
                    if (session_status() == PHP_SESSION_NONE) {
                        session_start();
                    }

                    if (!isset($_SESSION['cart'])) {
                        $_SESSION['cart'] = [];
                    }
                    // Agregar el vinilo al carrito
                    $_SESSION['cart'][] = $vinSelec;

                    return true;
                }
            } catch (Exception $e) {
                echo "Error al obtener el vililo especificado: " . $e->getMessage();
                return false;
            } 
        }

        public function actualizarVinilo($data) {
            try {
                if (empty($data['vin_id']) || empty($data['vin_nombre']) || empty($data['vin_fechaLanz']) || 
                    empty($data['vin_stock']) || empty($data['vin_imgURL']) || empty($data['vin_precio'])) {
                    throw new Exception("Todos los campos son obligatorios.");
                }
    
                return $this->vinilo->actualizarVinilo($data);
            } catch (Exception $e) {
                throw new Exception("Error al actualizar vinilo: " . $e->getMessage());
            }
        }

        public function agregarAlCarrito($id) {
            try {
                $vinilos = $this->vinilo->obtenerVinilo();
                $viniloSeleccionado = null;
        
                foreach ($vinilos as $vinilo) {
                    if ($vinilo['vin_id'] == $id) {
                        $viniloSeleccionado = $vinilo;
                        break;
                    }
                }
        
                if ($viniloSeleccionado) {
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
        
                    if (!isset($_SESSION['cart'])) {
                        $_SESSION['cart'] = [];
                    }
        
                    $_SESSION['cart'][] = $viniloSeleccionado;
        
                    return true;
                } else {
                    return false;
                }
            } catch (Exception $e) {
                echo "Error al agregar al carrito: " . $e->getMessage();
                return false;
            }
        }        
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        session_start();
    
        $vinController = new ViniloController($conn);
    
        if (isset($_POST['action'])) {
            try {
                switch ($_POST['action']) {
                    case 'insert_vinilo':
                        $data = [
                            'vin_nombre' => $_POST['vin_nombre'],
                            'vin_fechaLanz' => $_POST['vin_fechaLanz'],
                            'vin_stock' => $_POST['vin_stock'],
                            'vin_imgURL' => $_POST['vin_imgURL'],
                            'vin_artista' => $_POST['vin_artista'],
                            'vin_precio' => $_POST['vin_precio'],
                            'vin_generos' => isset($_POST['vin_generos']) ? $_POST['vin_generos'] : []
                        ];
                        $vinController->agregarVinilo($data);
                        echo json_encode(['success' => true, 'message' => 'Vinilo agregado correctamente']);
                        break;
    
                    case 'update_vinilo':
                        $data = [
                            'vin_id' => $_POST['vin_id'],
                            'vin_nombre' => $_POST['vin_nombre'],
                            'vin_fechaLanz' => $_POST['vin_fechaLanz'],
                            'vin_stock' => $_POST['vin_stock'],
                            'vin_imgURL' => $_POST['vin_imgURL'],
                            'vin_precio' => $_POST['vin_precio']
                        ];
                        $vinController->actualizarVinilo($data);
                        echo json_encode(['success' => true, 'message' => 'Vinilo actualizado correctamente']);
                        break;
    
                    case 'add_to_cart':
                        $postData = json_decode(file_get_contents('php://input'), true);
    
                        if (isset($postData['vin_id'])) {
                            $result = $vinController->agregarAlCarrito($postData['vin_id']);
                            if ($result) {
                                echo json_encode(['success' => true, 'message' => 'Producto agregado al carrito']);
                            } else {
                                echo json_encode(['success' => false, 'message' => 'Error al agregar el producto al carrito']);
                            }
                        } else {
                            echo json_encode(['success' => false, 'message' => 'ID de vinilo no proporcionado']);
                        }
                        break;
    
                    default:
                        echo json_encode(['success' => false, 'message' => 'Acción no reconocida']);
                        break;
                }
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            }
        }
    }
?>