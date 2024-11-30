<?php
    require_once __DIR__ . '/../Config/Connection.php';
    require_once __DIR__ . '/../Models/Genero.php';

    class GeneroController {
        private $genero;

        public function __construct($conn) {
            $this->genero = new Genero($conn);
        }

        public function obtenerGenero() {
            try {
                return $this->genero->obtenerGenero();
            } catch (Exception $e) {
                echo "Error al obtener géneros: " . $e->getMessage();
                return false;
            }
        }
    }
?>