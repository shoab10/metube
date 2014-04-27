<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">



<?php
	session_start();
	include_once "function.php";
	include_once "sql.php";
?>	
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Media</title>
<script src="Scripts/AC_ActiveX.js" type="text/javascript"></script>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<script>
function likesfunc(str)
{

var xmlhttp=new XMLHttpRequest();
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("likecount").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","likes.php?id="+str,true);
xmlhttp.send();
}
</script>
</head>

<body>
<?php
if(isset($_GET['id'])) {
	$query = "SELECT * FROM media WHERE mediaid='".$_GET['id']."'";
	$result = mysql_query( $query );
	$result_row = mysql_fetch_row($result);


	
	$likequery = "SELECT * FROM likes WHERE mediaid='".$_GET['id']."'";
	$likeresult = mysql_query( $likequery );
	$likeresult_row = mysql_fetch_row($likeresult);

	$likenumber=$likeresult_row[1];
	$viewnumber=intval($likeresult_row[2]);
	$viewnumber=$viewnumber + 1;

	$viewupdatequery = "UPDATE likes SET views=$viewnumber WHERE mediaid='".$_GET['id']."'";
	$viewupdateresult = mysql_query( $viewupdatequery ) or die("Insert into likes error in media_upload_process.php " .mysql_error());


	//updateMediaTime($_GET['id']);
	
	$filename=$result_row[1];
	$title=$result_row[3];
	$username=$result_row[6];
	$filepath=$result_row[5];
	$type=$result_row[2];
	//if(substr($type,0,5)=="image") //view image
	//{
	//	echo "Viewing Picture:";
	//	echo $result_row[2].$result_row[1];
	//	echo "<img src='".$filepath.$filename."'/>";
	//}
	//else //view movie
	//{	
?>
	<p>Viewing Video:<?php echo $result_row[5].$result_row[1];?></p>
	      
    <object id="MediaPlayer" width=320 height=286 classid="CLSID:22D6f312-B0F6-11D0-94AB-0080C74C7E95" standby="Loading Windows Media Player components…" type="application/x-oleobject" codebase="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=6,4,7,1112">

<param name="filename" value="<?php echo $result_row[5].$result_row[1];  ?>">
<param name="Showcontrols" value="True">
<param name="autoStart" value="True">

<embed type="application/x-mplayer2" src="<?php echo $result_row[5].$result_row[1];  ?>" name="MediaPlayer" width=320 height=240></embed>

</object>


<p><?php echo $username;?></p>
<p><?php echo $title;?></p>
<p> views<?php echo $viewnumber?></P> 

<button type="button" onclick="likesfunc(<?php echo $result_row[0]; ?>)">likes</button><p id="likecount"><?php echo $likenumber; ?></p>
          
          
          
       
              
<?php
//	}
}
//else
//{

//<meta http-equiv="refresh" content="0;url=browse.php">
?>
<?php
//}
?>
</body>
</html>
