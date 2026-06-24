<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit();
}

if ($_SESSION['rol'] != 'admin') {
    die("Acceso denegado");
}

include("conexion.php");

$id = $_GET['id'];

//Obtener ruta del archivo
$resultado = $conn->query("SELECT archivo FROM documentos WHERE id=$id");
$doc = $resultado->fetch_assoc();

//Eliminar archivo fisico
unlink($doc['archivo']);

//Eliminar de ka base de datos
$conn->query("DELETE FROM documentos WHERE id=$id");

//Redirigir
header("Location: documentos.php");
?>