<?php 
session_start();
include_once "function.php";
include_once "sql.php";
$username=$_SESSION['username'];
$accid=$_SESSION['accid'];

$mediaid = $_GET['mid'];
$ratequery1 = "SELECT AVG( rating ) AS score FROM  `mediarating` WHERE mediaid = $mediaid";
$rateresult1 = mysql_query($ratequery1);
$result_row=mysql_fetch_assoc($rateresult1);
echo $result_row['score'];


//$rate = $_GET['rid'];
$ratequery = "SELECT * FROM mediarating  WHERE mediaid= $mediaid and accid=$accid";
  $rateresult = mysql_query( $ratequery );
  if(mysql_num_rows($rateresult)==0)
  {
  	$ratequery = "INSERT INTO mediarating values('$accid','$mediaid','$rate')";
  	mysql_query($ratequery);

  	$ratequery1 = "SELECT AVG( rating ) AS score FROM  `mediarating` WHERE mediaid = $mediaid";
  	$rateresult1 = mysql_query($ratequery1);
  	$result_row=mysql_fetch_assoc($rateresult1);
  	echo $result_row['score'];
  }

  else
  {
  	$ratequery1 = "SELECT AVG( rating ) AS score FROM  `mediarating` WHERE mediaid = $mediaid";
  	$rateresult1 = mysql_query($ratequery1);
  	$result_row=mysql_fetch_assoc($rateresult1);
  	echo $result_row['score'];
  	echo "already rated";
  }



  if(isset($_GET['rate']))
  {
    $rate=$_GET['rate'];







  }
?>