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

$veiculo_id = $_GET['veiculo_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $descricao = $_POST['descricao'];

    $sql = "INSERT INTO demandas (descricao, veiculo_codigo) VALUES ('$descricao', '$veiculo_id')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: listar_veiculos.php?veic_id=".$veic_id);
    } else {
        echo "Erro ao cadastrar demanda: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cadastrar Demanda</title>
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
        <h3>Cadastrar Demanda</h3>
        <div class="row justify-content-end">
            <div class="col-2">            
            <a href="listar_veiculos.php" class="btn btn-primary mt-2">Voltar</a>
            </div>
        </div>
        <form method="post" action="cadastrar_demanda.php?veiculo_id=<?php echo $veiculo_id; ?>">
            <div class="mb-3">
                <label for="descricao" class="form-label">Prescrição</label>
                <textarea name="descricao" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-success">Cadastrar</button>
        </form>
        
    </div>
</body>
</html>