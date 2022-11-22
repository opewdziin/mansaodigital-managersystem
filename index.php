<?php
session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
require_once "./utils/config.php";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../assets/css/mansaodigital.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
    <title>Mansão Digital - Página Inicial</title>
</head>
<body>
    <header>
        <div class="inner">
            <div class="logo">
                <div>
                    <img src="../assets/img/logotipo.png" alt="Mansão Digital logo">
                </div>
            </div>

            <nav>
                <li><span><a href="../table/index.php">Planilha</a></span></li>
                <li><span><a href="../table/create.php">Adicionar Planilha</a></span></li>
                <li><span><a href="../dashboard/logout.php" class="button">Desconectar</a></span></li>
            </nav>
        </div>
    </header>
    <br>
    <h1 class="my-5">Olá, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Bem vindo(a) ao sistema de gestão da Mansão Digital.</h1>
    <p>
        <a href="../table/viewenter.php" class="btn btn-success">Ver a planilha</a>
        <a href="../dashboard/logout.php" class="btn btn-danger ml-3">Sair da conta</a>
    </p>
</body>
</html>