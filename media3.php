<?php
session_start();
include_once "function.php";
include_once "sql.php";
$username=$_SESSION['username'];
 ?>
<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>Metube</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <!--<link href="/metube/css/signin.css" rel="stylesheet"> -->
    <link href="/metube/css/dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    

<style type="text/css"> 
#panel
{
display:none;
}
</style>
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
    <div class="navbar  navbar-fixed-top" role="navigation">

      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            
          </button>
          <a class="navbar-brand" href="/metube/homex.php">MeTube</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="profile.php">Hello,<?php echo get_firstname($username); ?></a></li>
            <li><a href="uploadmedia.php">Upload</a></li>
            <li><a href="signout.php">Sign out</a></li>
          </ul>

          <form class="navbar-form navbar-left" role="search">
            <div class="form-group" >
              <input type="text" class="form-control" placeholder="Videos,images.." style="width:360px;margin-left: 120px;">
            </div>
            <button type="submit" class="btn btn-default" style="position:relative;left:-8px;border-top-left-radius:0;border-bottom-left-radius:0;"><span class="glyphicon glyphicon-search"></span> Search</button>
          </form>     
          
        </div>
      </div>
    </div>


    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="homex.php">Home</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="mymedia.php">My Media</a></li>
            <li><a href="messages.php">Messages</a></li>
            <li><a href="friends.php">Friends</a></li>
            <li><a href="channels.php">Channels</a></li>
            <li><a href="allplaylist.php">Playlists</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li class="active"><a href="">Categories</a></li>
            <li><a href="">Music</a></li>
            <li><a href="">Sports</a></li>
            <li><a href="">Education</a></li>
            <li><a href="">Movies</a></li></span>
          </ul>

        </div>
      
      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" id="mainframe"> <!--Body Container-->
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
  //  echo "Viewing Picture:";
  //  echo $result_row[2].$result_row[1];
  //  echo "<img src='".$filepath.$filename."'/>";
  //}
  //else //view movie
  //{ 
?>
  <!--<p>Viewing Video:<?php echo $result_row[5].$result_row[1];?></p>-->
  <h3>CNN News</h3>      
    <object id="MediaPlayer" width=320 height=286 classid="CLSID:22D6f312-B0F6-11D0-94AB-0080C74C7E95" standby="Loading Windows Media Player components…" type="application/x-oleobject" codebase="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=6,4,7,1112">

<param name="filename" value="<?php echo $result_row[5].$result_row[1];  ?>">
<param name="Showcontrols" value="True">
<param name="autoStart" value="True">

<embed type="application/x-mplayer2" src="<?php echo $result_row[5].$result_row[1];  ?>" name="MediaPlayer" width=320 height=240></embed>

</object>
</br>
<table>
<tr><td><button class="btn btn-primary"><span class="glyphicon glyphicon-thumbs-up"></span></button>
<button class="btn btn-default"><span class="glyphicon glyphicon-thumbs-down"></span></button></td>
<td><h4>   12 Likes</h4></td></tr>
<tr></table>
  <p>Uploaded by <span style="font-size:150%; color:blue;">haseeb101</span>   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size:120%;">Views 21</span> </p>
<button class="btn btn-default">Add to Playlist</button>
<div><textarea row="3" cols="10">Comment Here</textarea><div>
<table class="table">
  <tr><th><button class="btn btn-default">Comments</button></th><tr>
    <tr><td><b>Shoab</b></td><td>Nice video!!!.Way to go CNN</td></tr>
    <tr><td><b>Jesse</b></td><td>CNN Go home!</td></tr>
    <tr><td><b>John</b></td><td>I like fox news</td></tr>
  </table>
<!--<button type="button" onclick="likesfunc(<?php echo $result_row[0]; ?>)">likes</button><p id="likecount"><?php echo $likenumber; ?></p>-->
          
          
          
       
              
<?php
//  }
}
//else
//{

//<meta http-equiv="refresh" content="0;url=browse.php">
?>
<?php
//}
?>
      </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>