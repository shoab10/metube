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

function user_pass_check($username,$password)
{
	$query = "select * from account where username='$username'";
	$result = sql_query( $query );
	$row=mysqli_fetch_row($result);
	if(!$row)
	{
		return 1;
		
	}
	/*if($row=mysqli_fetch_array($result))
	{
	   return 1;
	   //die ("user_pass_check() failed. Could not query the database: <br />". mysql_error());
	}
	*/
	else{
		if(strcmp($row[2],$password))
			return 2; //wrong password
		else 
			return 0; //Checked.
	}
}