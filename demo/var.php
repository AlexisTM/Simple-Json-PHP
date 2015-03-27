<?php
  // The only include you need
	include('../includes/json.php');
	
	// Create a raw JSON
	$Json = new json('var', 'oneVariable');

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
  var oneVariable = {
    "width"     : "565px",
    "text"      : "You are logged IN",
    "An_Object" : { "test" : "OK"},
    "An_Array"  : ["1","2","3"],
    "A_Json"    : { "Hello" : "Darling"}
  };

  Result : 
  var oneVariable = {"width": "565px","Text": "You are logged IN","An_Object": {"test":"OK"},"An_Array": ["1","2","3"],"A_Json": {"Hello" : "darling"}};
  
  Result in Chrome Console : 
  > oneVariable
  > Object {width: "565px", Text: "You are logged IN", An_Object: Object, An_Array: Array[3], A_Json: Object}
  
  PASSED
  //*/

	// Send the JSON
	json_send($Json);
?>