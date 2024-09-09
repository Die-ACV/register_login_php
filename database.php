<?php 

// Variables o datos para conectar con la base de datos
$server = "localhost";         // Nombre del servidor
$username = "root";            // Nombre de usuario
$password = "";                // Contraseña de la base de datos
$database = "php_login_database"; // Nombre de la base de datos correcta

// Intento de conexión
try {
    $conn = new PDO("mysql:host=$server;dbname=$database", $username, $password);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}


?>


