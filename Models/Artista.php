<?php
    require_once __DIR__ . '/../Config/Connection.php';

    class Artista {
        private $conn;

        public function __construct($conn) {
            $this->conn = $conn;
        }

        public function obtenerArtista() {
            try {
                $query = "SELECT * FROM vista_artistas_generos";
                $stmt = $this->conn->prepare($query);
                $stmt->execute();

                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                return false;
            } 
        }

        public function agregarArtista($data) {
            try {
                $query = "CALL agregarArtista(:nombre, :desc, :anioNacimiento, :lugNacim, :imgURL, :generos)";
                $stmt = $this->conn->prepare($query);
        
                $stmt->bindParam(':nombre', $data['art_nombre'], PDO::PARAM_STR);
                $stmt->bindParam(':desc', $data['art_desc'], PDO::PARAM_STR);
                $stmt->bindParam(':anioNacimiento', $data['art_fNacim'], PDO::PARAM_INT);
                $stmt->bindParam(':lugNacim', $data['art_lugNaci'], PDO::PARAM_STR);
                $stmt->bindParam(':imgURL', $data['art_imgURL'], PDO::PARAM_STR);
        
                // Manejar el JSON de generos
                $generosJSON = json_encode($data['art_generos']);
                $stmt->bindParam(':generos', $generosJSON, PDO::PARAM_STR);
        
                return $stmt->execute();
            } catch (PDOException $e) {
                throw new Exception("Error al agregar artista: " . $e->getMessage());
            }
        }
               
    }
?>