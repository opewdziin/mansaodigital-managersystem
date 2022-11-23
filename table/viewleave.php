<?php
session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
require_once "../utils/config.php";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../assets/css/mansaodigital.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <title>Mansão Digital - Planilha de Saída</title>
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
                <li><span><a href="../index.php">Página Inicial</a></span></li>
                <li><span><a href="../dashboard/logout.php" class="button">Desconectar</a></span></li>
            </nav>
        </div>
    </header>
    <br>
    <div class="container">
    <p>
        <center>
            <a href="../table/viewenter.php" class="btn btn-primary">Ver as entradas</a>
        </center>
    </p>
    <br>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Data</th>
                <th scope="col">Descrição</th>
                <th scope="col">Valor</th>
                <th scope="col">Opções</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $link = mysqli_connect("localhost", "root", "", "mansaodigital");
                $query = mysqli_query($link, "SELECT * FROM leave_service ORDER by id");
                while($row = $query->fetch_array()) {
                    echo "<tr>";
                    echo "<th scope="."row".">".$row['id']."</th>";
                    $date=date_create($row['date']);
                    echo "<td>" . date_format($date, "d/m/Y") . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>R$" . $row['price'] . "</td>";
                    echo "<td><a href=" . "../table/create-to-leave.php" . " class=" . "btn-danger" . ">Deletar</a></td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
    <br>
    <a href="../table/create-to-leave.php" class="btn btn-success">Criar uma saída</a>
    </div>
</body>
</html>