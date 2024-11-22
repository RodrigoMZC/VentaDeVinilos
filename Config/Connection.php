<?php
    require_once __DIR__ . '/../vendor/autoload.php';

    $dotEnv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotEnv->load();

    $dbHost = $_ENV['DB_HOST'];
    $dbPort = $_ENV['DB_PORT'];
    $dbName = $_ENV['DB_DATABASE'];
    $dbUser = $_ENV['DB_USERNAME'];
    $dbPass = $_ENV['DB_PASSWORD'];

    try {
        $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

?>