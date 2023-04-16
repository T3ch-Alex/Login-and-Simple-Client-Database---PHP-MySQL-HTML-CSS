<?php
include("protect.php");
include("dbconnect.php");
include("utils.php");
$errorMessage = null;
$disableInput = null;

$idUsuario = $_SESSION['id'];
$idClienteEdit = $_SESSION['clienteID'];

//Client edit query
$sql_client_code = "SELECT * FROM clientes WHERE idCliente = '$idClienteEdit'";
$sql_client_query = $mysqli->query($sql_client_code) or die('Falha na execução do SQL: clients query');
$sql_client_result = $sql_client_query->num_rows;

if($sql_client_result > 0){
  while($row = $sql_client_query->fetch_assoc()) {
    //Storing each value from the client
    $nomeClienteEdit = $row['nomeCliente'];
    $emailClienteEdit = $row['emailCliente'];
    $telClienteEdit = $row['telCliente'];
  }
} else { die("Algo deu errado, tente novamente.");}

if(isset($_POST['saveData'])) {
  $nomeCliente = $mysqli->real_escape_string($_POST['nomeCliente']);
  $emailCliente = $mysqli->real_escape_string($_POST['emailCliente']);
  $telCliente = $mysqli->real_escape_string($_POST['telCliente']);

  //User query
  $sql_codeId = "SELECT * FROM usuarios WHERE id = '$idUsuario'";
  $sql_queryId = $mysqli->query($sql_codeId) or die('Falha na execução do SQL: Id query');
  $resultQueryId = $sql_queryId->num_rows;
    
  if($resultQueryId > 1) {
    die("Algo deu errado, atualize a página e faça login novamente.");
  } else {
    //Editing client query
    $sql_codeEditClient = "UPDATE clientes SET nomeCliente = '$nomeCliente', emailCliente = '$emailCliente', telCliente = '$telCliente' WHERE idCliente = '$idClienteEdit' AND idUsuario = '$idUsuario';";
    $sql_queryEditClient = $mysqli->query($sql_codeEditClient) or die('Falha na execução do SQL: AddClient query');
    
    header("Location: account.php");
  }
} else if(isset($_POST['discardData'])) {
  $disableInput = "required";
  header("Location: account.php");
}
?>

<html lang="pt-br">
  <title>Edit Client</title>
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
        <input type="text" name="nomeCliente" pattern="[a-zA-Z0-9]+" <?php echo $disableInput; ?> minlength="3" maxlength="16"  title="Nome inválido" value="<?php echo $nomeClienteEdit;?>">
        <label>E-mail</label>
        <input type="text" name="emailCliente" pattern="[^@\s]+@[^@\s]+" <?php echo $disableInput; ?> title="E-mail inválido" placeholder="email@example.com" value="<?php echo $emailClienteEdit;?>">
        <label>Telefone</label>
        <input type="number" name="telCliente" <?php echo $disableInput; ?> minlength="10" maxlength="11" title="Telefone inválido" placeholder="(01)2345-6789" value="<?php echo $telClienteEdit;?>">
        </input>
      </div>
    </form>
    <div class="footerSpacer"></div>
    <footer>
      <a>This is the footer ok :} Copyright 2023.</a>
    </footer>
  </body>
</html>