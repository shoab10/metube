<?php
session_start();
include_once "..\\function.php";
include_once "..\sql.php";
$accid=$_SESSION['accid'];
$mediaid=$_GET['id'];
$query="insert into likes (mediaid,accid) values ('$mediaid','$accid')";
mysql_query($query);
$likequery = "SELECT COUNT(*) FROM likes WHERE mediaid='".$_GET['id']."'";
$likeresult = mysql_query( $likequery );
$likes=mysql_fetch_array($likeresult);
echo $likes[0];
?>