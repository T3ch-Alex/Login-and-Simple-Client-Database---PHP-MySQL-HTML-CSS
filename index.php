<?php
  include('dbconnect.php');
  include('utils.php');

  $errorMessage = null;
?>

<!DOCTYPE html>
<html lang="pt-br">
  <title>Início</title>
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
      <a class="textContainer">Olá, faça login para continuar!</a>
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
    <div class="homeMessage">Seja bem vindo ao meu projeto :)</div>
    <a class="linkButton" href="login.php">Faça Login</a>
    <div class="footerSpacer"></div>
    <footer>
      <a>This is the footer ok :} Copyright 2023.</a>
    </footer>
  </body>
</html>