<?php
include "sql.php";

function register($username,$password,$email)
{
	$query="insert into account (username,password,email) values ('$username','$password','$email')";
	//echo $query;
	$a=sql_query($query);

}

function checkUserNameExists($username)
{
	$query="select username from account where username='$username'";
	$result=sql_query($query);
	return $result;
}