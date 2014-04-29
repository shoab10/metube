<?php
session_start();
include_once "function.php";
include_once "sql.php";
$username=$_SESSION['username'];
$to=$_GET['to'];
$message=$_GET['message'];
if(isset($_GET['compose']))
{
	$query="SELECT * from account where username='$to'";
	$result=mysql_query($query) or die("Cannot Send message.Invalid Username.Please Go Back and send again");
	if(mysql_num_rows($result)==0)
		{echo "Cannot Send message.Invalid Username.Please Go Back and send again";
		}
	else
	{
		$query="INSERT INTO messages (sender,receiver,message) values ('$username','$to','$message')";
		//echo $query;
		mysql_query($query) or die("cannot send message");
	}

}

else
{$query="INSERT INTO messages (sender,receiver,message) values ('$username','$to','$message')";
//echo $query;
mysql_query($query) or die("cannot send message");
}
?>