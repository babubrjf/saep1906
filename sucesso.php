<?php
session_start();
if (!isset($_SESSION['mecanico_id'])) {
    header("Location: login.php");
    exit();
}

$mecanico_nome = $_SESSION['mecanico_nome'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="logo.png">
    <style>
        .navbar-custom {
            background-color: #1B3954;
        }
    </style>
</head>
<body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <nav class="navbar navbar-custom">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1 text-white">Bem-vindo, Mecânico <?php echo $mecanico_nome; ?></span>
            <a href="logout.php" onclick="return confirm('Deseja deslogar do sistema?')" class="btn btn-danger">Sair</a>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success" role="alert">CADASTRO REALIZADO COM SUCESSO!</div>
                </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
            <a href="listar_veiculos.php" class="btn btn-primary mb-2">Voltar</a>
            </div>
        </div>
    </div>
</body>
</html>