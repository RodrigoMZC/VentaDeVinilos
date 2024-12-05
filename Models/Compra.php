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
    
        public function obtenerCompras() {
            $query = "SELECT * FROM vista_compras_con_email;";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
        public function eliminarCompra($comp_id) {
            try {
                $query = "DELETE FROM comp_vin WHERE comp_id = :comp_id";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':comp_id', $comp_id, PDO::PARAM_INT);
                $stmt->execute();
    
                $query = "DELETE FROM compra WHERE comp_id = :comp_id";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':comp_id', $comp_id, PDO::PARAM_INT);
    
                return $stmt->execute();
            } catch (Exception $e) {
                return 'Error al eliminar la compra: ' . $e->getMessage();
            }
        }

        public function actualizarEstadoEntrega($comp_id) {
            try {
                $query = "CALL actualizar_estado_entrega(:comp_id)";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':comp_id', $comp_id, PDO::PARAM_INT);
                $stmt->execute();
    
                return $stmt->execute();
            } catch (Exception $e) {
                return 'Error al actualizar la compra: ' . $e->getMessage();
            }
        }

        public function obtenerCompraPorId($comp_id) {
            try {
                $query = "SELECT * FROM compras_vinilos_detalles WHERE comp_id = :comp_id";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':comp_id', $comp_id, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $e) {
                throw new Exception("Error al obtener la compra por ID: " . $e->getMessage());
            }
        }

        public function obtenerComprasCliente($cli_id) {
            $query = "SELECT * FROM vista_compras WHERE cli_id = :cli_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':cli_id', $cli_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>