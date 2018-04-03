Simple JSON for PHP  [![Build Status](https://travis-ci.org/AlexisTM/Simple-Json-PHP.svg?branch=master)](https://travis-ci.org/AlexisTM/Simple-Json-PHP)
===================

Introduction
-------

Simple JSON for PHP simplify the `json_encode` function. Instead of creating a Stdclass and then json_encode it, send, headers and echo the json, you can simply create the object and use `$json->send();`.

Pros : 
* Easy      : As simple as a Stdclass, bundled functions.
* Fast      : JSON are encoded with the native json_encode()
* Reliable  : Headers are sent automatically
* Complete  : You can add objects, properties or arrays
* Callback/Variable or simply a JSON option 
* JSONP compatible
* JQuery compatible

Cons : 
* Optimized for objects because JSON is an object notation.

Usage
-------

```php
<?php

    include('../includes/json.php');
  
    use \Simple\json;
    
    $json = new json();
  
    // Ojects to send (fetched from the DB for example)
    $object = new stdClass();
    $object->LastLog = '123456789123456';
    $object->Password = 'Mypassword';
    $object->Dramatic = 'Cat';
    $object->Things = array(1,2,3);
    
    // Forge the JSON
    $json->data = $object;
    $json->user = AlexisTM;
    $json->status = 'online';
    
    // Send the JSON
    $json->send();
?>
```

Sending the json you want
----------------

The constructor allow you to send JSON, JSONP with callback or in a variable. 

#### simply a JSON

```php
  $json->send(options);
  > {  ...  }
```

#### Callback JSONP

```php
  $json->send_callback('myCallback', options);
  > myCallback({  ...  });
```

#### Varibale JSONP

```php
  $json->send_var('myVariable', options);
  > var myVariable = {  ...  };
```

#### Options

Options are the [default options passed to json_encode](http://php.net/manual/en/function.json-encode.php#example-4366).

```php
JSON_HEX_TAG 
echo "Apos: ",    json_encode($a, JSON_HEX_APOS), "\n";
echo "Quot: ",    json_encode($a, JSON_HEX_QUOT), "\n";
echo "Amp: ",     json_encode($a, JSON_HEX_AMP), "\n";
echo "Unicode: ", json_encode($a, JSON_UNESCAPED_UNICODE), "\n";
echo "All: ",     json_encode($a, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE)
```

Will output : 

```bash
Normal: ["<foo>","'bar'","\"baz\"","&blong&","\u00e9"]
Tags: ["\u003Cfoo\u003E","'bar'","\"baz\"","&blong&","\u00e9"]
Apos: ["<foo>","\u0027bar\u0027","\"baz\"","&blong&","\u00e9"]
Quot: ["<foo>","'bar'","\u0022baz\u0022","&blong&","\u00e9"]
Amp: ["<foo>","'bar'","\"baz\"","\u0026blong\u0026","\u00e9"]
Unicode: ["<foo>","'bar'","\"baz\"","&blong&","é"]
All: ["\u003Cfoo\u003E","\u0027bar\u0027","\u0022baz\u0022","\u0026blong\u0026","é"]
```

For example :

```php 
$json->send(JSON_HEX_APOS | JSON_UNESCAPED_UNICODE);
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
$jsonString = $json->make();
```

Knows dumb errors
----------

* The file format of the PHP script MUST be UTF-8 *Without* BOM.  Else the JSON is corrupted for the JQuery AJAX request. 
* You can bypass the file format by asking text and not JSON type in the JQuery request and using JSON, then parsing it yourself.
* If you **don't** use namespaces, you can call the JSON class via `new \Simple\json()`
* If you use `use \Simple;`, you can call the JSON class via `new Simple\json()`
* If you use `use \Simple\json;`, you can call the JSON class via `new json()`


Contribute
----------

To contribute, just contact me! The first fork will be awesome for me!

NOTE : 
--------

The reason it comes in version 4 which changes a bit the API is the speed. I as wondering how fast it was to use the library and after some tests, it shows it was 6 times slower than the native function. Therefore, for my own sake, it has to be reworked. 

It now as fast as the native json_encode, without having to think at all.


Licence
--------

This work is under MIT licence. Short version : You have to add Alexis Paques in the credits but you can use it for closed-source commercial project.

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

Alexis PAQUES (@AlexisTM)
