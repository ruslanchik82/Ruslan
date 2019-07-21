<?php

	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');
	define('DB_NAME', 'base');
	 
	$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
	mysqli_query($connection,"SET NAMES utf8");

	if($connection === false)
	{
		die(mysqli_connect_error());
	}
	
	
