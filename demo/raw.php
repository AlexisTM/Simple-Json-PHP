<?php
  // The only include you need
  include('../includes/json.php');

  use \Simple;
  // Create a raw JSON
  $json = new Simple\json();

  // Define objects to send
  $object = new stdClass();
  $object->FirstName = 'John';
  $object->LastName = 'Doe';
  $array = array(1,'2', 'Pieter', true);
  $jsonOnly = '{"Hello" : "darling"}';
  // Add objects to send
  $json->add('status', '200');
  $json->add("worked");
  $json->add("things", false);
  $json->add('friend', $object);
  $json->add("arrays", $array);
  $json->add("json", $jsonOnly, false);

  /*
  Expected result : 
  {
    "status": "200",
    "worked": true,
    "things": false,
    "friend": {
        "FirstName": "John",
        "LastName": "Doe"
    },
    "arrays": [
        1,
        "2",
        "Pieter",
        true
    ],
    "json": {
        "Hello": "darling"
    }
  }

  Result : 
  {"status": "200","worked": true,"things": false,"friend": {"FirstName":"John","LastName":"Doe"},"arrays": [1,"2","Pieter",true],"json": {"Hello" : "darling"}}
  

  PASSED
  //*/

  $json->send();
?>