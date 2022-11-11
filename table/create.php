<?php
// Inicialize a sessão
session_start();
 
// Verifique se o usuário está logado, se não, redirecione-o para uma página de login
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<?php 

require_once "../utils/config.php";

$type = $occupation = $datestart = $currency = "";
$type_err = $occupation_err = $datestart_err = $currency_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty($type_err) && empty($occupation_err) && empty($datestart_err) && empty($currency_err)) {
        $sql = "INSERT INTO services (type, occupation, staffuser, datestart, pricestart, datefinish, pricefinish, description) VALUES (Entrada, Podcast, " + htmlspecialchars($_SESSION["username"]); + ", 2022-12-31, 1000, null, null, null)";
        if($stmt = $pdo->prepare($sql)) {

            $stmt->bindParam(":type", $param_type, PDO::PARAM_STR);
            $stmt->bindParam(":occupation", $param_occupation, PDO::PARAM_STR);
            $stmt->bindParam(":datestart", $param_datestart, PDO::PARAM_STR);
            $stmt->bindParam(":pricestart", $param_pricestart, PDO::PARAM_STR);

            if($stmt->execute()) {
                echo "Tabela criada no banco de dados";
            } else {
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }
            unset($stmt);
        }
    }
    unset($pdo);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset='utf-8'>
    <link rel="stylesheet" href="../assets/css/mansaodigital.css">
    <title>Criando tabela</title>
</head>
<body>
    <form>
        <p>Selecione o Tipo:</p>
        <select name="type" id="type">
            <option value="entrada">Entrada</option>
            <option value="saida">Saída</option>
        </select>

        <p>Selecione o uso:</p>
        <select name="occupation" id="occupation">
            <option value="podcast">Podcast</option>
            <option value="hospedagem">Hospedagem</option>
            <option value="fotografia">Fotografia</option>
            <option value="spa">Spa</option>
            <option value="bronzeamento">Bronzeamento</option>
            <option value="eventos">Eventos</option>
            <option value="coworking">Coworking</option>
            <option value="marketing">Marketing</option>
        </select>
        <p>Insire a data:</p>
        <input type="date" id="datestart" name="datestart" max="2022-12-31">

        <p>Valor:</p>
        <input type="text" name="currency-field" id="currency-field" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" value="" data-type="currency" placeholder="R$1000">
        <input type="submit" class="btn btn-primary" value="Salvar tabela">
    </form>
</body>
</html>