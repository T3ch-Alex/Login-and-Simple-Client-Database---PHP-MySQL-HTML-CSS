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
  <div class="headerSpacer"></div>
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
      <select class="clientsContainer" name="selectedClients" multiple>
          <?php
          include("dbconnect.php");
          $idUsuario = $_SESSION['id'];
          $sql_clients_code = "SELECT * FROM clientes WHERE idUsuario = '$idUsuario'";
          $sql_clients_query = $mysqli->query($sql_clients_code) or die('Falha na execução do SQL: clients query');
          $sql_clients_result = $sql_clients_result->num_rows;
          if($sql_clients_result->num_rows > 0){
            while($row = $sql_clients_result->fetch_assoc()) {
              $idCliente = $row['idClient'];
              $nomeCliente = $row['nomeCliente'];
              $emailCliente = $row['emailCliente'];
              $telCliente = $row['telCliente'];

              echo "<option value='$idCliente'></option>";
            }
          }
          ?>
      </select>
    </div>
    <div class="footerSpacer"></div>
    <footer>
      <p>This is the footer ok :} Copyright 2023.</p>
    </footer>
  </body>
  
</html>