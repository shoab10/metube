<?php
session_start();
include_once "function.php";
include_once "sql.php";
$username=$_SESSION['username'];

if(isset($_GET['id'])) {
  $query = "SELECT * FROM media natural join account WHERE mediaid='".$_GET['id']."'";
  $result = mysql_query( $query );
  $result_row = mysql_fetch_assoc($result);
  $filename=$result_row['filename'];
  $title=$result_row['title'];
  $uploader=$result_row['username'];
  $filepath=$result_row['filepath'];
  $type=$result_row['type'];
  $description=$result_row['description'];
}

      $rating=0;  
      $acid= $_SESSION['accid'];
  $ratequery = "SELECT AVG(rating) AS score FROM mediarating WHERE mediaid='".$_GET['id']."'"." and accid=$acid" ;
  $rateresult = mysql_query( $ratequery );
  if(mysql_num_rows($rateresult)==0)
  {
    $ratequery = "INSERT INTO mediarating values($acid, '".$_GET['id']."','0')";
    mysql_query($ratequery);
  }
  else
  {
    $rateresult_row = mysql_fetch_assoc($likeresult);
    $ratescore= $rateresult_row['score'];
  }

  $viewnumber=0;	
  $likequery = "SELECT * FROM likes WHERE mediaid='".$_GET['id']."'";
  $likeresult = mysql_query( $likequery );
  if(mysql_num_rows($likeresult)==0)
  {
  	$likequery = "INSERT INTO likes (mediaid,views) values('".$_GET['id']."','0')";
  	mysql_query($likequery);
  }

  else
  {
  	$likeresult_row = mysql_fetch_row($likeresult);
  	//$likenumber=$likeresult_row[1];
  	$viewnumber=intval($likeresult_row[2]);
  	$viewnumber=$viewnumber + 1;
  	$viewupdatequery = "UPDATE likes SET views=$viewnumber WHERE mediaid='".$_GET['id']."'";
  	$viewupdateresult = mysql_query( $viewupdatequery ) or die("Insert into likes error in media_upload_process.php " .mysql_error());
  }


  //updateMediaTime($_GET['id']); --not commented by shoab
  
  
  //if(substr($type,0,5)=="image") //view image
  //{
  //  echo "Viewing Picture:";
  //  echo $result_row[2].$result_row[1];
  //  echo "<img src='".$filepath.$filename."'/>";
  //}
  //else //view movie
  //{ 
?>



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
    <link rel="stylesheet" href="build/mediaelementplayer.css" />

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
function postcomment(str)
{

var xmlhttp=new XMLHttpRequest();
var com=String(document.getElementById("comment").value);
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("comment1").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("POST","comment1.php?id="+str+"&com1="+com,true);
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
      
      	<div class="col-md-7 col-sm-offset-1 main" id="mainframe"> <!--video container-->   		
      		<div class="row">
      			<div class="col-md-12">
      				<video src="<?php echo $filepath.$filename; ?>" width="680" height="390" controls>
      				Your browser does not support the video tag.
      				</video>
      			</div>
      		</div>
      		<div class="row"> <!--box below video-->
      			<div class="col-md-12">
      				<h3><?php echo $title;?></h3>
      			</div>
      		</div>
      		
      		<div class="row">
            .      			<div class="col-md-6">
      			<p>Uploaded by <span style="font-weight:bold;font-size:120%;"><a href=""><?php echo $uploader;?></a></span></p>
      			<button class="btn btn-danger">Subscribe</button>
      			<button class="btn btn-info">Add to Playlist</button>      			
      			</div>
      			<div class="col-md-2 col-md-offset-4">
      				<span><h4><?php echo $viewnumber;?> Views<h4></span>
      			</div>
      		</div>

      		<div class="row">
      			<div class="col-md-12" style="padding-top:3px">
      			<div style="position:absolute;left:0px">
      			<h5>200 Likes<h5>
      			</div>
      			<div style="position:absolute;right:3px">
      			<button class="btn btn-danger" >Like</button>
      			<button class="btn btn-info" >Dislike</button>
      			</div>    			
      			</div>
      		</div>

      		<div class="row">
      			<div class="col-md-12">
      			<h4>Description</h4>
      			<p><?php echo $description?></p>
      			<hr>
      			</div>
      		</div>
      		

      		<div class="row"> <!--comments-->
      			<div class="col-md-12" name="comment1">
      				<h4>Comments</h4>
      				<hr>
      			<?php  $query1 = "SELECT * FROM  `comments` NATURAL JOIN `account` WHERE mediaid = ". $_GET['id'] ." ORDER BY TIME DESC LIMIT 0 , 30"; 
                    $result1 = mysql_query( $query1 );
                    if (!$result1)
                        {
                             die ("Could not query the media table in the database: <br />". mysql_error());
                        }
                            while($result_row1 = mysql_fetch_assoc($result1))
                            {
                ?>
                                <h5><b><?php echo $result_row1['firstname']." ".$result_row1["lastname"]; ?></b>
                                <small><?php echo $result_row1['time'];?></small></h5>
                                <p> <?php echo $result_row1['comment']; ?></p>
               			<?php }  ?>
               		</div>
            </div> <!--comments-->

      		<div class="row">
      			<div class="well"> <!-- the comment box -->
      				<h4>Leave a Comment:</h4>
      				
      					<div class="form-group">
      						<textarea class="form-control" rows="3" name="comment"></textarea>
      					</div>
      					
      					<button type="button" class="btn btn-primary" onclick="postcomment(<?php echo $_GET['id']; ?>)" id="Cbutton">Submit</button>
      		
      			</div
                  		</div> <!--comment box-->



      		</div>

        
      	</div><!-- /video container -->

      </div><!-- /row -->
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script></script>
	<script src="build/mediaelement-and-player.min.js"></script>
	<script>
	$(document).ready(function(){
		$('audio,video').mediaelementplayer();
		
		$("#commentssssss").submit(function(){
			event.preventDefault();
			var values = $(this).serialize();
			$.ajax({
				url: "./script/comment.php",
				type: "post",
				data: values,
				success: function(){
					alert("success");
				},
				error:function(){
					alert("failure");
		        }
    });
});
	});
	</script>
  </body>
</html>