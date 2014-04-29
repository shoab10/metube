<?php
include "sql.php";

function register($username,$password,$email,$firstname,$lastname,$sex,$dob)
{
	$query="insert into account (username,password,email,firstname,lastname,sex,dob) values ('$username','$password','$email','$firstname','$lastname','$sex','$dob')";
	$a=mysql_query($query);

}

function checkUserNameExists($username)
{
	$query="select username from account where username='$username'";
	$result=mysql_query($query);
	return $result;
}

function upload_error($result)
{
	//view erorr description in http://us2.php.net/manual/en/features.file-upload.errors.php
	switch ($result){
	case 1:
		return "UPLOAD_ERR_INI_SIZE";
	case 2:
		return "UPLOAD_ERR_FORM_SIZE";
	case 3:
		return "UPLOAD_ERR_PARTIAL";
	case 4:
		return "UPLOAD_ERR_NO_FILE";
	case 5:
		return "File has already been uploaded";
	case 6:
		return  "Failed to move file from temporary directory";
	case 7:
		return  "Upload file failed";
	}
}
function user_pass_check($username,$password)
{
	$query = "select * from account where username='$username'";
	$result = mysql_query( $query );
	$row=mysql_fetch_row($result);
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

function get_firstname($username)
{
	$query = "select * from account where username='$username'";
	$result = mysql_query( $query );
	$row=mysql_fetch_row($result);
	$name=$row[4];
	return $name;
}
function get_name($username)
{
	$query = "select * from account where username='$username'";
	$result = mysql_query( $query );
	$row=mysql_fetch_row($result);
	$name=$row[4]." ".$row[5];
	return $name;
}