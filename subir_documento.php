<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit();
}

if ($_SESSION['rol'] != 'admin') {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Subir Documentos</title>

    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-box {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px #ccc;
            width: 350px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
        }

        input, select {
            width:100%;
            padding: 10px;
            margin-bottom:15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .btn {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            margin-bottom: 10px;
        }

        .btn-azul {
            background: #007bff;
        }

        .btn-azul:hover {
            background: #0056b3;
        }

        .btn-verde {
            background: #28a745;
        }

        .btn-verde:hover {
            background: #1e7e34;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>

<body>

<div class="form-box">

<h2>Subir Documentos</h2>

<form action="guardar_documento.php" method="POST" enctype="multipart/form-data">
    
    <input type="text" name="titulo" placeholder="Nombre del documento" required>

    <select name="categoria" required>
        <option value="">Seleccione categoría</option>
        <option value="instructivos">Instructivos</option>
        <option value="normas">Normas</option>
        <option value="resoluciones">Resoluciones</option>
    </select>
    <input type ="file" name="archivo" accept="application/pdf" required>

    <button type="submit" class="btn btn-azul">Cargar documento</button>

</form>

<a href="dashboard.php">
    <button class="btn btn-verde">Inicio</button>
</a>

</div>

</body>
</html>