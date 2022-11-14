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
    <style>
        .menu {
            float:left;
            width:23%;
            height:1250px;
            border:none;
        }
        .mainContent {
            float:left;
            width: 75vw;
            height: 1250px;
            border:none;
        }
        .container {
            height: 100vh;
            width: 100vw;
        }
    </style>
</head>
    <body>
        <iframe id="choices" class="menu" name="choices" src="./../teste.html"></iframe>
        <div class="container">
            <iframe id="main" class="mainContent" name="main" src="./api/enter.php"></iframe>
        </div>
    </body>
</html>