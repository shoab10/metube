<?php
session_start();
include_once "function.php";
include_once "sql.php";
$username=$_SESSION['username'];

if(isset($_GET['id'])) {
  $query = "SELECT * FROM media WHERE mediaid='".$_GET['id']."'";
  $mediaid = $_GET['id'];
  $result = mysql_query( $query );
  $result_row = mysql_fetch_assoc($result);
  $filename=$result_row['filename'];
  $title=$result_row['title'];
  $uploader=$result_row['username'];
  $filepath=$result_row['filepath'];
  $type=$result_row['type'];
  $description=$result_row['description'];
}

  $flag=0;
  $viewnumber=0;	
  $viewquery = "SELECT * FROM views WHERE mediaid='".$_GET['id']."'";
  $viewresult = mysql_query( $viewquery );
  if(mysql_num_rows($viewresult)==0)
  {
  	$viewquery = "INSERT INTO views (mediaid,views) values('".$_GET['id']."','0')";
  	mysql_query($viewquery);
  }

  else
  {
  	$viewresult_row = mysql_fetch_row($viewresult);
  	$viewnumber=intval($viewresult_row[1]);
  	$viewnumber=$viewnumber + 1;
  	$viewupdatequery = "UPDATE views SET views=$viewnumber WHERE mediaid='".$_GET['id']."'";
  	$viewupdateresult = mysql_query( $viewupdatequery ) or die("Insert into views error in media_upload_process.php " .mysql_error());
  }

   $likequery = "SELECT * FROM likes WHERE mediaid='".$_GET['id']."' and accid='".$_SESSION['accid']."'";
   $likeresult = mysql_query( $likequery );
   if(mysql_num_rows($likeresult)==0)
  {
    $flag=1;
    $likequery = "SELECT COUNT(*) FROM likes WHERE mediaid='".$_GET['id']."'";
    $likeresult = mysql_query( $likequery );
    $likes=mysql_fetch_array($likeresult);
  }
  else
  {
    $likequery = "SELECT COUNT(*) FROM likes WHERE mediaid='".$_GET['id']."'";
    $likeresult = mysql_query( $likequery );
    $likes=mysql_fetch_array($likeresult);

  }
  $ratequery1 = "SELECT ROUND(AVG( rating ),1) AS score FROM  `mediarating` WHERE mediaid = '".$_GET['id']."'";
  $rateresult1 = mysql_query($ratequery1);
  $result_row=mysql_fetch_assoc($rateresult1);
  $score=$result_row['score'];





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
<script type="text/javascript">
    function mr(str) //media rating fn
{
  <?php
   $mid= $_GET['id'];
   ?>
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("list1").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","mediarating.php?mid=<?php echo $mid;?>&rid="+str,true);
xmlhttp.send();
}   //media rating fn ends here

function addsubscribtion()
{
  
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("list1").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","subscribe.php?uploader=<?php echo $uploader;?>&subscriber=<?php echo $username;?>",true);
xmlhttp.send();
}


function addtoplaylist()
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  var results=document.getElementById("list").value;
 // document.getElementById("listresult").innerHTML = results;
 str = parseInt(results);
  xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("plist").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","addmediatolist.php?mediaid=<?php echo $mediaid;?>&pid="+str,true);
xmlhttp.send();
}

function addtofavourites()
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  var results=document.getElementById("list").value;
 // document.getElementById("listresult").innerHTML = results;
 str = parseInt(results);
  xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("fav").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","addtofavouritelist.php?mediaid=<?php echo $mediaid;?>",true);
xmlhttp.send();
}


