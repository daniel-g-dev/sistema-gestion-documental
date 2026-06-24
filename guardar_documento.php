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

$titulo = $_POST['titulo'];
$categoria = $_POST['categoria'];
$fecha = date("Y-m-d");
$estado = "vigente";

$archivo = $_FILES['archivo']['name'];
$tmp = $_FILES['archivo']['tmp_name'];

if (!empty($categoria) && !empty($archivo)) {
    $ruta = "uploads/" . $categoria . "/" . $archivo;
} else {
    die("Error: categoria o archivo vacio");
}

move_uploaded_file($tmp, $ruta);

$sql = "INSERT INTO documentos
(titulo, categoria, archivo, fecha_subida, estado)
VALUES
('$titulo', '$categoria', '$ruta', '$fecha', '$estado')";

$conn->query($sql);

header("Location: dashboard.php?mensaje=subido");
?>