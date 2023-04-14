<?php 
  function customError($message) {
    echo "
      <p class='errorWindow'>
        $message
      </p>
    ";
  }

  function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}
?>