function saveDownload(id)
{
  window.location.href = "<?php echo $filepath.$filename;?>";
  $.post("media_download_process.php",
  {
       id: id,
  },
  function(message) 
    { }
  ); 
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

      				

              <?php if (stripos($type,"video")!==false)
              {?>
              <video src="<?php echo $filepath.$filename; ?>" width="680" height="390" controls>
      				Your browser does not support the video tag.
      				</video>
              <?php }?>
      			  
              <?php if (stripos($type,"audio")!==false)
              {?>
              <audio src="<?php echo $filepath.$filename; ?>" width="680" controls>
              Your browser does not support the video tag.
              </audio>
              <?php }?>

              <?php if (stripos($type,"image")!==false)
              {?>
              <img src="<?php echo $filepath.$filename; ?>" width="680" height="390" controls>
              </img>
              <?php }?>




            </div>
      		</div>
        <?php  $query="SELECT * 
FROM  `playlists` 
WHERE username =  '$username'
LIMIT 0 , 30";
  $plist = mysql_query($query) or die ("Failed to load friends");
  ?>
      		<div class="row"> <!--box below video-->
      			<div class="col-md-12">
      				<h3><?php echo $title;?></h3>
      			</div>
      		</div>
      		
      		<div class="row">
      			<div class="col-md-6">
      			<p>Uploaded by <span style="font-weight:bold;font-size:120%;"><a href=""><?php echo $uploader;?></a></span></p>
      			<button class="btn btn-danger" onClick="addsubscribtion()" id="btn-subscribe">Subscribe</button>
      			
            <button class="btn btn-info" onClick= 'addtoplaylist()'><span id="plist">Add to Playlist<span></button>   
             <button class="btn btn-success" onClick= 'addtofavourites()'><span id="fav">favourite<span></button>
             <!--<button class="btn btn-success" onClick= 'saveDownload()'><span id="fav">Download<span></button>-->
             <a href="<?php echo $filepath.$filename;?>"  onclick="javascript:saveDownload(<?php echo $mediaid;?>);">Download</a>
            <?php
$query="SELECT * 
FROM  `playlists` 
WHERE username =  '$username'
LIMIT 0 , 30";
  $plist = mysql_query($query) or die ("Failed to load friends");
     // echo "<select name='playlistlist' id='list' onChange='addtoplaylist(this.value)'>"; 
     echo "<select name='playlistlist' id='list'>";
    echo "<option value='none'>choose playlist</option>";
    while($result=mysql_fetch_assoc($plist))
    {
      echo "<option value=".$result['pid'].">".$result['pname']."</option>";

    }
    echo "</select>";
    

  
  ?>
              </select>  <h4 id="listresult"> </h4>   			
      			</div>
            <div class="col-md-2 col-md-offset-2">
              <label>Rating</label>
              <select id="list" onChange="mr(this.value)">
              <option value="1">1 Star</option>
              <option value="2">2 Star</option>
              <option value="3">3 Star</option>
              <option value="4">4 Star</option>
              <option value="5">5 Star</option>
              </select>
            </div>
      			<div class="col-md-2">
      				<span><h4><?php echo $viewnumber;?> Views<h4></span>
      			</div>
      		</div>
          
          <div style="padding-top:3px;height:40px"> <!--like div component-->
            <div style="position:absolute;">
              <h4><span id="likes"><?php echo $likes['0'];?></span> Likes  Rating:   <span id="list1"><?php echo $score; ?></span> stars</h4>   
            </div>           
            <div style="position:absolute;right:50px;">
              <span id="like-div"><button class="btn btn-primary" id="like-btn">Like <span class="glyphicon glyphicon-thumbs-up"></span></button></span>
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
      			<div class="col-md-12">
      				<h4>Comments</h4>
      				<hr>
              <div id="comment-container">
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
                  </div>
            </div> <!--comments-->

      		<div class="row">
      			<div class="well" id="comment-box" id="comment-box"> <!-- the comment box -->
      				<h4>Leave a Comment:</h4>
      				<form role="form" id="comment" >
      					<div class="form-group">
      						<textarea class="form-control" rows="3" name="comment"></textarea>
      					</div>
      					<input type="hidden" name="mediaid" value="<?php echo $_GET['id'];?>">
      					<button type="submit" class="btn btn-primary" id="Cbutton">Submit</button>
      				</form>
      			</div>
      		</div> <!--comment box-->

          <div class="row">
            <div class="col-md-12" id="add">
            </div>
          </div>



      		</div>

        
      	</div><!-- /video container -->

      </div><!-- /row -->
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script></script>
	<script src="build/mediaelement-and-player.min.js"></script>
  <script src="lib/jquery.raty.js"></script>
	<script>
	$(document).ready(function(){
		$('audio,video').mediaelementplayer();

    if(!<?php if(isset($_SESSION['username'])) echo 1; else echo 0; ?>)
    {
      document.getElementById("comment-box").style.display="none";
    }


    /*$.ajax({
        url: "script/mediarating1.php",
        type: "get",
        data: {mid: "<?php echo $_GET['id']; ?>"},
        success: function(data, textStatus, jqXHR){
          $('#star').raty({
            score: data,
            halfShow: true
          });
        },
        error:function(){
          alert("failure");
            }
    });*/

  
   










		
		$("#comment").submit(function(){
			event.preventDefault();
			var values = $(this).serialize();
			$.ajax({
				url: "./script/comment.php",
				type: "post",
				data: values,
				success: function(data, textStatus, jqXHR){
          $('#comment-container').html(data);
					alert("success");
				},
				error:function(){
					alert("failure");
		        }
    });
    });

    if(<?php echo $flag; ?> == 0)
      {
        $('#like-div').html('<button class="btn btn-primary" id="like-btn" disabled="disabled">Liked <span class="glyphicon glyphicon-thumbs-up"></span></button>');
      }

    $("#like-btn").click(function(){
      
      
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
        document.getElementById("likes").innerHTML=xmlhttp.responseText;
        }
        }



        xmlhttp.open("GET","./script/likes.php?id=<?php echo $_GET['id']; ?>",true);
        xmlhttp.send();
        $('#like-div').html('<button class="btn btn-primary" id="like-btn" disabled="disabled">Liked <span class="glyphicon glyphicon-thumbs-up"></span></button>');

      
    });



	});
	</script>
  </body>
</html>