<?php
    session_start();
	//error_reporting(E_ALL);
	include_once("includes/config.php");
//	include_once("includes/database_tables.php"); // To Do
	include_once("includes/classes/database.php");   
	global $db;	  	
	$db = new databaseConnection($host,$db_name,$username,$password);
	$db->connect();
?>