<?php

// Were putting the values into the variable db's array 
$db['db_host'] = "localhost";
$db['db_user'] = "root";
$db['db_password'] = "toor";
$db['db_name'] = "cms_local";

// Convert the keys to capitals using function
foreach($db as $key => $value){
	define(strtoupper($key), $value);
}

//  The keys are capitals so insert them in
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if(!$connection) {
	echo "We are NOT connected.";
}

?>