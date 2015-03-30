Simple JSON for PHP  [![Build Status](https://travis-ci.org/AlexisTM/Simple-Json-PHP.svg?branch=master)](https://travis-ci.org/AlexisTM/Simple-Json-PHP)
===================

Introduction
-------
Simple JSON for PHP makes you able to create your own JSON-API easily by passing PHP objects, PHP Array, JsonString or adding a single property.

Pros : 
* Easy      : Coded with PHP Objects
* Fast      : JSON are encoded with the native json_encode()
* Reliable  : Headers are send automatically
* Modulable : You can extend the 'content' class to make a custom JSON
* Complete  : You can add objects, properties or arrays
* Callback/Variable or raw option 
* JSONP compatible
* JQuery compatible

Usage
-------

```php
// Include the json class
include('includes/json.php');

// Then create the PHP-Json Object to suits your needs

// Set a variable ; var name = {}
$Json = new json('var', 'name'); 
// Fire a callback ; callback({});
$Json = new json('callback', 'name'); 
// Just send a raw JSON ; {}
$Json = new json();

// Add some content
$Json->addContent(new propertyJson('width', '565px'));
$Json->addContent(new textJson('You are logged IN'));
$Json->addContent(new objectJson('An_Object', $object));
$Json->addContent(new arrayJson("An_Array",$arraytest));
$Json->addContent(new jsonJson("A_Json",$jsonOnly));

// Finally, send the JSON.

json_send($Json)
```

addContent:
--------

The propertyJson allow you to send a variable or a debug information :

```php
$Json->addContent(new propertyJson('width', '565px'));
> {"width" : "565px"}
```

The textJson is just a propertyJSON with the "text" name. It results in :

```php
$Json->addContent(new textJson('You are logged IN'));
> {"text" : "You are logged IN"}
```

The objectJson makes you able to send your object and give him a name :

```php
$object = new stdClass();
$object->test = 'OK';
$Json->addContent(new objectJson('An_Object', $object));
> {"An_Object" , {"test" : "OK"}}
```

The arrayJson makes you able to send your array and give him a name :

```php
$arraytest = array('1','2','3');
$Json->addContent(new arrayJson("An_Array",$arraytest));
> {"An_Array": ["1","2","3"]}
```

The jsonJson makes you able to send any preformated JSON text. There is no verification and it is "unsafe" to use because you could break your JSON. Use at your own risk

```php
$jsonOnly = '{"Hello" : "darling"}';
$Json->addContent(new jsonJson("A_Json",$jsonOnly));
> {"A_Json": {"Hello" : "darling"}}
```

Extend the class
----------

I think the class is complete, but maybe you need something special like a complex content, you can extend the 'content' abstract class. 
Then define the $json variable with the JSON text in the constructor.
Make sure there is a comma at the end.
If your class is meaningful for any user, feel free to contact me to add it in the lib.

```php
class userDataJSON extends content {
  public function __construct($status, $username, $data){
    $jsonString = (new propertyJson('Status', $status))->getJSON();
    $jsonString .= (new propertyJson('Username', $username))->getJSON();
    $jsonString .= (new objectJson('UserData', $data))->getJSON();
    $this->json = $jsonString;
  }
}
```


Validating JSON
----------

To validate the JSON, you can grab back the JSON string via the make() method then pass it through an other library.

```php
$JsonString = $Json->make();
```

Knows dumb errors
----------

The file format of the PHP script MUST be UTF-8 *Without* BOM. Else the JSON is corrupted for the JQuery AJAX request. You can bypass the file format by asking text and not JSON type in the JQuery request and using JSON.Parse yourself.

You MAY NOT use ANY echo in the script. The only things that can write on the page is json_send()! Else it corrupt again the json.


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

Comparaison of JSON PHP libs : http://gggeek.altervista.org/sw/article_20061113.html

JSON API Standard : http://jsonapi.org/

Credits 
--------

Alexis PAQUES

Sébastien COMBÉFIS (for Travis integration)