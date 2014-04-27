<?php
session_start();
$username="";
$login_error="";

include "function.php";
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  $check = user_pass_check($_POST['username'],$_POST['password']); // Call functions from function.php
      if($check == 1) {
        $login_error = "Invalid Username";
        //echo "$login_error";
        $username="";
      }
      elseif($check==2) {
        $login_error = "Incorrect password.";
        //echo "$login_error";
        $username=$_POST['username'];
      }
      else if($check==0){

        $username=$_POST['username'];
        $_SESSION['username']=$_POST['username']; //Set the $_SESSION['username']

        $query = "select accid,username from account where username='$username'";
        $result = mysql_query( $query );
        $row=mysql_fetch_assoc($result);
        $_SESSION['accid']=$row['accid']; //Set the $_SESSION['accid']


        header('Location: homex.php');
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

    <title>Sign In</title>

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
  </head>

  <body>
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <a class="navbar-brand" href="/metube/home.php">MeTube - All Media.One Source</a>
      <!--<img src="/metube/images/metube_logo.jpg" class="img-responsive" alt="Responsive image">-->
      <!--<div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Settings</a></li>
            <li><a href="#">Profile</a></li>
            <li><a href="#">Help</a></li>
          </ul>
          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form>
        </div>
      </div>-->
    </div>
      
      <div class="container">
      <form class="form-signin " role="form" action="signin.php" method="POST">
        <h2 class="form-signin-heading">Sign In</h2>
        <input type="username" class="form-control" placeholder="Username" required autofocus name="username" value="<?php echo $username;?>">
        <input type="password" class="form-control" placeholder="Password" required name="password">
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label>
        <button class="btn btn-primary btn-lg" type="submit">Sign in</button>
        <a class="btn btn-link btn-lg" href="/metube/register.php" role="button">Register</a>

        <p class="text-danger"><?php echo $login_error; ?></p>
      </form>
      </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>