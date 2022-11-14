<?php
session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
require_once "../utils/config.php";
?>

<html>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Mansão Digital - Gerenciador</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .menu {
            float:left;
            width:23%;
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
        <iframe id="choices" class="menu" name="choices" src="./../teste.html"></iframe>
        <iframe id="main" class="mainContent" name="main" src="./api/enter.php"></iframe>
    </body>
</html>