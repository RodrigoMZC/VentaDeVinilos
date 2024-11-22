<?php
    require_once __DIR__ . '/../Config/Helpers.php';

    class Usuario {
        private $conn;

        public function __construct($conn) {
            $this->conn = $conn;
        }
        
        public function registrar($usuario, $psw, $email, $nombre, $sNombre, $apellido, $fNacim, $rfc) {
            $usuario = secure_data($usuario);
            $hashed_psw = password_hash($psw, PASSWORD_DEFAULT);
            $email = secure_data($email);
            $nombre = secure_data($nombre);
            $sNombre = secure_data($sNombre);
            $apellido = secure_data($apellido);
            $fNacim = secure_data($fNacim);
            $rfc = secure_data($rfc);

            $checkQuery = "SELECT COUNT(*) FROM usuario WHERE usr_usuario = ?";
            $checkStmt = $this->conn->prepare($checkQuery);
            $checkStmt->execute([$usuario]);
            $exists = $checkStmt->fetchColumn();

            if ($exists > 0) {
                echo "Error: El usuario ya existe.";
                return false;
            }

            $query = "CALL create_user_and_client (:usuario, :psw, :email, :nombre, :sNombre, :apellido, :fNacim, :rfc)";
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':usuario', $usuario);
            $stmt->bindParam(':psw', $hashed_psw);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':sNombre', $sNombre);
            $stmt->bindParam(':apellido', $apellido);
            $stmt->bindParam(':fNacim', $fNacim);
            $stmt->bindParam(':rfc', $rfc);
    
            return $stmt->execute();
        }    

        public function login($usuario, $psw) { 
            $usuario = secure_data($usuario);
            //$psw = secure_data($psw);

            $query = "SELECT * FROM usuario WHERE usr_usuario = :usuario;";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':usuario', $usuario);
            $stmt->execute();
            $usr = $stmt->fetch();

            if (password_verify($psw, $usr['usr_pword'])) {
                return $usr;
            }
            echo "Error: Usuario no encontrado o Contrasela incorrecta.";
            return false;
        }
        

        public function obtenerCliente($usr_id) {
            try {
                $query = "SELECT * FROM vista_cliente WHERE usr_id = :usr_id";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':usr_id', $usr_id);
                $stmt->execute();
        
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                return false;

            }
        }
        
        public function actualizarCliente($data) {
            $query = "CALL actualizarDatosCliente(:usr_id, :email, :nombre, :sNombre, :apellido, :fNacimiento, :rfc)";
            $stmt = $this->conn->prepare($query);
        
            $stmt->bindParam(':usr_id', $data['usr_id']);
            $stmt->bindParam(':email', $data['email']);
            $stmt->bindParam(':nombre', $data['nombre']);
            $stmt->bindParam(':sNombre', $data['sNombre']);
            $stmt->bindParam(':apellido', $data['apellido']);
            $stmt->bindParam(':fNacimiento', $data['fNacimiento']);
            $stmt->bindParam(':rfc', $data['rfc']);
        
            return $stmt->execute();
        }

        public function agregarDireccion($data) {
            $query = 'CALL agregar_direccion (:estado, :ciudad, :cPostal, :direccion, :descripcion, :usr_id)';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':estado', $data['estado']);
            $stmt->bindParam(':ciudad', $data['ciudad']);
            $stmt->bindParam(':cPostal', $data['cPostal']);
            $stmt->bindParam(':direccion', $data['direccion']);
            $stmt->bindParam(':descripcion', $data['descripcion']);
            $stmt->bindParam(':usr_id', $data['usr_id']);

            return $stmt->execute();
        }

        public function obtenerDireccion($usr_id) {
            $query = "SELECT * FROM vista_direcciones_usuario WHERE usr_id = :usr_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':usr_id', $usr_id);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function eliminarDireccion($usr_id, $dir_descrip) {
            $query = "CALL eliminarDireccionEspecifica(:usr_id, :dir_descrip)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':usr_id', $usr_id);
            $stmt->bindParam(':dir_descrip', $dir_descrip);

            return $stmt->execute();
        } 
    }
?>



