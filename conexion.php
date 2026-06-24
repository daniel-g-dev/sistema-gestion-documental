<?php
$host = "localhost";
$usuario = "root";
$password = ""; // En XAMPP por defecto va vacío
$base_datos = "intranet_cda";

$conn = new mysqli($host, $usuario, $password, $base_datos);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>