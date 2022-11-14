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
 
    if(empty(trim($_POST["type"]))){
        $type_err = "Por favor insira a nova senha.";     
    } else{
        $type = trim($_POST["type"]);
    }
    
    if(empty(trim($_POST["occupation"]))){
        $occupation_err = "Por favor insira a nova senha.";     
    } else{
        $occupation = trim($_POST["occupation"]);
    }    

    if(empty(trim($_POST["datestart"]))){
        $datestart_err = "Por favor insira a nova senha.";     
    } else{
        $datestart = trim($_POST["datestart"]);
    }

    if(empty(trim($_POST["currency"]))){
        $currency_err = "Por favor insira a nova senha.";     
    } else{
        $currency = trim($_POST["currency"]);
    }

    if(empty($type_err) && empty($occupation_err) && empty($datestart_err) && empty($currency_err)) {
        $sql = "INSERT INTO services (type, occupation, staffuser, datestart, pricestart, datefinish, pricefinish, description) VALUES (:type, :occupation, :author, :datestart, :pricestart, null, null, null)";
        
        if($stmt = $pdo->prepare($sql)){
            $stmt->bindParam(":type", $param_type, PDO::PARAM_STR);
            $stmt->bindParam(":occupation", $param_occupation, PDO::PARAM_STR);
            $stmt->bindParam(":datestart", $param_datestart, PDO::PARAM_STR);
            $stmt->bindParam(":pricestart", $param_pricestart, PDO::PARAM_STR);
            $stmt->bindParam(":author", $param_author, PDO::PARAM_STR);
            
            $param_type = $type;
            $param_occupation = $occupation;
            $param_datestart = $datestart;
            $param_pricestart = $currency;
            $param_author = htmlspecialchars($_SESSION["username"]);
            
            if($stmt->execute()){
                header("location: index.php");
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
    <title>Redefinir senha</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <center>
        <div class="wrapper">
            <h2>Redefinir senha</h2>
            <p>Por favor, preencha este formulário para redefinir sua senha.</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
                <div class="form-group">
                    <p>Selecione o Tipo:</p>
                    <select name="type" id="type" class="form-control <?php echo (!empty($type_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $type; ?>">
                        <option value="entrada">Entrada</option>
                        <option value="saida">Saída</option>
                    </select>
                    <span class="invalid-feedback"><?php echo $type_err; ?></span>
                </div>
                <div class="form-group">
                    <p>Selecione o uso:</p>
                    <select name="occupation" id="occupation" class="form-control <?php echo (!empty($occupation_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $occupation; ?>">
                        <option value="podcast">Podcast</option>
                        <option value="hospedagem">Hospedagem</option>
                        <option value="fotografia">Fotografia</option>
                        <option value="spa">Spa</option>
                        <option value="bronzeamento">Bronzeamento</option>
                        <option value="eventos">Eventos</option>
                        <option value="coworking">Coworking</option>
                        <option value="marketing">Marketing</option>
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
                    <input type="text" name="currency" id="currency" pattern="^\R$\r$\d{1,3}(,\d{3})*(\.\d+)?$" value="" data-type="currency" placeholder="R$1000" class="form-control <?php echo (!empty($currency_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $currency; ?>">
                    <span class="invalid-feedback"><?php echo $currency_err; ?></span>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Redefinir">
                    <a class="btn btn-link ml-2" href="index.php">Cancelar</a>
                </div>
            </form>
        </div>  
    </center>   
</body>
</html>