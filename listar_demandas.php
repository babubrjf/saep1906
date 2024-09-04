<?php
session_start();
include 'config.php';

if (!isset($_SESSION['mecanico_id'])) {
    header("Location: login.php");
    exit();
}

$veiculo_id = $_GET['veiculo_id'];
$mecanico_id = $_SESSION['mecanico_id'];

// Obter nome do veiculo
$sql_veiculo = "SELECT nome FROM veiculos WHERE codigo='$veiculo_id'";
$result_veiculo = $conn->query($sql_veiculo);
$veiculo_nome = $result_veiculo->fetch_assoc()['nome'];

// Obter nome do mecanico
$sql_mecanico = "SELECT nome FROM mecanicos WHERE codigo='$mecanico_id'";
$result_mecanico = $conn->query($sql_mecanico);
$mecanico_nome = $result_mecanico->fetch_assoc()['nome'];

// Obter descrições
$sql = "SELECT * FROM demandas WHERE veiculo_codigo='$veiculo_id'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Listar Demandas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="logo.png">
    <style>
        .navbar-custom {
            background-color: #1B3954;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-custom">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1 text-white">Bem-vindo(a), Mecânico <?php echo $mecanico_nome; ?></span>
            <a href="logout.php" onclick="return confirm('Deseja deslogar do sistema?')" class="btn btn-danger">Sair</a>
        </div>
    </nav>
    <div class="container mt-5">
        <h4>Descrição do(a) veículo: <?php echo $veiculo_nome; ?></h4>
        <div class="row justify-content-end">
            <div class="col-3">
            <a href="listar_veiculos.php" class="btn btn-primary mb-2">Voltar</a>
            <a href="cadastrar_demanda.php?veiculo_id=<?php echo $veiculo_id; ?>" class="btn btn-success mb-2">Cadastrar Demanda</a>
            </div>
        </div>
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Descrição</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$row['codigo']."</td>";
                        echo "<td>".$row['descricao']."</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>Nenhuma demanda cadastrada</td></tr>";
                }
                ?>
            </tbody>
        </table>
        
    </div>
</body>
</html>