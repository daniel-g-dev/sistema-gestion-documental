<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

include("conexion.php");

$sql = "SELECT * FROM documentos WHERE estado='vigente'";

if (isset($_GET['categoria'])) {
    $categoria = $_GET['categoria'];
    $sql .= " AND categoria='$categoria'";
} 

if (isset($_GET['buscar']) && !empty($_GET['buscar'])) {
    $buscar = $_GET['buscar'];
    $sql .= " AND titulo LIKE '%$buscar%'";
}

$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Documentos</title>

<style>
body {
    font-family: Arial;
    background: #f4f4f4;
}

h2 {
    text-align: center;
    margin-top: 20px;
}

.container {
    width: 80%;
    margin: auto;
}

.top-bar {
    margin-bottom: 20px;
    text-align: center;
}

.card {
    background: white;
    padding: 15px;
    margin-bottom: 10px;
    border-radius: 5px;
    box-shadow: 0px 0px 5px #ccc;
}

.btn {
    display: inline-block;
    padding: 6px 10px;
    color: white;
    text-decoration: none;
    border-radius: 3px;
}

.btn-azul {
    background: #007bff;
}

.btn-azul:hover {
    background: #0056b3;
}

.btn-rojo {
    background: #dc3545;
}

.btn-rojo:hover {
    background: #a71d2a;
}

.btn-verde {
    background: #28a745;
}

.btn-verde:hover {
    background: #1e7e34;
}

form {
    text-align: center;
    margin-bottom: 15px;
}

input[type="text"] {
    padding: 8px;
    width: 250px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

</style>
</head>

<body>

<div class="container">
<h2>Documentos Disponibles</h2>
<div class="top-bar">

    <a href="dashboard.php" class="btn btn-verde">Inicio</a> 
    
    <a href="documentos.php" class="btn btn-azul">Todos</a>
    <a href="documentos.php?categoria=instructivos" class="btn btn-azul">Instructivos</a>
    <a href="documentos.php?categoria=normas" class="btn btn-azul">Normas</a>
    <a href="documentos.php?categoria=resoluciones" class="btn btn-azul">Resoluciones</a>

</div>

<br>

<form method="GET" action="documentos.php">
    <input type="text" name="buscar" placeholder="Buscar documento...">
    <button type="submit" class="btn btn-azul">Buscar</button>
</form>

<br>

<?php while($doc = $resultado->fetch_assoc()) { ?>

    <div class="card">
        <strong><?php echo $doc['titulo']; ?></strong><br><br>
        Categoria: <?php echo ucfirst($doc['categoria']); ?><br>
        Fecha: <?php echo $doc['fecha_subida']; ?> <br>
        Estado: <?php echo $doc['estado']; ?> <br><br>

        <a href="<?php echo $doc['archivo']; ?>" target="_blank" class="btn btn-azul">
            Ver documento
        </a>

        <?php if ($_SESSION['rol'] == 'admin') { ?>
            <a href="eliminar.php?id=<?php echo $doc['id']; ?>"
               class="btn btn-rojo"
               onclick="return confirm('¿Seguro que deseas eliminar este documento?')"> 
               Eliminar
            </a>
        <?php } ?>       
</div>

<?php } ?>
</div>
</body>
</html>