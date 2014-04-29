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

  </head>

  <body onload="checksession()">
    <div class="navbar  navbar-fixed-top" role="navigation">

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
            <li><a href="profile.php">Hello,<?php echo get_firstname($username); ?></a></li>
            <li><a href="uploadmedia.php">Upload</a></li>
            <li><a href="signout.php">Sign out</a></li>
          </ul>

          <form class="navbar-form navbar-left" role="search" method=get action="searchmedia.php">
            <div class="form-group" >
              <input type="text" class="form-control" name="search" placeholder="Videos,images.." style="width:360px;">
            </div>
            <button type="submit" class="btn btn-default"  style="position:relative;left:-8px;border-top-left-radius:0;border-bottom-left-radius:0;"><span class="glyphicon glyphicon-search"></span> Search</button>
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
            <li><a href="channels.php">Channels</a></li>
            <li><a href="playlists.php">Playlists</a></li>
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
        <h1 class="page-header">Reply</h1>
        <h3>From: <?php echo $username; ?></h3>
        <h3>To:</h3>
        <form action="messageprocess.php" method="get">
          <input type="text" class="form-control" name="to" style="width:30%">
          <textarea class="form-control" rows="5" name="message" style="width:60%"></textarea>
          <input type="hidden" name="compose" value="compose"/>
          <button type="submit" class="btn btn-primary">Send</button>
        </form>


        

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript">
    function checksession()
    {
      if(!<?php if(isset($_SESSION['u'])) echo 1; else echo 0; ?>)
      //document.getElementById("sidebar").style.display="none";
    }
    </script>
  </body>
</html>