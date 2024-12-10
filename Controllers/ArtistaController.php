<?php
    require_once __DIR__ . '/../Config/Connection.php';
    require_once __DIR__ . '/../Models/Artista.php';

    class ArtistaController {
        private $art;

        public function __construct($conn) {
            $this->art = new Artista($conn);
        }

        public function obtenerArtista() {
            try {
                return $this->art->obtenerArtista();
            } catch (Exception $e) {
                echo "Error al obtener artistas: " . $e->getMessage();
                return false;
            }
        }

        public function agregarArtista($data) {
            try {
                return $this->art->agregarArtista($data);
            } catch (Exception $e) {
                echo "Error al agregar artista: " . $e->getMessage();
                return false;
            }
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $artistaController = new ArtistaController($conn);
    
        $data = [
            'art_nombre' => $_POST['art_nombre'],
            'art_desc' => $_POST['art_desc'] ?? '',
            'art_fNacim' => $_POST['art_fNacim'],
            'art_lugNaci' => $_POST['art_lugNaci'],
            'art_imgURL' => $_POST['art_imgURL'],
            'art_generos' => $_POST['art_generos'] ?? []
        ];
    
        $response = $artistaController->agregarArtista($data);
    
        if ($response['success']) {
            header('Location: /Views/Success.php'); // Redirige a una página de éxito
        } else {
            echo "<p>Error: " . htmlspecialchars($response['message']) . "</p>";
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
            $art_nombre = $_POST['art_nombre'] ?? null;
            $art_desc = $_POST['art_desc'] ?? null;
            $art_anio = $_POST['art_fNacim'] ?? null; 
            $art_lugNaci = $_POST['art_lugNaci'] ?? null;
            $art_imgURL = $_POST['art_imgURL'] ?? null;
            $art_generos = $_POST['art_generos'] ?? [];
    
            if (!$art_nombre || !$art_anio || !$art_lugNaci || !$art_imgURL || empty($art_generos)) {
                throw new Exception("Todos los campos obligatorios deben completarse.");
            }
    
            if (!is_numeric($art_anio) || (int)$art_anio < 1900 || (int)$art_anio > date('Y')) {
                throw new Exception("El año de nacimiento no es válido.");
            }
    
            $data = [
                'art_nombre' => $art_nombre,
                'art_desc' => $art_desc,
                'art_fNacim' => (int)$art_anio,
                'art_lugNaci' => $art_lugNaci,
                'art_imgURL' => $art_imgURL,
                'art_generos' => $art_generos,
            ];
    
            require_once __DIR__ . '/../Models/Artista.php';
            $controller = new ArtistaController($conn);
            $result = $controller->agregarArtista($data);
    
            if ($result) {
                header('Location: /Views/Dashboard.php?success=1');
                exit;
            } else {
                throw new Exception("Error al agregar el artista.");
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
    
    
    
?>