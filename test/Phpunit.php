<?php
require('./includes/json.php');
class Phpunit extends PHPUnit_Framework_TestCase
{
    public function testRaw_array()
    {
        $json = new json();
        $this->buildJson($json);
        $this->assertEquals($json->make_array(),
            '["200",true,false,{"FirstName":"John","LastName":"Doe"},[1,"2","Pieter",true],{"Hello" : "darling"}]');
    }
    public function testRaw()
    {
        $json = new json();
        $this->buildJson($json);
        $this->assertEquals($json->make(),
            '{"status": "200","worked": true,"things": false,"friend": {"FirstName":"John","LastName":"Doe"},"arrays": [1,"2","Pieter",true],"json": {"Hello" : "darling"}}');
    }
    public function testFunction()
    {
        $json = new json('callback', 'function');
        $this->buildJson($json);
        $this->assertEquals($json->make(),
            'function({"status": "200","worked": true,"things": false,"friend": {"FirstName":"John","LastName":"Doe"},"arrays": [1,"2","Pieter",true],"json": {"Hello" : "darling"}});');
    }
    public function testFunction_array()
    {
        $json = new json('callback', 'function');
        $this->buildJson($json);
        $this->assertEquals($json->make_array(),
            'function(["200",true,false,{"FirstName":"John","LastName":"Doe"},[1,"2","Pieter",true],{"Hello" : "darling"}]);');
    }
    public function testVar()
    {
        $json = new json('var', 'name');
        $this->buildJson($json);
        $this->assertEquals($json->make(),
            'var name = {"status": "200","worked": true,"things": false,"friend": {"FirstName":"John","LastName":"Doe"},"arrays": [1,"2","Pieter",true],"json": {"Hello" : "darling"}};');
    }
    public function testVar_array()
    {
        $json = new json('var', 'name');
        $this->buildJson($json);
        $this->assertEquals($json->make_array(),
            'var name = ["200",true,false,{"FirstName":"John","LastName":"Doe"},[1,"2","Pieter",true],{"Hello" : "darling"}];');
    }
    private function buildJson($json){
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
    }
    public function testPropertyJson()
    {
        $json = new json();
        $json->add('width', '565px');
        $this->assertEquals($json->make(),
            '{"width": "565px"}');
    }
    public function testBoolDef()
    {
        $json = new json();
        $json->add('success');
        $this->assertEquals($json->make(),
            '{"success": true}');
    }
    public function testBool()
    {
        $json = new json();
        $json->add('success', false);
        $this->assertEquals($json->make(),
            '{"success": false}');
    }
    public function testArrayJson()
    {
        $json = new json();
        $arraytest = array('1','2','3');
        $json->add("An_Array",$arraytest);
        $this->assertEquals($json->make(),
            '{"An_Array": ["1","2","3"]}');
    }
    public function testJsonJson()
    {
        $json = new json();
        $jsonOnly = '{"Hello" : "darling"}';
        $json->add("A_Json",$jsonOnly, false);
        $this->assertEquals($json->make(),
            '{"A_Json": {"Hello" : "darling"}}');
    }
    public function testObjectJson()
    {
        $json = new json();
        $object = new stdClass();
        $object->test = 'OK';
        $json->add('An_Object', $object);
        $this->assertEquals($json->make(),
            '{"An_Object": {"test":"OK"}}');
    }
}
?>
