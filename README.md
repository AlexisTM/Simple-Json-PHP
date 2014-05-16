JSONAPI
=======

Introduction
-------
The JSON API makes you able to create your own API easily.
It has been coded in PHP Objects to make it easy. It use json_encode() to be really fast.

Usage
-------
To use create your own JSON API, you just need to include the 'include.php' file.
`include('../../includes.php');`

Then create your PHP Object
`$json = new json('type', 'name')`
The 'type' parameter could be 'function', 'var' or 'raw' 
The 'name' parameter is the name of the callbak function/JS variable
For example : json('function','test') will return test({})

Next, add the objects, property, array you want.

`$Json->addContent(new propertyJson('A_Property', '565px'));
$Json->addContent(new textJson('OKAI, it is working'));
$Json->addContent(new objectJson('An_Object', $object));
$Json->addContent(new arrayJson("An_Array",$arraytest));`

The textJson object is a property with the name "Text". It is used to give a message like "Logged in", "Not logged in" or errors.

The last step is to send the JSON
json_send($Json);