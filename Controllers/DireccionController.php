<?php
    require_once __DIR__ . '/../Config/Connection.php';
    require_once __DIR__ . '/../Models/Usuario.php';

    class DireccionController {
        private $usr;
    
        public function __construct($conn) {
            $this->usr = new Usuario($conn);
        }
    
        public function agregarDireccion($data) {
            return $this->usr->agregarDireccion($data);
        }
        
        public function obtenerDireccion($usr_id) {
            try {
                return $this->usr->obtenerDireccion($usr_id);
            } catch (Exception $e) {
                echo "Error al obtener direcciones: " . $e->getMessage();
                return false;
            }
        }
    
        public function eliminarDireccion($usr_id, $dir_descrip) {
            try {
                return $this->usr->eliminarDireccion($usr_id, $dir_descrip);
            } catch (Exception $e) {
                echo "Error al eliminar dirección: " . $e->getMessage();
                return false;
            }
        }
    }
    
    // Manejo de solicitudes POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        session_start();
        $usr_id = $_SESSION['usr_id'];
        $dirController = new DireccionController($conn);
    
        if (isset($_POST['action'])) {
            switch ($_POST['action']) {
                case 'insert_direccion':
                    $data = [
                        'estado' => $_POST['estado'],
                        'ciudad' => $_POST['ciudad'],
                        'cPostal' => $_POST['cPostal'],
                        'direccion' => $_POST['direccion'],
                        'descripcion' => $_POST['descripcion'],
                        'usr_id' => $usr_id
                    ];
    
                    if ($dirController->agregarDireccion($data)) {
                        header("Location: /Views/Perfil.php?address_success=1");
                        exit;
                    } else {
                        echo "Error al agregar la dirección.";
                    }
                    break;
    
                case 'delete_direccion':
                    $dir_descrip = $_POST['dir_descrip'];
    
                    if ($dirController->eliminarDireccion($usr_id, $dir_descrip)) {
                        header("Location: /Views/Perfil.php?address_success=1");
                        exit;
                    } else {
                        echo "Error al eliminar la dirección.";
                    }
                    break;
            }
        }
    }
?>