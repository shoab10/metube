<?php
session_start();
include_once "function.php";
include_once "sql.php";
$username=$_SESSION['username'];
$accid=$_SESSION['accid'];
$gid=$_SESSION['gid'];

$fname=$_GET['fname'];
if($fname!='none')
{
	$query="SELECT * from groupmembers where gid ='$gid' and username ='$fname'";
	$result=mysql_query($query);
	if(mysql_num_rows($result) > 0)
	{
		echo "Member already added";
	}
	else
	{
		$query="INSERT into groupmembers (gid,username) values('$gid','$fname')";
		mysql_query($query) or die("cannot insert friend in group");
		echo $fname." added Successfully";

	}
}
else
{
	echo "Select member!";
}



?>