<?php
  // The only include you need
  include('../includes/json.php');
  
  class userDataJSON extends content {
    public function __construct($name, $status, $username, $data){
      $jsonString = new propertyJson('Status', $status)->getJSON();
      $jsonString += new propertyJson('Username', $username)->getJSON();
      $jsonString += new objectJson('UserData', $data)->getJSON();
      $this->json = "\"{$name}\": {$stringifiedObject},";
    }
  }

  // Create a raw JSON
  $Json = new json();

  // Define objects to send
  $object = new stdClass();
  $object->test = 'OK';
  $arraytest = array('1','2','3');
  $jsonOnly = '{"Hello" : "darling"}';

  // Add objects to send
  $Json->addContent(new propertyJson('width', '565px'));
  $Json->addContent(new textJson('You are logged IN'));
  $Json->addContent(new objectJson('An_Object', $object));
  $Json->addContent(new arrayJson("An_Array",$arraytest));
  $Json->addContent(new jsonJson("A_Json",$jsonOnly));

  /*
  Expected result : 
  {
    "width"     : "565px",
    "text"      : "You are logged IN",
    "An_Object" : { "test" : "OK"},
    "An_Array"  : ["1","2","3"],
    "A_Json"    : { "Hello" : "Darling"}
  }

  Result : 
  {"width": "565px","Text": "You are logged IN","An_Object": {"test":"OK"},"An_Array": ["1","2","3"],"A_Json": {"Hello" : "darling"}}

  PASSED
  //*/

  // Send the JSON
  json_send($Json);
?>