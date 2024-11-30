<?php
    require_once __DIR__ . '/../Config/Connection.php';

    class Genero {
        private $conn;

        public function __construct($conn) {
            $this->conn = $conn;
        }

        public function obtenerGenero() {
            $query = "SELECT gen_id, gen_gen FROM genero";
            $stmt = $this->conn->prepare($query);              
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

?>