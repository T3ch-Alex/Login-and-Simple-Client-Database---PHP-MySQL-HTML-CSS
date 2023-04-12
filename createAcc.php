<?php
  include('dbconnect.php');
  include('utils.php');
  
  if(isset($_POST['criarConta'])) {
    $nomeCriar = $mysqli->real_escape_string($_POST['nomeCriar']);
    
    $emailCriar = $mysqli->real_escape_string($_POST['emailCriar']);
    $confirmeEmail = $mysqli->real_escape_string($_POST['confirmeEmail']);
    
    $senhaCriar = $mysqli->real_escape_string($_POST['senhaCriar']);
    $senhaCriarHash = password_hash($senhaCriar, PASSWORD_BCRYPT);
    $confirmeSenha = $mysqli->real_escape_string($_POST['confirmeSenha']);
    
    if($confirmeEmail != $emailCriar) {
      customError("E-mails não são iguais");
    } else if($confirmeSenha != $senhaCriar) {
      customError("Senhas não são iguais");
    } else {
      $sql_codeEmail = "SELECT * FROM usuarios WHERE email = '$emailCriar'";
      $sql_queryEmail = $mysqli->query($sql_codeEmail) or die('Falha na execução do SQL: Email query');
      $resultQueryEmail = $sql_queryEmail->num_rows;
        
      if($resultQueryEmail >= 1) {
        customError("Email em uso");
      } else {
        $sql_codeCriar = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nomeCriar', '$emailCriar', '$senhaCriarHash');";
        $sql_queryCriar = $mysqli->query($sql_codeCriar) or die('Falha na execução do SQL: createAcc query');
        
        header("Location: index.php");
      }
    }
  }
  function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
  }
?>

<!DOCTYPE html>
<html lang="pt-br">
  <title>Criar Conta</title>
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
      <p>Crie sua conta abaixo!</p>
      <p>
        <label>Nome</label>
        <br>
        <input type="text" name="nomeCriar" pattern="[a-zA-Z0-9]+" required minlength="3" maxlength="16" title="Nome inválido" placeholder="Seu nome"/>
      </p>
      <hr></hr>
      <p>
        <label>E-mail</label>
        <br>
        <input type="text" name="emailCriar" required pattern="[^@\s]+@[^@\s]+" title="E-mail inválido" placeholder="email@example.com"/>
      </p>
      <p>
        <label>Confirme e-mail</label>
        <br>
        <input type="text" name="confirmeEmail" required pattern="[^@\s]+@[^@\s]+" title="E-mail inválido" placeholder="email@example.com"/>
      </p>
      <hr></hr>
      <p>
        <label>Senha</label>
        <br>
        <input type="password" name="senhaCriar" required minlength="6" maxlength="16" title="Senha inválida"/>
      </p>
      <p>
        <label>Confirme senha</label>
        <br>
        <input type="password" name="confirmeSenha" required minlength="6" maxlength="16" title="Senha inválida"/>
      </p>
      <p>
        <button class="formButton" type="submit" name="criarConta" value="criarConta">Criar Conta</button> Ou 
        <a href="index.php" >Fazer login</a>
      </p>
    </form>
    <footer>
      <a>This is the footer ok :} Copyright 2023.</a>
    </footer>
  </body>
</html>