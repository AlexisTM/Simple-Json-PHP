<?php
  include('../includes/json.php');

  use \Simple;
  
  $json = new Simple\json('var', 'oneVariable');
  
  $json->send();
?>