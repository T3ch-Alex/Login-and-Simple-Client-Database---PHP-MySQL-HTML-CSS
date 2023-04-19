<?php
include("protect.php");
include("dbconnect.php");
include("utils.php");
$errorMessage = null;
$disableInput = null;

if(isset($_POST['saveData'])) {

  $idUsuario = $_SESSION['id'];
  $nomeCliente = $mysqli->real_escape_string($_POST['nomeCliente']);
  $emailCliente = $mysqli->real_escape_string($_POST['emailCliente']);
  $telCliente = $mysqli->real_escape_string($_POST['telCliente']);

  $sql_codeId = "SELECT * FROM usuarios WHERE id = '$idUsuario'";
  $sql_queryId = $mysqli->query($sql_codeId) or die('Falha na execução do SQL: Id query');
  $resultQueryId = $sql_queryId->num_rows;
    
  if($resultQueryId > 1) {
    die("Algo deu errado, atualize a página e faça login novamente.");
  } else {
    $sql_codeAddClient = "INSERT INTO clientes (idUsuario, nomeCliente, emailCliente, telCliente) VALUES ('$idUsuario', '$nomeCliente', '$emailCliente', '$telCliente');";
    $sql_queryAddClient = $mysqli->query($sql_codeAddClient) or die('Falha na execução do SQL: AddClient query');
    
    header("Location: account.php");
  }
} else if(isset($_POST['discardData'])) {
  $disableInput = "required";
  header("Location: account.php");
}
?>

<html lang="pt-br">
  <title>Adicionar Cliete</title>
  <head>
    <meta name="viewport" content="width=device-width,initial-scale=0.7,maximum-scale=0.7,user-scalable=no"/>
    <link rel="icon" type="image/png" href="favicons/favicon.png">
  </head>
  <style>
    <?php
      $css = file_get_contents('css/styles.css');
      $fontawesome = file_get_contents('css/all.min.css');
      echo $css;
      echo $fontawesome;
    ?>
  </style>
  <header>
    <div class="message">
      <a class="textContainer">Olá 
        <?php 
        if(!$_SESSION['nome']) { 
          echo ", seja bem vindo!";
          } else {
            echo $_SESSION['nome'];
          }
        ?>
      </a>
    </div>
    <div class="navbar">
      <a class="linkButton" href="index.php">
        <i class="fa fa-home"></i>Início
      </a>
      <a class="linkButton" href="account.php">
        <i class="fa fa-user"></i>Conta
      </a>
      <a class="linkButton" href="logout.php">
        <i class="fa fa-sign-out-alt"></i>Sair
      </a>
    </div>
  </header>
  <div class="headerSpacer"></div>
  <?php if(!is_null($errorMessage)) { customError($errorMessage); }?>
  
  <body>
    <form class="crudForm" action="" method="POST">
      <div class="saveForm">
        <button class="crudButton" type="submit" id="saveButton" name="saveData">
          <i class="fa fa-save"></i>
        </button>
        <button class="crudButton" type="submit" id="discardButton" name="discardData">
          <i class="fa fa-trash"></i>
        </button>
      </div>
      <div class="saveForm">
        <label>Nome do cliente</label>
        <input type="text" name="nomeCliente" pattern="[a-zA-Z0-9]+" <?php echo $disableInput; ?> minlength="3" maxlength="16"  title="Nome inválido">
        <label>E-mail</label>
        <input type="text" name="emailCliente" pattern="[^@\s]+@[^@\s]+" <?php echo $disableInput; ?> title="E-mail inválido" placeholder="email@example.com">
        <label>Telefone</label>
        <input type="number" name="telCliente" <?php echo $disableInput; ?> minlength="10" maxlength="11" title="Telefone inválido" placeholder="(01)2345-6789">
        </input>
      </div>
    </form>
    <div class="footerSpacer"></div>
    <footer>
      <a>This is the footer ok :} Copyright 2023.</a>
    </footer>
  </body>
</html>