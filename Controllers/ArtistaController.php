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
?>