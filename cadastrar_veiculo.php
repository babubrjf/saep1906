<?php
session_start();
include 'config.php';

if (!isset($_SESSION['mecanico_id'])) {
    header("Location: login.php");
    exit();
}

$mecanico_id = $_SESSION['mecanico_id'];

$sql_mecanico = "SELECT nome FROM mecanicos WHERE codigo='$mecanico_id'";
$result_mecanico = $conn->query($sql_mecanico);
$mecanico_nome = $result_mecanico->fetch_assoc()['nome'];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome_veiculo = $_POST['nome_veiculo'];
    $mecanico_id = $_SESSION['mecanico_id'];
    $mecanico_nome = $_SESSION['nome'];

    $sql = "INSERT INTO veiculos (nome, mecanico_codigo) VALUES ('$nome_veiculo', '$mecanico_id')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: sucesso.php");
    } else {
        echo "Erro ao cadastrar veículo: " . $conn->error;
    }
}
?>

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
    <nav class="navbar navbar-custom">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1 text-white">Bem-vindo(a), Mecânico <?php echo $mecanico_nome; ?></span>
            <a href="logout.php" onclick="return confirm('Deseja deslogar do sistema?')" class="btn btn-danger">Sair</a>
        </div>
    </nav>
    <div class="container mt-5">
        <h4>Cadastrar veiculo</h4>
        <div class="row justify-content-end">
            <div class="col-2">            
            <a href="listar_veiculos.php" class="btn btn-primary mt-2">Voltar</a>
            </div>
        </div>
        <form method="post" action="cadastrar_veiculo.php">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome ( Ex: MARCA - Modelo)</label>
                <input type="text" name="nome_veiculo" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Cadastrar</button>
        </form>
        
    </div>
</body>
</html>