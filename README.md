JSONAPI
=======

Introduction
-------
The JSON API makes you able to create your own API easily.
It has been coded in PHP Objects to make it easy. 
It use json_encode() to be really fast.
And it allows you to have a variable with data, fire a JS callback or use it as simple JSON object.

Usage
-------
To use create your own JSON API, you just need to include the 'include.php' file.
	
	include('includes/json.php');

Then create your PHP Object
	
	$json = new json('var', 'name');
	$json = new json('function', 'name');
	$json = new json('raw', 'name');

The 'type' parameter could be 'function', 'var' or 'raw' 
The 'name' parameter is the name of the callbak function/JS variable and is unused in case raw.
For example : json('function','test') will return test({})

Next, add the objects, property, array you want.

	$Json->addContent(new propertyJson('A_Property', '565px'));
	$Json->addContent(new textJson('OKAI, it is working'));
	$Json->addContent(new objectJson('An_Object', $object));
	$Json->addContent(new arrayJson("An_Array",$arraytest));

Result
--------

### Type 



### addContent

The last step is to send the JSON

	json_send($Json);
