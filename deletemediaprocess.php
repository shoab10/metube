<?php
session_start();
include_once "function.php";
include_once "sql.php";

$query = "SELECT * FROM media WHERE mediaid=".$_POST['id']."";
echo $query;
  $result = mysql_query( $query );
  $result_row = mysql_fetch_assoc($result);
  $filename=$result_row['filename'];
  $filepath=$result_row['filepath'];
  $file=$result_row['filepath'].$result_row['filename'];

$query="DELETE from media where mediaid='".$_POST['id']."' ";
mysql_query($query) or die ("unable to delete");
echo $query;
unlink ($file);
header('location:mymedia.php')
?>