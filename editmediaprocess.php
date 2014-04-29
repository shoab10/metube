<?php
session_start();
include_once "function.php";
include_once "sql.php";
/******************************************************
*
* upload document from user
*
*******************************************************/
$username=$_SESSION['username'];
$title=$_POST['title'];
$keyword=$_POST['keyword'];
$description=$_POST['description'];
$permission=$_POST['permission'];
$category=$_POST['category'];
$mediaid=$_POST['mediaid'];
$query="UPDATE `media` SET `title`='$title',`description`='$description',`category`='$category',`permission`='$permission' WHERE 
		`mediaid`='$mediaid'";
mysql_query($query);
$query="DELETE from keywords where mediaid=$mediaid";
mysql_query($query);
echo $query;
					$ktypes=array();
					$search=$keyword;
         			$s1 = str_replace("'", '', $search);
         			$s2 = preg_replace('/[^a-zA-Z0-9" "\']/', ' ', $s1);
         			$s2 = preg_replace( "/\s+/", " ", $s2 );
         			$sTerms = strip_tags($s2);
    				$searchTermDB = mysql_real_escape_string($sTerms);
    				$ktypes=explode(" ", $searchTermDB);
    				foreach ($ktypes as &$value)
    				{
    					$query="INSERT into keywords (mediaid,keyword) values('$mediaid','$value')";
    					mysql_query($query);
    				}
header('location:mymedia.php');
?>