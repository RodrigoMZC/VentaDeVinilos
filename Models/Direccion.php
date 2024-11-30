<?php 
    require_once __DIR__ . '/../Config/Connection.php';

    class Direccion {
        private $conn;

        public function __construct($conn) {
            $this->conn = $conn;
        }

        public function obtenerDirecciones($cli_id) {
            $query = "SELECT * FROM direccion WHERE cli_id = :cli_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':cli_id', $cli_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    
        // Obtener una dirección específica por su ID
        public function obtenerDireccionPorId($dir_id) {
            $query = "SELECT * FROM direccion WHERE dir_id = :dir_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':dir_id', $dir_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    
        // Agregar una nueva dirección
        public function agregarDireccion($data) {
            $query = "INSERT INTO direccion (dir_estado, dir_ciudad, dir_cPostal, dic_direccion, dir_descrip, cli_id) 
                      VALUES (:estado, :ciudad, :cPostal, :direccion, :descripcion, :cli_id)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':estado', $data['estado']);
            $stmt->bindParam(':ciudad', $data['ciudad']);
            $stmt->bindParam(':cPostal', $data['cPostal']);
            $stmt->bindParam(':direccion', $data['direccion']);
            $stmt->bindParam(':descripcion', $data['descripcion']);
            $stmt->bindParam(':cli_id', $data['cli_id']);
            return $stmt->execute();
        }
    
        // Actualizar una dirección existente
        public function actualizarDireccion($data) {
            $query = "UPDATE direccion SET dir_estado = :estado, dir_ciudad = :ciudad, dir_cPostal = :cPostal, 
                      dic_direccion = :direccion, dir_descrip = :descripcion 
                      WHERE dir_id = :dir_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':estado', $data['estado']);
            $stmt->bindParam(':ciudad', $data['ciudad']);
            $stmt->bindParam(':cPostal', $data['cPostal']);
            $stmt->bindParam(':direccion', $data['direccion']);
            $stmt->bindParam(':descripcion', $data['descripcion']);
            $stmt->bindParam(':dir_id', $data['dir_id'], PDO::PARAM_INT);
            return $stmt->execute();
        }
    
        // Eliminar una dirección
        public function eliminarDireccion($dir_id) {
            $query = "DELETE FROM direccion WHERE dir_id = :dir_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':dir_id', $dir_id, PDO::PARAM_INT);
            return $stmt->execute();
        }
    }
?>