
<?php
include_once "function.php";
include_once "sql.php";
$username=$_GET['username'];
$fusername=$_GET['fusername'];
$query="insert into friendrequest (username,fusername,status) values('$username','$fusername',0)";
$result=mysql_query($query);
return 1;
?>