<?php
session_start();
include("conexion.php");


if (!isset ($_POST['usuario']) || !isset($_POST['password'])) {
    header("Location: index.php");
    exit();
}
$usuario = $_POST['usuario'];
$password = $_POST['password'];

$sql = "SELECT * FROM usuarios WHERE usuario='$usuario' AND password='$password'";
$resultado = $conn->query($sql);

if ($resultado->num_rows == 1) {

$fila = $resultado->fetch_assoc();

    $_SESSION['usuario'] = $fila['usuario'];
    $_SESSION['rol'] = $fila['rol'];
    
    header("Location: dashboard.php");
} else {
    echo "Usuario o contraseña incorrectos.";
}

$conn->close();
?>