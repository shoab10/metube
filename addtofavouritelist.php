<?php
session_start();
include_once "function.php";
include_once "sql.php";
$username=$_SESSION['username'];
$mediaid = $_GET['mediaid'];

	$query="SELECT * from favourite where mediaid ='$mediaid' and username ='$username'";
	$result=mysql_query($query);
	if(mysql_num_rows($result))
	{
		echo "allready added";
	}
	else
	{
		$query="INSERT into favourite values(NULL,'$mediaid','$username')";
		mysql_query($query) or die("cannot insert friend in group");
		echo " added Successfully";

	}




?>