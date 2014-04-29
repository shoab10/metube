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
    <link href="/metube/css/signin.css" rel="stylesheet">
    <link href="/metube/css/dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
function createplaylist()
{

var xmlhttp=new XMLHttpRequest();
 var results=document.getElementById("txt").value;
str = String(results);
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      

     document.getElementById("mainframe").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","createplaylistbackend.php?pname="+str,true);
xmlhttp.send();
}

</script> 
  </head>

  <body>
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            
          </button>
          <a class="navbar-brand" href="/metube/homex.php">MeTube - All Media.One Source</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="uploadmedia.php">Upload</a></li>
            <li><a href="#">Profile</a></li>
          </ul>
          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form>
        </div>
      </div>
    </div>


     <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar" id="sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="homex.php">Home</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="allplaylist.php">playlists</li>
            <li><a href="mymedia.php">My Media</a></li>
            <li><a href="messages.php">Messages</a></li>
            <li><a href="friends.php">Friends</a></li>
           <li><a href="channel.php?channelname=<?php echo $username;?>" >MY Channel</a></li>
            <li><a href="subscribtions.php">subscribtions</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li class="active"><a href="">Categories</a></li>
            <li><a href="">Music</a></li>
            <li><a href="">Sports</a></li>
            <li><a href="">Education</a></li>
            <li><a href="">Movies</a></li></span>
          </ul>

        </div>
      
      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main"> <!--Body Container-->
      
  

  <p> create new playlist</p>
  name:<input type="text" name="txt" id="txt"/>
  <button type="button" onclick="createplaylist()">create playlist</button> 

    <p> My playlists: </p>
    <div id="mainframe"> <?php

 
$query = "SELECT * FROM playlists WHERE username= '$username'";
  $result = mysql_query( $query ) or die("Insert into Media error in media_upload_process.php " .mysql_error());

  while ($result_row = mysql_fetch_assoc($result))
      { 
      ?>
            <h4><a href="displayplaylist.php?pid=<?php echo $result_row['pid'];?>"> <?php echo $result_row['pname'];?></a></h4>

            <?php
}
  ?>


  
hellllllllllllllllllllllllllllllllllllllllllllllloooooooooooooooooooooooooo
  
  
</div>
  
      </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>