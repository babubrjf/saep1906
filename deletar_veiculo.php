<!DOCTYPE html>
<html>
<head>
    <title>Cadastrar veiculo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="logo.png">
    <style>
        .navbar-custom {
            background-color: #1B3954;
        }
    </style>
</head>
<body>
<?php
session_start();
include 'config.php';

if (!isset($_SESSION['mecanico_id'])) {
    header("Location: login.php");
    exit();
}

$veiculo_id = $_GET['veiculo_id'];

$sql = "SELECT * FROM demandas WHERE veiculo_codigo='$veiculo_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    header("Location: erro.php");    
} else {
    $sql = "DELETE FROM veiculos WHERE codigo='$veiculo_id'";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: listar_veiculos.php");
    } else {
        echo "Erro ao deletar veiculo: " . $conn->error;
    }
}
?>
<div class="row">
    <div class="col-12 d-flex justify-content-center">
    <a href="listar_veiculos.php" class="btn btn-primary mb-2">Voltar</a>
</div>

</body>
</html>