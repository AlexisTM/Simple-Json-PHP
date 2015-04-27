<?php
  // The only include you need
  include('../includes/json.php');
  
  class userDataJSON extends content {
    public function __construct($status, $username, $data){
      $json = new json();
      $json->add('Status', $status);
      $json->add('Username', $username);
      $json->add('UserData', $data);
      $json->add('Success');
      $this->json = $json->make();
    }
    public function get(){
      return $this->json;
    }
  }

  $json = new json();

  // Define objects to send
  $object = new stdClass();
  $object->LastLog = '123456789123456';
  $object->Password = 'Mypassword';
  $object->Dramatic = 'Cat';
  $object->Things = array(1,2,3);
  $userData = new userDataJSON('Online', 'AlexisTM', $object);
  
  // Add objects to send as "pure JSON"
  $json->add('data', $userData->get(), false);

  /*
  Expected result : 
  {
      "data": {
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
          },
          "Success": true
      }
  }

  Result : 
  {"data": {"Status": "Online","Username": "AlexisTM","UserData": {"LastLog":"123456789123456","Password":"Mypassword","Dramatic":"Cat","Things":[1,2,3]},"Success": true}}
 
  VALIDATED BY http://jsonlint.com/
  //*/

  // Send the JSON
  $json->send();
?>