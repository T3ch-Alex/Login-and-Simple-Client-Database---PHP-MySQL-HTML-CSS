<?php
  include('dbconnect.php');
  include('utils.php');
 
  if(isset($_POST['email']) || isset($_POST['senha'])) {
    if(strlen($_POST['email']) == 0) {
      echo 'Preencha com seu email';
    } else if(strlen($_POST['senha']) == 0) {
      echo 'Preencha com sua senha';
    } else {
      $email = $mysqli->real_escape_string($_POST['email']);
      $senha = $mysqli->real_escape_string($_POST['senha']);
      
      $sql_code = "SELECT * FROM usuarios WHERE email = '$email'";
      $sql_query = $mysqli->query($sql_code) or die('Falha na execução do SQL');
      $quantidade = $sql_query->num_rows;
      
      if($quantidade == 1){
        $usuario = $sql_query->fetch_assoc();
        
        if(password_verify($senha, $usuario['senha'])) {
          if(!isset($_SESSION)) {
            session_start();
          }
          
          $_SESSION['id'] = $usuario['id'];
          $_SESSION['nome'] = $usuario['nome'];
          header("Location: account.php");
        } else {
          customError("Falha no login, e-mail ou senha incorretos");
        }
      } else {
        customError("Falha no login, e-mail ou senha incorretos");
      }
    }
  }

  function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
  }
?>

<!DOCTYPE html>
<html lang="pt-br">
  <title>Login</title>
  <head>
    <meta name="viewport" content="width=device-width,initial-scale=0.7,maximum-scale=0.7,user-scalable=no"/>
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
      <a class="textContainer">Olá, seja bem vindo!</a>
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
  <body>
    <form class="form" id="loginForm" action="" method="POST">
      <p>Faça seu login</p>
      <p>
        <label>E-mail</label>
        <input type="text" name="email"/>
      </p>
      <p>
        <label>Senha</label>
        <input type="password" name="senha"/>
      </p>
      <p>
        <button class="formButton" type="submit">Entrar</button> Ou 
        <a href="createAcc.php">Criar Conta</a>
      </p>
    </form>
    <footer>
      <a>This is the footer ok :} Copyright 2023.</a>
    </footer>
  </body>
</html>