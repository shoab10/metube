
<?php
session_start();
include_once "function.php";
include_once "sql.php";
$username=$_SESSION['username'];
$fusername=$_GET['fusername'];
$freq=$_GET['freq'];
if($freq=='accept')
{
	$query="insert into friendlist (username,fusername,status) values('$username','$fusername',1)";
	$result=mysql_query($query);
	$query="insert into friendlist (username,fusername,status) values('$fusername','$username',1)";
	$result=mysql_query($query);
	$query = "DELETE from friendrequest where username='$fusername' and fusername='$username' and status=0";
	$result=mysql_query($query);
}
else if($freq=='decline')
{
	$query = "DELETE from friendrequest where username='$fusername' and fusername='$username' and status=0";
	$result=mysql_query($query);
}

header('Location: homex.php');
?>