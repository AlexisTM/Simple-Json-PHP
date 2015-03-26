<?php
	include('../../includes.php');
	$Json = new json('raw', 'none');
	$object = new stdClass();
	$object->test = 'coucou';
	$arraytest = array('1','2','3');
	$Json->addContent(new propertyJson('A_Property', '565px'));
	$Json->addContent(new textJson('OKAI, it is working'));
	$Json->addContent(new objectJson('An_Object', $object));
	$Json->addContent(new arrayJson("An_Array",$arraytest));
	json_send($Json);
?>