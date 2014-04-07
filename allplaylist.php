
<?php
session_start();
include_once "function.php";
include_once "sql.php";
$username=$_SESSION['username'];
 
$query = "SELECT * FROM playlists WHERE username= '$username'";
	$result = mysql_query( $query ) or die("Insert into Media error in media_upload_process.php " .mysql_error());

	?>
<html> 
<head>
<!--	 <script>
function createplaylist(str)
{

var xmlhttp=new XMLHttpRequest();
var value=document.getElementById("str").value;

xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    	<?php 

				//	$insertplaylist="insert into playlists(pid,pname,username) values(NULL,"?>value<?php//",'$username')";
					//mysql_query($insertplaylist) or die("Insert into Media error in media_upload_process.php " .mysql_error());


    	?>
   // document.getElementById("mainframe").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","allplaylist.php?username="+<?php// echo $username ?>,true);
xmlhttp.send();
}

</script> -->
	</head>
	
hellllllllllllllllllllllllllllllllllllllllllllllloooooooooooooooooooooooooo
	<table width="50%" cellpadding="0" cellspacing="0">
		<?php
			while ($result_row = mysql_fetch_row($result))
			{ 
		?>
        <tr valign="top">			
			<td>
					<?php 
						echo $result_row[1];
					?>
			</td>
            
		</tr>
        <?php
			}
		?>
	</table>

	<p> create new playlist</p>
	name:<input type="text" name="txt" id="txt"/>
	<!--<button type="button" onclick="createplaylist('txt')">create</button> 

-->
</html>