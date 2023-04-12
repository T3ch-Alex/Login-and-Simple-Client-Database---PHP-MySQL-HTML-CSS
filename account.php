<?php
  include("protect.php");
  include("utils.php");
  
  if(isset($_POST['addClient'])) {
    addClient();
  }
  
  function addClient() {
    header("Location: addClient.php");
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
      <a class="textContainer">Olá <?php echo $_SESSION['nome']; ?>!</a>
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
    <div class="userGreet">
      <p><?php echo $_SESSION['nome'];?>, você tem 0 clientes.</p>
    </div>
    <div class="database">
      <form class="crudForm" action="" method="POST">
        <div class="crudButtons">
          <button class="crudButton" type="submit" id="addUser" name="addClient">
            <i class="fa fa-user-plus"></i>
          </button>
          <button class="crudButton" type="submit" id="editUser" name="editClient">
            <i class="fas fa-edit"></i>
          </button>
          <button class="crudButton" type="submit" id="removeUser" name="removeClient">
            <i class="fa fa-trash"></i>
          </button>
        </div>
        <div class="searchClients">
          <input class="crudInput" type="text"></input>
          <button class="crudButton">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </form>
      <div class="crudForm">
        <p>This is going to be the grid laskkdskskkskskdkdkdkdkskskdjd</p>
      </div>
    </div>
    <footer>
      <p>This is the footer ok :} Copyright 2023.</p>
    </footer>
  </body>
  
</html>