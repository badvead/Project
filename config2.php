<?php

$mysql_host = "mysql14.000webhost.com";
$mysql_database = "a6352780_getback";
$mysql_user = "a6352780_gbuser";
$mysql_password = "Tommy2010";

$db = mysql_connect($mysql_host,$mysql_user,$mysql_password)or die("Error connecting to database."); 
mysql_select_db($mysql_database, $db)or die("Couldn't select the database."); 

include_once('function.php');

