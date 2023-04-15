<?php
  include("protect.php");
  include("utils.php");
  include("dbconnect.php");
  
  if(isset($_POST['addClient'])) {
    addClient();
  }
  
  function addClient() {
    header("Location: addClient.php");
  }

  if(isset($_POST['editClient'])) {
    if(isset($_POST['checkboxList'])) {
      if(count($_POST['checkboxList']) > 1) {
        customError("Não é possível editar mais de um cliente!");
      } else {
        //header("Location: editClient.php");
      }
    }
  }

  if(isset($_POST['removeClient'])) {
    if(isset($_POST['checkboxList'])) {
      foreach($_POST['checkboxList'] as $clienteID) {
        $sql_code_delete = "DELETE FROM clientes WHERE idCliente = '$clienteID'";
        $sql_query_delete = $mysqli->query($sql_code_delete) or die("Falha na execução da query: Delete Query");
      }
      

      header("Location: account.php");
    }
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
          <button class="crudButton" type="submit" id="editUser" name="editClient" form="clientsForm">
            <i class="fas fa-edit"></i>
          </button>
          <button class="crudButton" type="submit" id="removeUser" name="removeClient" form="clientsForm">
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
      <form id="clientsForm" class="clientsContainer" method="POST">
        <?php
          echo "<table>
            <tr> 
              <th> </th>
              <th> ID </th> 
              <th> Nome </th> 
              <th> E-mail </th> 
              <th> Contato </th> 
            </tr>
          ";

          $idUsuario = $_SESSION['id'];
          $sql_clients_code = "SELECT * FROM clientes WHERE idUsuario = '$idUsuario'";
          $sql_clients_query = $mysqli->query($sql_clients_code) or die('Falha na execução do SQL: clients query');
          $sql_clients_result = $sql_clients_query->num_rows;

          if($sql_clients_result > 0){
            while($row = $sql_clients_query->fetch_assoc()) {
              $idCliente = $row['idCliente'];
              $nomeCliente = $row['nomeCliente'];
              $emailCliente = $row['emailCliente'];
              $telCliente = $row['telCliente'];
              echo "
                <tr>
                    <td><input id='checkClientList' type='checkbox' name='checkboxList[]' value='$idCliente'/></td>
                    <td>$idCliente</td>
                    <td>$nomeCliente</td>
                    <td>$emailCliente</td>
                    <td>$telCliente</td>
                </tr>
              ";
            }
          }
          echo "</table>";
        ?>
      </form>
    </div>
    <div class="footerSpacer"></div>
    <footer>
      <p>This is the footer ok :} Copyright 2023.</p>
    </footer>
  </body>
  
</html>