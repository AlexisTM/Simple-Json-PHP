<?php
require('./includes/json.php');
use \Simple\json;
class Phpunit extends PHPUnit_Framework_TestCase
{
    public function testRawJson()
    {
        $json = new json();
        $this->buildJson($json);
        $this->assertEquals($json->make(),
            '{"status":200,"worked":true,"things":false,"friend":{"FirstName":"John","LastName":"Doe"},"arrays":[1,"2","Pieter",true]}');
    }
    
    public function testCallback()
    {
        $json = new json();
        $this->buildJson($json);
        $this->expectOutputString('callback({"status":200,"worked":true,"things":false,"friend":{"FirstName":"John","LastName":"Doe"},"arrays":[1,"2","Pieter",true]});');
        $json->send_callback('callback');
    }
    
    public function testVar()
    {
        $json = new json();
        $this->buildJson($json);
        $this->expectOutputString('var myVar = {"status":200,"worked":true,"things":false,"friend":{"FirstName":"John","LastName":"Doe"},"arrays":[1,"2","Pieter",true]};');
        $json->send_var('myVar');
    }
    
    private function buildJson($json){
        $object = new stdClass();
        $object->FirstName = 'John';
        $object->LastName = 'Doe';
        $array = array(1,'2', 'Pieter', true);
        // Add objects to send
        $json->status = 200;
        $json->worked = true;
        $json->things = false;
        $json->friend = $object;
        $json->arrays = $array;
    }
    public function testPropertyJson()
    {
        $json = new json();
        $json->width = '565px';
        $this->assertEquals($json->make(),
            '{"width":"565px"}');
    }
    public function testBoolDef()
    {
        $json = new json();
        $json->success = true;
        $this->assertEquals($json->make(),
            '{"success":true}');
    }
    public function testBool()
    {
        $json = new json();
        $json->success = false;
        $this->assertEquals($json->make(),
            '{"success":false}');
    }
    public function testArrayJson()
    {
        $json = new json();
        $arraytest = array('1','2','3');
        $json->An_Array = $arraytest;
        $this->assertEquals($json->make(),
            '{"An_Array":["1","2","3"]}');
    }
    public function testObjectJson()
    {
        $json = new json();
        $object = new stdClass();
        $object->test = 'OK';
        $json->An_Object = $object;
        $this->assertEquals($json->make(),
            '{"An_Object":{"test":"OK"}}');
    }
}
?>
