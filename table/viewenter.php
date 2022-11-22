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
    <title>Mansão Digital - Planilha de Entrada</title>
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
    <div class="container">
    <p>
        <center>
            <a href="../table/viewleave.php" class="btn btn-primary">Ver as saídas</a>
        </center>
    </p>
    <br>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tipo</th>
                <th scope="col">Data</th>
                <th scope="col">Serviço</th>
                <th scope="col">Valor</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php
                $link = mysqli_connect("localhost", "root", "", "mansaodigital");
                $query = mysqli_query($link, "SELECT * FROM services WHERE type = 'Entrada' ORDER by id");
                while($row = $query->fetch_array()) {
                    echo "<tr>";
                    echo "<th scope="."row".">".$row['id']."</th>";
                    echo "<td>" . $row['type'] . "</td>";
                    $date=date_create($row['datestart']);
                    echo "<td>" . date_format($date, "d/m/Y") . "</td>";
                    echo "<td>" . $row['occupation'] . "</td>";
                    echo "<td>R$" . $row['pricestart'] . "</td>";
                    echo "<td><select name="."options".">";
                    echo "<option value=".""."></option>";
                    echo "<option value="."change".">Editar</option>";
                    echo "<option value="."delete".">Excluir</option>";
                    echo "<option value="."create-exit".">Criar saída</option>";
                    echo "</select></td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
    <br>
    <a href="../table/viewleave.php" class="btn btn-success">Criar uma entrada</a>
    </div>
</body>
</html>