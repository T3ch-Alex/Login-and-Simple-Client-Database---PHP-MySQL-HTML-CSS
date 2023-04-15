<?php 
  function customError($message) {
    $page = $_SERVER['PHP_SELF'];
    echo "
      <div class='errorWindow'> 
        <div>$message</div> 
        <a class='crudButton' id='closeButton' href='$page'>
          <i class='fa fa-close'></i>
        </a>
      </div>
    ";
  }
?>