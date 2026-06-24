<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit();
}

if (isset($_GET['mensaje'])) {
    if ($_GET['mensaje'] == 'subido') {
        echo "<p style='color:green;'>Documento subido correctamente</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Intranet CDA RTV Anapoima</title>

    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
        }

        .container {
            width: 80%;
            margin: auto;
            text-align: center;
            margin-top: 100px;
        }

        h2 {
            margin-bottom: 30px;
        }

        .btn {
            display: inline-block;
            padding: 12px 20px;
            margin: 10px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
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
    </style>
    </head>

<body>

<div class="container">

    <h2>Bienvenido <?php echo $_SESSION["usuario"]; ?></h2>

    <a href="documentos.php" class="btn btn-azul">Ver documentos</a>

    <?php if ($_SESSION['rol'] == 'admin') { ?>
        <a href="subir_documento.php" class="btn btn-azul">Subir documentos</a>
    <?php } ?>

    <br><br>

    <a href="logout.php" class="btn btn-rojo">Salir</a>

</div>

</body>
</html>