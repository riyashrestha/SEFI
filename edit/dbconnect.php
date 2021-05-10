<?php
	$hostname = 'localhost';
    	$husername = 'gilberlu';
    	$hpassword = 'gilberlu';
	$dbname = "gilberlu_db";

	$link = mysql_connect($hostname, $husername, $hpassword);

	if(!$link)
	{
   		die('Could not connect to database: ' . mysql_error());
	}

	$db_select = mysql_select_db($dbname);

	if(!$db_select)
	{
    		die('Can\'t use ' . $dbname . ': ' . mysql_error());
	}




?>