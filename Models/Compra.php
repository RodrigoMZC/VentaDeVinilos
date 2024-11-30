<?php
    require_once __DIR__ . '/../Config/Connection.php';
    
    class Compra {
        private $conn;
    
        public function __construct($conn) {
            $this->conn = $conn;
        }
    
        public function registrarCompra($cli_id, $direccion_id, $carrito) {
            try {
                if (empty($carrito)) {
                    throw new Exception("El carrito está vacío.");
                }

                $carritoJson = json_encode($carrito);

                $query = "CALL registrar_compra(:cli_id, :direccion_id, :carrito)";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':cli_id', $cli_id, PDO::PARAM_INT);
                $stmt->bindParam(':direccion_id', $direccion_id, PDO::PARAM_INT);
                $stmt->bindParam(':carrito', json_encode($carrito), PDO::PARAM_STR);
                $stmt->execute();

                return ['status' => 'success', 'message' => 'Compra realizada con éxito.'];
            } catch (Exception $e) {
                return ['status' => 'error', 'message' => 'Error al registrar la compra: ' . $e->getMessage()];
            } catch (Exception $e) {
                return ['status' => 'error', 'message' => $e->getMessage()];
            }
        }
    
        // Obtener todas las compras del cliente
        public function obtenerCompras($cli_id) {
            $query = "SELECT * FROM vista_compras WHERE cli_id = :cli_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':cli_id', $cli_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>