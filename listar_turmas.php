<?php
session_start();
include 'config.php';

if (!isset($_SESSION['mecanico_id'])) {
    header("Location: login.php");
    exit();
}

//define o nome da sessão pelo id do médico
$mecanico_id = $_SESSION['mecanico_id'];

//recupera o nome do médico de acordo com o id da sessão
$sql_mecanico = "SELECT nome FROM mecanicos WHERE codigo='$mecanico_id'";
$result_mecanico = $conn->query($sql_mecanico);
$mecanico_nome = $result_mecanico->fetch_assoc()['nome'];

$sql = "SELECT * FROM veiculos WHERE mecanico_codigo='$mecanico_id'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Listar Veículos</title>
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
        <h4>Veículos</h4>
        <div class="row justify-content-end">
            <div class="col-2">            
            <a href="cadastrar_veiculo.php" class="btn btn-success mb-2">Cadastrar Veículo</a>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Veículo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$row['codigo']."</td>";
                        echo "<td>".$row['nome']."</td>";
                        echo "<td><a href='listar_demandas.php?veiculo_id=".$row['codigo']."' class='btn btn-info btn-sm'>Ver Demanda</a> ";
                        echo "<a href='deletar_veiculo.php?veiculo_id=".$row['codigo']."' onClick='return confirm(\"Deseja realmente deletar a demanda?\")' class='btn btn-danger btn-sm'>Deletar</a></td>"; 
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>Nenhum veiculo cadastrado</td></tr>";
                }
                ?>
            </tbody>
        </table>        
    </div>
</body>
</html>