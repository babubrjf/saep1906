<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM mecanicos WHERE email='$email' AND senha='$senha'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $mecanico = $result->fetch_assoc();
        $_SESSION['mecanico_id'] = $mecanico['codigo'];
        $_SESSION['mecanico_nome'] = $mecanico['nome'];
        header("Location: listar_veiculos.php");
    } else {
        header("Location: index.php");
    }
}
?>