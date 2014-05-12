<?php
	include('../../includes.php');
	$error = 0;
	$valid = 0;
	$type = 'raw';
	$callback = 'raw';
	// JSON Configuration
	if(isset($_GET['callback'])){
		if(!is_null($_GET['callback'])){
			$type = 'function';
			$callback = htmlspecialchars($_GET['callback']);
		}
		else {
			$type = 'raw';
			$callback = 'raw';
		}
	} elseif(isset($_GET['varback'])){
		if(!is_null($_GET['varback'])){
			$type = 'var';
			$callback = htmlspecialchars($_GET['varback']);
		}
		else {
			$type = 'raw';
			$callback = 'raw';
		}
	}
	else {
		$type = 'raw';
		$callback = 'raw';
	}
	// New JSON
	$json = new json($type,$callback);

	// Test Inputs
	if(isset($_GET['username'])){
		if(!is_null($_GET['username'])){
			$username = htmlspecialchars($_GET['username']);
		} else {
			$error = 1;
			$json->addContent(new propertyJson('ErrorUsername', 'Username is null'));
		}
	}
	else {
		$error = 1;
		$json->addContent(new propertyJson('ErrorUsername', 'Username is not defined'));
	}
 	if(isset($_GET['password'])){
		if(!is_null($_GET['password'])){
			$password = htmlspecialchars($_GET['password']);
		} else {
			$error = 1;
			$json->addContent(new propertyJson('ErrorPassword', 'Password is null'));
		}
	}
	else {
		$error = 1;
		$json->addContent(new propertyJson('ErrorPassword', 'Password is not defined'));
	}

	// If Error, stop
	if($error){
		$json->addContent(new propertyJson('STATUT', 'ERROR'));
	} else {
		// Else, password check
		$md5_password = md5($username . $password . MD5SALT);
		$mysql = new mysqli(DBHOST, DBUSER, DBPASS, DB);
		$mysql->set_charset ( 'utf8' );
		$result = $mysql->query("SELECT `password` FROM `user` WHERE `username` = '{$username}'");
		if (!$result) {
	    	throw new Exception("Database Error");
		} else {
			$row = $result->fetch_assoc();
			if($md5_password = $row['password']) {
				$valid = 1;
			}
		}
	}
	
	// If Valid, connect user
	if($valid){
		$json->addContent(new propertyJson('STATUT', 'LOGGED IN'));
		$json->addContent(new propertyJson('username', "{$username}"));
	}
	/* GetData
		$mysql = new mysqli(DBHOST, DBUSER, DBPASS, DB);
		$mysql->set_charset ( 'utf8' );
		$result = $mysql->query("SELECT * FROM `user` WHERE `username` = '{$username}' ");
		$row = $result->fetch_assoc();
	//*/

	/* INSERTION
		INSERT INTO `test`.`user` (`ID`, `username`, `password`, `email`, `website`, `date_subscription`, `last_edition`, `first_name`, `second_name`, `last_name`, `adress_line1`, `adress_line2`, `city`, `country`, `postcode`, `telephone`, `fax`) VALUES ('0', 'AlexisTM', '7662f5b8bae018ec617c2ed932326f12', 'alexis.paques@gmail.com', 'alexis.paques@gmail.com', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, 'Alexis', 'Pascal', 'Paques', '73, drève de la ferme', NULL, 'Tilly', 'Belgium', '1970', '+32496203699', NULL);
	//*/
	$json->addContent(new objectJson("USERAGENT", $_SERVER));
	json_send($json);
	/*
	$Json = new json('raw', 'type');
	$object = new stdClass();
	$object->test = 'coucou';
	$arraytest = array('1','2','3');
	$Json->addContent(new propertyJson('A_Property', '565px'));
	$Json->addContent(new textJson('OKAI, it is working'));
	$Json->addContent(new objectJson('An_Object', $object));
	$Json->addContent(new arrayJson("An_Array",$arraytest));
	json_send($Json);//*/
?>