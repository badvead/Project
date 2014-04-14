<?php

$mysql_host = "localhost";
$mysql_database = "gbdata";
$mysql_user = "root";
$mysql_password = "";

$db = mysql_connect($mysql_host,$mysql_user,$mysql_password)or die("Error connecting to database."); 
mysql_select_db($mysql_database, $db)or die("Couldn't select the database."); 

include_once('function.php');

