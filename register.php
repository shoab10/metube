<?php
include "function.php";
session_start();
// define variables and set to empty values
$usernameErr = $emailErr = $passwordErr = $repasswordErr = "";
//$username = $email = $password = $repassword = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{    
  $result=checkUserNameExists($_POST["username"]);
  if($row=mysql_fetch_array($result))
  {
    $usernameErr = "User Name already exists";
  }
  else
  {
    $username = test_input($_POST["username"]);
  }

  if ($_POST["password"]!=$_POST["repassword"])
  {
    $passwordErr="Passwords do not match";
  }
  else
    {
      $password=$_POST["password"];
      $repassword=$_POST["repassword"];
    }
   
   if($usernameErr == "" && $passwordErr =="" && $emailErr =="")
   {
    $sex=$_POST['sex'];
    $email = test_input($_POST["email"]);
    echo $sex;

    register($_POST['username'],$_POST['password'],$_POST['email'],$_POST['firstname'],$_POST['lastname'],$_POST['sex'],$_POST['dob']);
    

    header("Location: signin.php?id=registered"); 

   }
}

function test_input($data)
{
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
}

//if ($_SERVER["REQUEST_METHOD"] == "POST")
//{
//  register($_POST['username'],$_POST['password'],$_POST['email'],$_POST['firstname'],$_POST['lastname'],$_POST['imagepath']);
  //header("Location: signin.php");
//}


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

    <title>Tiger Blog</title>

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style type="text/css">
    .form-control
    {
      width: 25%;
    }
    </style>
  </head>

  <body style="padding-top:50px;">

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Metube</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">

      <div class="starter-template">
        <h1>Registration</h1>
        <p class="lead">Please register first in order to login</p>

        <form class="form-horizontal" role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
          <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">Firstname</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="firstname" placeholder="Firstname" name="firstname" required>
            </div>
          </div>
          <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">Lastname</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="lastname" placeholder="Lastname" name="lastname" required>
            </div>
          </div>
          <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="email" placeholder="Email" name="email" required>
            </div>
          </div>
          <div class="form-group">
            <label for="username" class="col-sm-2 control-label">Username</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="username" placeholder="Username" name="username" required>
            </div>
          </div>
          <div class="form-group">
            <label for="password" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
            </div>
          </div>
          <div class="form-group">
            <label for="repassword" class="col-sm-2 control-label">Re-Password</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="repassword" placeholder="Re-Password" name="repassword" required>
            </div>
          </div>
          <div class="form-group">
            <label for="sex" class="col-sm-2 control-label">Sex</label>
            <div class="col-sm-10">
              <label class="radio-inline"><input type="radio" id="inlineCheckbox1" value="male" name="sex">Male</label>
              <label class="radio-inline"><input type="radio" id="inlineCheckbox1" value="female" name="sex">Female</label>
            </div>
          </div>
          <div class="form-group">
            <label for="dob" class="col-sm-2 control-label">Date of Birth</label>
            <div class="col-sm-10">
              <input type="date" class="form-control" id="dob" name="dob" required>
            </div>
          </div>
          <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Sign up</button>
                <button type="reset" class="btn btn-default">Reset</button>
              </div>
            </div>
        </form>
        <p><?php echo $usernameErr;echo $passwordErr?></p>






      </div>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
  </body>
</html>