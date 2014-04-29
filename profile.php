<?php
session_start();
include_once "function.php";
include_once "sql.php";
if(!isset($_SESSION['username']))
{
  $firstname="Guest";
  header('location:index.php');
}
else
{
 $username=$_SESSION['username'];
 $firstname=get_firstname($username);
}

$query = "SELECT * from account where username='$username'"; 
$result = mysql_query( $query );
if(!$result)
{
  die ("Could not query the media table in the database: <br />". mysql_error());
}
while ($result_row = mysql_fetch_assoc($result))
{
  $uname=$result_row['username'];
  $firstname=$result_row['firstname'];
  $lastname=$result_row['lastname'];
  $email=$result_row['email'];
  $dob=$result_row['dob'];
  $sex=$result_row['sex'];
  $about=$result_row['about'];
}

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
<style>
#updateform .form-control{
  width: 35%;
}
</style>    

  </head>

  <body>
    <div class="navbar  navbar-fixed-top" role="navigation" style="background:white">

      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            
          </button>
          <a class="navbar-brand" href="/metube/index.php">MeTube</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="profile.php">Hello,<?php echo $firstname; ?></a></li>
            <li ><a href="uploadmedia.php" id="upload">Upload</a></li>
            <li><a href="signout.php">Sign out</a></li>
          </ul>

          <form class="navbar-form navbar-left" role="search" method=get action="searchmedia.php" style="position:relative;left:100px">
            <div class="form-group" >
              <input type="text" class="form-control" name="search" placeholder="Videos,images.." style="width:360px;">
            </div>
            <button type="submit" class="btn btn-default"  style="position:relative;left:-8px;border-top-left-radius:0;border-bottom-left-radius:0;"><span class="glyphicon glyphicon-search"></span> Search</button>
            <div class="radio">
              <label>
            <input type="radio" name="search1" value="title"> Title
              </label>
            </div>
            <div class="radio">
              <label>
            <input type="radio" name="search1" value="keyword" checked> Keywords
              </label>
            </div>
            <div class="radio">
              <label>
            <input type="radio" name="search1" value="category"> Category
              </label>
            </div>
          </form>
          <button type="button" class="btn btn-default navbar-btn navbar-right" onclick="javascript:wordcloud()">Word Cloud</button>

          
        </div>
      </div>
    </div>


    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar" id="sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="mymedia.php">My Media</a></li>
            <li><a href="allplaylist.php">Playlists</a></li>            
            <li><a href="messages.php">Messages</a></li>
            <li><a href="friends.php">Friends</a></li>
            <li><a href="channel.php?channelname=<?php echo $username;?>">My Channel</a></li>
            <li><a href="subscribtions.php">Subscribtions</a></li>
            <li><a href="displayfavourites.php">Favourites</a></li>
            <li><a href="block.php">Block List</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li class="active"><a href="">Categories</a></li>
            <li><a href="searchmedia.php?search=music&search1=category">Music</a></li>
            <li><a href="searchmedia.php?search=sports&search1=category">Sports</a></li>
            <li><a href="searchmedia.php?search=movies&search1=category">Movies</a></li>
            <li><a href="searchmedia.php?search=kids&search1=category">Kids</a></li> 
            <li><a href="searchmedia.php?search=action&search1=category">Action</a></li>
            <li><a href="searchmedia.php?search=education&search1=category">Education</a></li>
          </ul>

        </div>
      
      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" id="mainframe"> <!--Body Container-->
        <h1 class="page-header">Profile</h1>
        <span id="profile">
          <h3 align="left">Username : <small><?php echo $uname; ?></small></h3>
          <h3 align="left">Email : <small><?php echo $email; ?></small></h3>
          <h3 align="left">Date of Birth : <small><?php echo $dob; ?></small></h3>
          <h3 align="left">Sex : <small><?php echo $sex; ?></small></h3>
          <h3 align="left">About : <small><?php echo $about; ?></small></h3>
          <button class="btn btn-primary" id="btnmod">Update</button>
        </span> 

        <span id="updateform" style="display:none;">
          <form role="form" method="post" action="updateprofile.php">
            <div class="form-group">
              <label for="firstname">Firstname</label>
              <input type="text" class="form-control" name="firstname" value="<?php echo $firstname;?>">
              <label for="lastname">Lastname</label>
              <input type="text" class="form-control" name="lastname" value="<?php echo $lastname;?>">
              <label for="email">Email</label>
              <input type="email" class="form-control" name="email" value="<?php echo $email;?>">
              <label for="dob">Date of Birth</label>
              <input type="text" class="form-control" name="dob" value="<?php echo $dob;?>">
              <label for="about">About</label>
              <textarea class="form-control" name="about"><?php echo $about;?></textarea>
              <button class="btn btn-primary" type="submit" id="btnupdate">Update</button>
            </div>
        </form>
      </span>
    </div>
  </div>
</div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
      $("#btnmod").click(function(){
      $("#profile").hide();
      $("#updateform").show();
      });
    });
     </script>
  </body>
</html>