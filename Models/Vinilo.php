<?php
    require_once __DIR__ . '/../Config/Connection.php';

    class Vinilo {
        private $conn;

        public function __construct($conn) {
            $this->conn = $conn;
        }

        public function obtenerVinilo() {
            try {
                $query = "SELECT * FROM vista_vinilos";
                $stmt = $this->conn->prepare($query);
                $stmt->execute();

                return $stmt->fetchAll(PDO::FETCH_ASSOC); 
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                return false;
            }
        }

        public function agregarVinilo($data) {
            try {
            $query = "CALL agregarVinilo(:nombre, :fechaLanz, :stock, :imgURL, :artista, :precio, :generos)";
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam('nombre', $data['vin_nombre']);
            $stmt->bindParam('fechaLanz', $data['vin_fechaLanz']);
            $stmt->bindParam('stock', $data['vin_stock']);
            $stmt->bindParam('imgURL', $data['vin_imgURL']);
            $stmt->bindParam('artista', $data['vin_artista']);
            $stmt->bindParam('precio', $data['vin_precio']);
            $stmt->bindParam('generos', json_encode($data['vin_generos']), PDO::PARAM_STR);

            return $stmt->execute();
            } catch (PDOException $e) {
                echo "Error al agregar vinilo: " . $e->getMessage();
                return false;
            }
        }

    }
?>