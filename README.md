JSONAPI
=======

Introduction
-------
The JSON API makes you able to create your own API easily by passing PHP objects, PHP Array, JsonString or adding a single property.

It has been coded in PHP Objects to make it easy and it is encoded with json_encode() to be really fast and you do not have to worries about the headers! The *json_send()* makes sure there is no cache, the last JSON has expired and makes sure the Content-type is application/json!

With this library, you will be able to store the *JSON in a variable*, *fire a callback* (Dynamic script loading or JSONP) or deal with the *JSON inside an AJAX request* (JQuery).

Usage
-------
To use create your own JSON API, you just need to include the 'include.php' file.
	
	include('includes/json.php');

Then create your PHP Object
	
	// Set a variable ; var name = {}
	$Json = new json('var', 'name'); 
	// Fire a callback ; callback({});
	$Json = new json('callback', 'name'); 
	// Just send a raw JSON ; {}
	$Json = new json();

The 'type' parameter could be 'function', 'var' or blank.

The 'name' parameter is the name of the callbak/variable.

Next, add the objects, property, array you want.

	$Json->addContent(new propertyJson('width', '565px'));
	$Json->addContent(new textJson('You are logged IN'));
	$Json->addContent(new objectJson('An_Object', $object));
	$Json->addContent(new arrayJson("An_Array",$arraytest));
	$Json->addContent(new jsonJson("A_Json",$jsonOnly));

Finally, send the JSON.

	json_send($Json)

addContent:
--------

The propertyJson allow you to send a variable or a debug information :

	$Json->addContent(new propertyJson('width', '565px'));
	> {"width" : "565px"}

The textJson is just a propertyJSON with the "text" name. It results in :

	$Json->addContent(new textJson('You are logged IN'));
	> {"text" : "You are logged IN"}

The objectJson makes you able to send your object and give him a name :

	$object = new stdClass();
	$object->test = 'OK';
	$Json->addContent(new objectJson('An_Object', $object));
	> {"An_Object" , {"test" : "OK"}}

The arrayJson makes you able to send your array and give him a name :

	$arraytest = array('1','2','3');
	$Json->addContent(new arrayJson("An_Array",$arraytest));
	> {"An_Array": ["1","2","3"]}

The jsonJson makes you able to send any preformated JSON text. There is no verification and it is "unsafe" to use because you could break your JSON. Use at your own risk

	$jsonOnly = '{"Hello" : "darling"}';
	$Json->addContent(new jsonJson("A_Json",$jsonOnly));
	> {"A_Json": {"Hello" : "darling"}}

Contribute
----------

To contribute, just contact me! The first fork will be awesome for me!

mailto:alexis.paques@gmail.com


Licence
--------
This work is under GPLv2 licence. Short version : You have to add Alexis Paques in the credits, you are free to use, modify and redistribute but your code must be open-source.

For any change (entreprises), feel free to contact me.

mailto:alexis.paques@gmail.com

References
----------

Informations : https://en.wikipedia.org/wiki/JSONP

Validator : http://json.parser.online.fr

ECMA-404 : http://www.ecma-international.org/publications/files/ECMA-ST/ECMA-404.pdf

json_encode : https://php.net/manual/fr/function.json-encode.php

Credits 
--------

Alexis PAQUES
