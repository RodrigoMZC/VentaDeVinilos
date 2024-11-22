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
                $query = "CALL agregarArtista(:nombre, :desc, :fNacim, :lugNacim, :imgURL, :generos)";
                $stmt = $this->conn->prepare($query);

                $stmt->bindParam('nombre', $data['art_nombre']);
                $stmt->bindParam('desc', $data['art_desc']);
                $stmt->bindParam('fNacim', $data['art_fNacim']);
                $stmt->bindParam('lugNacim', $data['art_lugNaci']);
                $stmt->bindParam('imgURL', $data['art_imgURL']);
                $stmt->bindParam('generos', json_encode($data['art_generos']), PDO::PARAM_STR);

                return $stmt->execute();
            } catch (PDOException $e) {
                echo "Error al agregar artista: " . $e->getMessage();
                return false; 
            } 
        }


    }

?>