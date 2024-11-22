<?php
    require_once __DIR__ . '/../Config/Connection.php';
    require_once __DIR__ . '/../Models/Usuario.php';

    class Autenticacion {
        private $usr;
        private $conn;

        public function __construct($conn) {
            $this->usr = new Usuario($conn);
            $this->conn = $conn;
        }

        public function registrar($usuario, $psw, $email, $nombre, $sNombre, $apellido, $fNacim, $rfc) {
            if ($this->usr->registrar($usuario, $psw, $email, $nombre, $sNombre, $apellido, $fNacim, $rfc)) {
                header("Location: Login.php");
                exit;
            } else {
                echo "Error al registrar";
            }
        }

        public function login($usuario, $psw) {
            $usr = $this->usr->login($usuario, $psw);
            if ($usr && isset($usr['usr_id']) && isset($usr['usr_usuario'])) {
                session_start();
                session_regenerate_id(true);
                $_SESSION['usr_id'] = $usr['usr_id'];
                $_SESSION['usr_usuario'] = $usr['usr_usuario'];

                $query = "SELECT cli_id FROM cliente WHERE usr_id = :usr_id";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':usr_id', $usr['usr_id']);
                $stmt->execute();
                $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($cliente) {
                    $_SESSION['cli_id'] = $cliente['cli_id'];
                    header("Location: ../../../index.php");
                    exit;
                } else {
                    echo "Error al obtener el cliente";
                    exit;
                }
            } else {
                echo "Error al iniciar sesion";
            }
        }

        public function logout() {
            session_start();
            session_destroy();
            header("Location: ../../../index.php");
            exit;
        }

        public function obtenerCliente($usr_id) {
            return $this->usr->obtenerCliente($usr_id);
        }
        
        public function actualizarCliente($data) {
            return $this->usr->actualizarCliente($data);
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        session_start();
        $auth = new Autenticacion($conn);

        if (isset($_POST['action'])) {
            switch ($_POST['action']) {
                case 'update_cliente';

                    $data = [
                        'usr_id' => $_POST['usr_id'],
                        'email' => $_POST['email'],
                        'nombre' => $_POST['nombre'],
                        'sNombre' => $_POST['sNombre'],
                        'apellido' => $_POST['apellido'],
                        'fNacimiento' => $_POST['fNacimiento'],
                        'rfc' => $_POST['rfc']
                    ];
                    if ($auth->actualizarCliente($data)) {
                        header("Location: /Backend/Views/Perfil.php?success=1");
                        exit;
                    } else {
                        echo "Error al actualizar el perfil del cliente";
                    }
                break;
            }
        }
    }
?>