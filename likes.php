
<?php
include_once "function.php";
	include_once "sql.php";
if(isset($_GET['id'])) {
$likequery = "SELECT * FROM likes WHERE mediaid='".$_GET['id']."'";
	$likeresult = mysql_query( $likequery ) or die("Insert into Media error in media_upload_process.php " .mysql_error());;
	$likeresult_row = mysql_fetch_row($likeresult);

}
	$likenumber = intval($likeresult_row[1]);
	$likenumber = $likenumber + 1;
	$likeupdatequery = "UPDATE likes SET likeno=$likenumber WHERE mediaid='".$_GET['id']."'";
	$likeupdateresult = mysql_query( $likeupdatequery ) or die("Insert into Media error in media_upload_process.php " .mysql_error());

	echo $likenumber;

	?> 
