<?php
    // The only include you need
    include('../includes/json.php');
  
    use \Simple\json;
    
    $json = new json();
  
    // Ojects to send (fetched from the DB for example)
    $object = new stdClass();
    $object->LastLog = '123456789123456';
    $object->Password = 'Mypassword';
    $object->Dramatic = 'Cat';
    $object->Things = array(1,2,3);
    
    // Forge the JSON
    $json->data = $object;
    $json->user = AlexisTM;
    $json->status = 'online';
    
    // Send the JSON
    $json->send_var('someVar');
  
  /*
  Expected result : 
   var someVar = {
   	"data": {
   		"LastLog": "123456789123456",
   		"Password": "Mypassword",
   		"Dramatic": "Cat",
   		"Things": [1, 2, 3]
   	},
   	"user": "AlexisTM",
   	"status": "online"
   };

  Result : 
  var someVar = {"data":{"LastLog":"123456789123456","Password":"Mypassword","Dramatic":"Cat","Things":[1,2,3]},"user":"AlexisTM","status":"online"};
  
  VALIDATED BY http://jsonlint.com/
  //*/
?>