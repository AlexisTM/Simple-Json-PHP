<?php
require('./includes/json.php');
class Phpunit extends PHPUnit_Framework_TestCase
{
    public function testRaw()
    {
        $Json = new json();
        $this->buildJson($Json);
        $this->assertJsonStringEqualsJsonString($Json->json_make(),
            '{"width": "565px","Text": "You are logged IN","An_Object": {"test":"OK"},"An_Array": ["1","2","3"],"A_Json": {"Hello" : "darling"}}');
    }
    public function testFunction()
    {
        $Json = new json('callback', 'function');
        $this->buildJson($Json);
        $this->assertEquals($Json->json_make(),
            'function({"width": "565px","Text": "You are logged IN","An_Object": {"test":"OK"},"An_Array": ["1","2","3"],"A_Json": {"Hello" : "darling"}});');
    }
    public function testVar()
    {
        $Json = new json('var', 'name');
        $this->buildJson($Json);
        $this->assertEquals($Json->json_make(),
            'var name = {"width": "565px","Text": "You are logged IN","An_Object": {"test":"OK"},"An_Array": ["1","2","3"],"A_Json": {"Hello" : "darling"}};');
    }
    private function buildJson($Json){
        $object = new stdClass();
        $object->test = 'OK';

        $arraytest = array('1','2','3');
        $jsonOnly = '{"Hello" : "darling"}';

        $Json->addContent(new propertyJson('width', '565px'));
        $Json->addContent(new textJson('You are logged IN'));
        $Json->addContent(new objectJson('An_Object', $object));
        $Json->addContent(new arrayJson("An_Array",$arraytest));
        $Json->addContent(new jsonJson("A_Json",$jsonOnly));
    }
}
?>