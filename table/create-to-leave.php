<?php
session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
require_once "../utils/config.php";
 
$type = $description = $datefinish = $currency = "";
$type_err = $description_err = $datefinish_err = $currency_err = "";

$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if(empty(trim($_POST["description"]))){
        $description_err = "Ei! Esqueceu de colocar a descrição.";     
    } else{
        $description = trim($_POST["description"]);
    }    

    if(empty(trim($_POST["datefinish"]))){
        $datefinish_err = "Ei! Esqueceu de colocar a data.";     
    } else{
        $datefinish = trim($_POST["datefinish"]);
    }

    if(empty(trim($_POST["currency"]))){
        $currency_err = "Ei! Esqueceu de colocar o valor.";     
    } else{
        $currency = trim($_POST["currency"]);
    }

    if(empty($type_err) && empty($description_err) && empty($datefinish_err) && empty($currency_err)) {
        $sql = "INSERT INTO leave_service (price, date, description) VALUES (:pricefinish, :datefinish, :description)";
        
        if($stmt = $pdo->prepare($sql)){
            $stmt->bindParam(":description", $param_description, PDO::PARAM_STR);
            $stmt->bindParam(":datefinish", $param_datefinish, PDO::PARAM_STR);
            $stmt->bindParam(":pricefinish", $param_pricefinish, PDO::PARAM_STR);
            
            $param_description = $description;
            $param_datefinish = $datefinish;
            $param_pricefinish = $currency;
            
            if($stmt->execute()){
                header("location: viewleave.php");
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
    <title>Mansão Digital - Criando a saída na planilha</title>
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
                    <p>Insira a descrição:</p>
                    <input type="text" name="description" id="description" value="" placeholder="Insira a descrição aqui" class="form-control <?php echo (!empty($description_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $description; ?>">
                    <span class="invalid-feedback"><?php echo $description_err; ?></span> 
                </div>
                <div class="form-group">
                    <p>Insire a data:</p>
                    <input type="date" id="datefinish" name="datefinish" max="2022-12-31" class="form-control <?php echo (!empty($datefinish_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $datefinish; ?>">
                    <span class="invalid-feedback"><?php echo $datefinish_err; ?></span> 
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