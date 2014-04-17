<?php
session_start();
include_once "function.php";
include_once "sql.php";
$username=$_SESSION['username'];

if(isset($_POST['freq']))
{
  $fusername=$_POST['fusername'];
  $freq=$_POST['freq'];
  if($freq=='accept')
  {
    $query="insert into friendlist (username,fusername,status) values('$username','$fusername',1)";
    $result=mysql_query($query);
    $query="insert into friendlist (username,fusername,status) values('$fusername','$username',1)";
    $result=mysql_query($query);
    $query = "DELETE from friendrequest where username='$fusername' and fusername='$username' and status=0";
    $result=mysql_query($query);
  }
  else if($freq=='decline')
  {
    $query = "DELETE from friendrequest where username='$fusername' and fusername='$username' and status=0";
    $result=mysql_query($query);
  }
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
            <li><a href="profile.php">Hello,<?php echo get_firstname($username); ?></a></li>
            <li><a href="uploadmedia.php">Upload</a></li>
            <li><a href="signout.php">Sign out</a></li>
          </ul>
          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
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
            <li><a href="channels.php">Channels</a></li>
            <li><a href="playlists.php">Playlists</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li><a href="">Nav item</a></li>
            <li><a href="">Nav item again</a></li>
            <li><a href="">One more nav</a></li>
            <li><a href="">Another nav item</a></li>
            <li><a href="">More navigation</a></li>
          </ul>
        </div>
      
      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" id="mainframe"> <!--Body Container-->
        <h1 class="page-header">Friend Requests</h1>
        <div id="table">
          <table class="table">
        <?php
        $query = "SELECT username from friendrequest where fusername='$username'"; 
        $result = mysql_query( $query );
        if (!$result)
        {
          die ("Could not query the database: <br />". mysql_error());
        }
        while ($result_row = mysql_fetch_array($result,MYSQL_ASSOC))
        {
          ?>
          
          <tr>
            <td><form action="friends.php" method="post"><h3><?php echo $result_row['username'];?> 
              <button class="btn btn-success" type="submit" name="freq" value="accept">Accept</button>
              <button class="btn btn-danger" type="submit" name="freq" value="decline">Decline</button>
              <input type="hidden" value="<?php echo $result_row['username'];?>" name="fusername">
            </form>
            </h3> 
          </td>
          </tr>

        <?php
        }
        ?>
      </table>
    </div>

    <h1 class="page-header">Friends</h1>
    <div class="row placeholders">
        <?php
        $query = "SELECT fusername from friendlist where username='$username'"; 
        $result = mysql_query( $query );
        if (!$result)
        {
          die ("Could not query the media table in the database: <br />". mysql_error());
        }
        while ($result_row = mysql_fetch_assoc($result))
        {

        ?>
        <div class="col-xs-6 col-sm-3 placeholder">
              <!--<img src="\metube\images\metube_logo.jpg" class="img-responsive" alt="Image">-->
              <h4><a href="user.php?username=<?php echo $result_row['fusername'];?>"><?php echo get_name($result_row['fusername']);?></a></h4>
              <!--<span class="text-muted"><a href="<?php echo $result_row[2].$result_row[1];?>" target="_blank" onclick="javascript:saveDownload(<?php echo $result_row[0];?>);">Download</a></span>-->
            </div>
        <?php
        }
        ?>
      </div>


      </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
});

});

</script>
  </body>
</html>