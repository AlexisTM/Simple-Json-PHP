<?php
  // The only include you need
  include('../includes/json.php');
  
  class userDataJSON extends content {
    public function __construct($status, $username, $data){
      $jsonString = (new propertyJson('Status', $status))->getJSON();
      $jsonString .= (new propertyJson('Username', $username))->getJSON();
      $jsonString .= (new objectJson('UserData', $data))->getJSON();
      $this->json = $jsonString;
    }
  }

  // Create a raw JSON
  $Json = new json();

  // Define objects to send
  $object = new stdClass();
  $object->LastLog = '123456789123456';
  $object->Password = 'Mypassword';
  $object->Dramatic = 'Cat';
  $object->Things = array(1,2,3);

  // Add objects to send
  $Json->addContent(new userDataJSON('Online', 'AlexisTM', $object));

  /*
  Expected result : 
  {
    "Status": "Online",
    "Username": "AlexisTM",
    "UserData": {
        "LastLog": "123456789123456",
        "Password": "Mypassword",
        "Dramatic": "Cat",
        "Things": [
            1,
            2,
            3
        ]
    }
}

  Result : 
  {"Status": "Online","Username": "AlexisTM","UserData": {"LastLog":"123456789123456","Password":"Mypassword","Dramatic":"Cat","Things":[1,2,3]}}

  VALIDATED BY http://jsonlint.com/
  //*/

  // Send the JSON
  json_send($Json);
?>