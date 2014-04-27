
<?php
session_start();
include_once "..\\function.php";
include_once "..\sql.php";
echo $_SESSION['accid'];
$accid=$_SESSION['accid'];
$comment=$_POST['comment'];
$mediaid=$_POST['mediaid'];
$query="insert into comments (mediaid,accid,comment) values ('$mediaid','$accid','$comment')";
echo $query;
$result=mysql_query($query);
//header('Location: ..\home.php');
?>