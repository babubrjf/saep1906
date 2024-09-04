<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Alunos</title>
    <link rel="icon" href="logo.png">
    <link rel="icon" href="../img/icon.png" type="image/icon type">
    <link rel="stylesheet" href="../css/style.css" integrity="" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
<center>
        <div class='topnav'>
            <a href='index.php'>Início</a>
            <a class='active' href='listar.php'>Listar Clientes</a>
            <a href='solic.php'>Solicitações</a>
            <a href='logout.php' onclick="return confirm('Deseja deslogar do sistema?')">Sair</a>
        </div>
	<br>
    <h1 style='color: #FFFFFF'>LISTA DE CLIENTES</h1>
    <section style="margin: 50px 0;">
        <div class="container">
            <table class="table table-clear">
                <thead>
                    <tr style='color: #FFFFFF'>
                        <th scope="col" style="text-align:center">NOME</th>
                        <th scope="col" style="text-align:center">CPF</th>
                        <th scope="col" style="text-align:center">TELEFONE</th>
                        <th scope="col" style="text-align:center">ENDEREÇO</th>
                        <th scope="col" colspan="2" style="text-align:center">AÇÕES</th>
                    </tr>
                </thead>
                <tbody> <?php
                require_once "conexao.php";
                $sql_query = "SELECT * FROM users";
                if ($result = $conn->query($sql_query)) {
                    while ($row = $result->fetch_assoc()) {
                        $id_user = $row["id_user"];
                        $nome = $row["nome"];
                        $cpf = $row["cpf"];
                        $tele = $row["tele"];
                        $ende = $row["ende"];
                        ?> 
                        <tr style="text-align:center;color: #FFFFFF">
                        <td> <?php echo $nome; ?> </td>
                        <td> <?php echo $cpf; ?> </td>
                        <td> <?php echo $tele; ?> </td>
                        <td> <?php echo $ende; ?> </td>
                        <td>
                            <a style="text-decoration:none" href="update_a.php?id_user=<?php echo $id_user; ?>" class="btn">Editar</a>
                        </td>
                        <td>
                            <a style="text-decoration:none" href="deletar.php?id_user=<?php echo $id_user; ?>" onclick="return confirm('Tem certeza que deseja deletar este registro?')" class="deletebtn" >Excluir</a>
                        </td>
                    </tr> 
                    <?php
                    }
                }
                $conn->close();
                ?> </tbody>
            </table>
        </div>
    </section>
    <div class='navbar'>
    </center>
</body>

</html>