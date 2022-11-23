<?php
session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
require_once "../utils/config.php";
 
$type = $occupation = $datestart = $currency = "";
$type_err = $occupation_err = $datestart_err = $currency_err = "";

$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if(empty(trim($_POST["occupation"]))){
        $occupation_err = "Ei! Preciso que você selecione o serviço";     
    } else{
        $occupation = trim($_POST["occupation"]);
    }    

    if(empty(trim($_POST["datestart"]))){
        $datestart_err = "Ei! Preciso que você coloque a data";     
    } else{
        $datestart = trim($_POST["datestart"]);
    }

    if(empty(trim($_POST["currency"]))){
        $currency_err = "Ei! Preciso que você coloque o valor.";     
    } else{
        $currency = trim($_POST["currency"]);
    }

    if(empty($type_err) && empty($occupation_err) && empty($datestart_err) && empty($currency_err)) {
        $sql = "INSERT INTO services (type, occupation, staffuser, datestart, pricestart) VALUES ('Entrada', :occupation, :author, :datestart, :pricestart)";
        
        if($stmt = $pdo->prepare($sql)){
            $stmt->bindParam(":occupation", $param_occupation, PDO::PARAM_STR);
            $stmt->bindParam(":datestart", $param_datestart, PDO::PARAM_STR);
            $stmt->bindParam(":pricestart", $param_pricestart, PDO::PARAM_STR);
            $stmt->bindParam(":author", $param_author, PDO::PARAM_STR);
            
            $param_occupation = $occupation;
            $param_datestart = $datestart;
            $param_pricestart = $currency;
            $param_author = htmlspecialchars($_SESSION["username"]);
            
            if($stmt->execute()){
                header("location: viewenter.php");
            } else{
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
    <meta charset="UTF-8">
    <title>Mansão Digital - Atualizando a planilha</title>
    <link rel="stylesheet" href="../assets/css/mansaodigital.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
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
    <center>
        <div class="wrapper">
            <p>Por favor, preencha este formulário para atualizar a planilha.</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
                <div class="form-group">
                    <p>Selecione o uso:</p>
                    <select name="occupation" id="occupation" class="form-control <?php echo (!empty($occupation_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $occupation; ?>">
                        <option value="Podcast">Podcast</option>
                        <option value="Hospedagem">Hospedagem</option>
                        <option value="Fotografia">Fotografia</option>
                        <option value="Spa">Spa</option>
                        <option value="Bronzeamento">Bronzeamento</option>
                        <option value="Eventos">Eventos</option>
                        <option value="Coworking">Coworking</option>
                        <option value="Marketing">Marketing</option>
                    </select>
                    <span class="invalid-feedback"><?php echo $occupation_err; ?></span>
                </div>
                <div class="form-group">
                    <p>Insire a data:</p>
                    <input type="date" id="datestart" name="datestart" max="2022-12-31" class="form-control <?php echo (!empty($datestart_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $datestart; ?>">
                    <span class="invalid-feedback"><?php echo $datestart_err; ?></span> 
                </div>
                <div class="form-group">
                    <p>Valor:</p>
                    <input type="number" name="currency" id="currency" value="" data-type="currency" placeholder="R$1000" class="form-control <?php echo (!empty($currency_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $currency; ?>">
                    <span class="invalid-feedback"><?php echo $currency_err; ?></span>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Adicionar">
                    <a class="btn btn-link ml-2" href="../index.php">Cancelar</a>
                </div>
            </form>
        </div>  
    </center>   
</body>
</html>