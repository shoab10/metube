<?php
session_start();
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

    <title>Metube:Upload</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <link href="/metube/css/signin.css" rel="stylesheet">
    <link href="/metube/css/upload.css" rel="stylesheet">
    <link href="/metube/css/dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
function playlistfunc()
{

var xmlhttp=new XMLHttpRequest();
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("mainframe").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","allplaylist.php",true);
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
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="#">profile</a></li>
            <li><a href="#">favourites</a></li>
            <li><button type="button" onclick="playlistfunc()">playlists</button></li>
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
      	
      	<form role="form" method="post" action="uploadmediaprocess.php" enctype="multipart/form-data" >
    		<div class="form-group">
    			<label for="uploadTitle">Title</label>
    			<input type="text" class="form-control" name="title" required style="width:40%">
    		</div>
    		<div class="form-group">
    			<label for="uploadDescription">Description</label>
    			<textarea  class="form-control" name="description" rows="4" cols="25" style="width:50%"></textarea>
    		</div>
    		<div class="form-group">
    			<label for="uploadDescription">Keywords</label>
    			<input type="text" class="form-control" name="keywords" required style="width:30%">
    		</div>
        <div class="form-group">
          <label for="uploadFile">Thumbnail</label>
          <input type="file" id="uploadFile">
        <p class="help-block">Choose thumbnail</p>
        </div>
    		<div class="form-group">
    			<label for="uploadFile">File input</label>
    			<input type="file" id="uploadFile">
				<p class="help-block">Each file limit 10M</p>
  			</div>
  			<button type="submit" class="btn btn-default" name="submit" value="Upload">Upload</button>
  		</form>
  	</div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>