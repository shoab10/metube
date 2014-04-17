
<?php
session_start();
include_once "function.php";
include_once "sql.php";
$username=$_SESSION['username'];
$firstname=$_POST['firstname'];
$lastname=$_POST['lastname'];
$email=$_POST['email'];
$dob=$_POST['dob'];
$about=$_POST['about'];
$query="UPDATE `account` SET `email`='$email',`firstname`='$firstname',`lastname`='$lastname',`dob`='$dob',`about`='$about' WHERE username='$username'";
$result=mysql_query($query);
header('Location: profile.php');
?>