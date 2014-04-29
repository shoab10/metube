<?php
session_start();
include_once "..\\function.php";
include_once "..\sql.php";
$username=$_SESSION['username'];
$accid=$_SESSION['accid'];
$mediaid = $_GET['mid'];
$ratequery1 = "SELECT AVG( rating ) AS score FROM  `mediarating` WHERE mediaid = $mediaid";
$rateresult1 = mysql_query($ratequery1);
$result_row=mysql_fetch_assoc($rateresult1);
echo $result_row['score'];
?>