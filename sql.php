<?php
include_once("config.php");

function sql_connect()
{
	global $dbhost,$dbuser,$dbpass,$database;
	$con=mysqli_connect($dbhost,$dbuser,$dbpass,$database);
	return $con;
}

function sql_query($query)
{
	$con=sql_connect();
	$result = mysqli_query($con,$query);
	return $result;
}

?>