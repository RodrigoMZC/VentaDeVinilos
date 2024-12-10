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

            $stmt->bindParam(':nombre', $data['vin_nombre'], PDO::PARAM_STR);
            $stmt->bindParam(':fechaLanz', $data['vin_fechaLanz'], PDO::PARAM_STR);
            $stmt->bindParam(':stock', $data['vin_stock'], PDO::PARAM_INT);
            $stmt->bindParam(':imgURL', $data['vin_imgURL'], PDO::PARAM_STR);
            $stmt->bindParam(':artista', $data['vin_artista'], PDO::PARAM_INT);
            $stmt->bindParam(':precio', $data['vin_precio'], PDO::PARAM_STR);
            $stmt->bindParam(':generos', json_encode($data['vin_generos']), PDO::PARAM_STR);

            return $stmt->execute();
            } catch (PDOException $e) {
                echo "Error al agregar vinilo: " . $e->getMessage();
                return false;
            }
        }

        public function actualizarVinilo($data) {
            try {
                $query = "UPDATE vinilo SET 
                          vin_nombre = :nombre,
                          vin_fLanz = :fechaLanz,
                          vin_stok = :stock,
                          vin_imgURL = :imgURL,
                          vin_precio = :precio
                          WHERE vin_id = :id";
        
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':nombre', $data['vin_nombre']);
                $stmt->bindParam(':fechaLanz', $data['vin_fechaLanz']);
                $stmt->bindParam(':stock', $data['vin_stock']);
                $stmt->bindParam(':imgURL', $data['vin_imgURL']);
                $stmt->bindParam(':precio', $data['vin_precio']);
                $stmt->bindParam(':id', $data['vin_id'], PDO::PARAM_INT);
        
                return $stmt->execute();
            } catch (PDOException $e) {
                throw new Exception("Error al actualizar vinilo: " . $e->getMessage());
            }
        }

    }
?>