<?php
session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
require_once "../../utils/config.php";
?>

<html>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Mansão Digital - Gerenciador</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: #f4f4f4;
        }
        .menu {
            float:left;
            width:33%;
            height:1250px;
            border:none;
        }
        .mainContent {
            float:left;
            width:65%;
            height:1250px;
            border:none;
        }
    </style>
</head>
    <body>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Data</th>
                <th scope="col">Serviço</th>
                <th scope="col">Valor</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php
                $link = mysqli_connect("localhost", "root", "", "mansaodigital");
                $query = mysqli_query($link, "SELECT * FROM services ORDER by id");
                while($row = $query->fetch_array()) {
                    echo "<tr>";
                    echo "<th scope="."row".">".$row['id']."</th>";
                    $date=date_create($row['datestart']);
                    echo "<td>" . date_format($date, "d/m/Y") . "</td>";
                    echo "<td>" . $row['occupation'] . "</td>";
                    echo "<td>" . $row['pricestart'] . "</td>";
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
    </body>
</html>