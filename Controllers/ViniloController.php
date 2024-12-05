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
                if ($this->vinilo->agregarVinilo($data)) {
                    header("Location: /Views/Vinilos.php?vinilo_success=1");
                    exit;
                } else {
                    echo "Error al agregar vinilo";
                    return false;
                }
            } catch (Exception $e) {
                echo "Error al agregar vinilo: " . $e->getMessage();
                return false;
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
                    break;

                case 'add_to_cart':
                    // Obtener los datos JSON de la solicitud
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
        }
    }
?>