<?php
session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../../dashboard/login.php");
    exit;
}

    if($_SERVER['REQUEST_METHOD']=='GET') {
        $link = mysqli_connect("localhost", "root", "", "mansaodigital");
        isset($_GET['id']) ? $busca=mysqli_query($link, "DELETE FROM leave_service WHERE id='" . $_GET['id'] . "'") : die(mysql_error());
        header("location: ../viewleave.php");
    }

?>