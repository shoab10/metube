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
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="#">profile</a></li>
            <li><a href="#">favourites</a></li>
            <li><a href="allplaylist.php">playlists</a></li>
            <li><a href="#">metube channels</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li><a href="">Nav item</a></li>
            <li><a href="">Nav item again</a></li>
            <li><a href="">One more nav</a></li>
            <li><a href="">Another nav item</a></li>
            <li><a href="">More navigation</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li><a href="">Nav item again</a></li>
            <li><a href="">One more nav</a></li>
            <li><a href="">Another nav item</a></li>
          </ul>
        </div>
      
      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" id="mainframe"> <!--Body Container-->
      
  <?php

 
$query = "SELECT * FROM playlists WHERE username= '$username'";
  $result = mysql_query( $query ) or die("Insert into Media error in media_upload_process.php " .mysql_error());

  ?>

<!--   <script>
function createplaylist(str)
{

var xmlhttp=new XMLHttpRequest();
var value=document.getElementById("str").value;

xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      <?php 

        //  $insertplaylist="insert into playlists(pid,pname,username) values(NULL,"?>value<?php//",'$username')";
          //mysql_query($insertplaylist) or die("Insert into Media error in media_upload_process.php " .mysql_error());


      ?>
   // document.getElementById("mainframe").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","allplaylist.php?username="+<?php// echo $username ?>,true);
xmlhttp.send();
}

</script> -->

  
hellllllllllllllllllllllllllllllllllllllllllllllloooooooooooooooooooooooooo
  
    <?php
      while ($result_row = mysql_fetch_row($result))
      { 
            echo $result_row[1];

        $query1 = "SELECT * FROM media WHERE mediaid = ALL (SELECT mediaid FROM  `playlistmedia` WHERE pid = $result_row[0]) "; 
        $result1 = mysql_query( $query1 );
        if ($result1)
        {
        while ($result_row1 = mysql_fetch_row($result1))
        {
          ?>
           <br>
            <div class="col-xs-6 col-sm-3 placeholder">
              <img src="\metube\images\metube_logo.jpg" class="img-responsive" alt="Image">
              <h4><a href="media1.php?id=<?php echo $result_row1[0];?>"><?php echo $result_row1[1];?></a></h4>
              <span class="text-muted"><a href="<?php echo $result_row1[2].$result_row1[1];?>" target="_blank" onclick="javascript:saveDownload(<?php echo $result_row1[0];?>);">Download</a></span>
            </div>
            <br>
        <?php
        }}
        ?>
      
    
        <?php
      }
    ?>

  <p> create new playlist</p>
  name:<input type="text" name="txt" id="txt"/>
  <!--<button type="button" onclick="createplaylist('txt')">create</button> 

-->

      
      </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>