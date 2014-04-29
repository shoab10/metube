<?php 
session_start();
include_once "function.php";
include_once "sql.php";
$username=$_SESSION['username'];
$accid=$_SESSION['accid'];

$uploader = $_GET['uploader'];
$subscriber = $_GET['subscriber'];

if ($uploader == $subscriber)
{

  echo "own channel";
}


else{
  $query = "SELECT * FROM subscribe  WHERE username = '$uploader' and susername= '$username'";
  $result = mysql_query( $query );
  if(mysql_num_rows($result))
  {
  	$query = "INSERT INTO subscribe values(NULL,'$uploader','$username')";
  	mysql_query($query);

  
  
    echo "subscribed already";
  
  }

  else
  { 
  	$query = "INSERT INTO subscribe values(NULL,'$uploader','$username')";
    mysql_query($query);

  
    echo "subribtion added";
  	
  }
}
?>