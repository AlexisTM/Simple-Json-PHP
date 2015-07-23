Simple JSON for PHP  [![Build Status](https://travis-ci.org/AlexisTM/Simple-Json-PHP.svg?branch=master)](https://travis-ci.org/AlexisTM/Simple-Json-PHP)
===================

Introduction
-------
Simple JSON for PHP makes you able to create your own JSON-API easily by passing PHP objects, PHP Array, JsonString or adding a single property.

Pros : 
* Can output Object or Array
* Easy      : Coded with PHP Objects
* Fast      : JSON are encoded with the native json_encode()
* Reliable  : Headers are send automatically
* Modulable : You can extend the 'content' class to make a custom JSON
* Complete  : You can add objects, properties or arrays
* Callback/Variable or raw option 
* JSONP compatible
* JQuery compatible

Cons : 
* Optimized for objects because JSON is an object notation.

Usage
-------

```php
<?php

  include('../includes/json.php');

  $json = new json();

  $object = new stdClass();
  $object->FirstName = 'John';
  $object->LastName = 'Doe';
  $array = array(1,'2', 'Pieter', true);
  $jsonOnly = '{"Hello" : "darling"}';

  $json->add('status', '200');
  $json->add("worked");
  $json->add("things", false);
  $json->add('friend', $object);
  $json->add("arrays", $array);
  $json->add("json", $jsonOnly, false);

  // This will output the legacy JSON
  $json->send();

  // This will output the array, omitting names
  // $json->send_array();
?>
```

new json($type = 'raw', callback='none')
------------------------------------------

The constructor allow you to send JSON, JSONP with callback or in a variable. 

#### Raw JSON

```php
  $json = new json();
  > {  ...  }
```

#### Callback JSONP

```php
  $json = new json('callback', 'myCallback');
  > myCallback({  ...  });
```

#### Varibale JSONP

```php
  $json = new json('var', 'myVariable');
  > var myVariable = {  ...  };
```

add($name, $content = true, $encode = true)
-------------------------------------------

The add method allow you to send anything and convert it to json with ease :

#### Simple property, could be text, boolean, integer, float, object or array

```php
  $json->add('status', 200);
> {"status" : 200}
// array
> [200]
```

#### Bool status : Omit the content and it will send "true" instead. 

```php
  $json->add('status');
> {"status" : true}
// array
> [true]
```

#### If you have a preformated correct JSON, you can add it by setting 'encode' to false, there is no verification, responsability is yours

```php
$jsonOnly = '{"Hello" : "Darling"}';
$json->add("json", $jsonOnly, false);
> {"json" : {"Hello" : "Darling"}}
// array
> [{"Hello" : "Darling"}] 
```

### NOTE : For people who wants an array as output, you can use $json->send_array(); which will ommit names. 

Extend the class
----------

Maybe you need something special like a complex default content, you can extend the 'content' abstract class. 
Then define the $json variable with the JSON text in the constructor. Make sure there is a comma at the end.

Then you can add it like a "raw JSON" by disabling encoding.


```php
  $json = new json();

  class userDataJSON extends content {
    public function __construct($status, $username, $data){
      $json = new json();
      $json->add('Status', $status);
      $json->add('Username', $username);
      $json->add('UserData', $data);
      $json->add('Success');
      $this->json = $json->make();
      //$this->json = $json->make_array();
    }
    public function get(){
      return $this->json;
    }
  }

  $userData = new userDataJSON('Online', 'AlexisTM', $object);
  
  // Add objects to send as "pure JSON"
  $json->add('data', $userData->get(), false);
```

HTML/JS part example
----------

This library give you a strong JSON API capabilities. But an API is useless if you do not have the front-end. Here are some examples.

#### Callback with a raw json using JQuery.ajax 

```javascript
$.ajax({
  dataType: "json",
  url: 'http://example.com',
  data: data,
  done: function(json) {
    alert(json);
  }
}); 
```

#### Callback with a raw json using JQuery.getJSON 

```javascript
$.getJSON('http://example.com',
data,
function(json) {
  alert(json);
});
```

#### Legacy javascript for dynamic loading for JSONP

```javascript
function load_script(url) {
  var s = document.createElement('script'); 
  s.src = url;
  document.body.appendChild(s);
}

function load_scripts() {
  load_script('http://json.api/users/list');
}

window.onload=load_scripts;
```

Validating JSON
----------

To validate the JSON, you can grab back the JSON string via the make() method then pass it through an other library.

```php
$JsonString = $Json->make();
// $JsonString = $Json->make_array();
```

Knows dumb errors
----------

The file format of the PHP script MUST be UTF-8 *Without* BOM. 
Else the JSON is corrupted for the JQuery AJAX request. 
You can bypass the file format by asking text and not JSON type in the JQuery request and using JSON.Parse yourself.

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

What next ?
---------
The next step is obviously to add routes, which is needed to make a powerful API.

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
