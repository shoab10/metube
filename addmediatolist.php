<?php
session_start();
include_once "function.php";
include_once "sql.php";
$username=$_SESSION['username'];
$mediaid = $_GET['mediaid'];

$pid=$_GET['pid'];
if($pid!='none')
{
	$query="SELECT * from playlistmedia where mediaid ='$mediaid' and pid ='$pid'";
	$result=mysql_query($query);
	if(mysql_num_rows($result))
	{
		echo "media already exists";
	}
	else
	{
		$query="INSERT into playlistmedia values('$pid','$mediaid')";
		mysql_query($query) or die("cannot insert friend in group");
		echo " added Successfully";

	}
}
else
{
	echo "Select a playlist!";
}



?>