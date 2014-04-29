<?php
session_start();
include_once "function.php";
include_once "sql.php";
$username=$_SESSION['username'];
$gid=$_GET['gid'];
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script>
function addgroupmember(str)
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
    document.getElementById("friendadded").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","addmemberbackend.php?gid=<?php echo $gid;?>&fname="+str,true);
xmlhttp.send();
}



</script>

    

<style type="text/css"> 
#panel
{
display:none;
}
</style>



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
           <li><a href="channel.php?channelname=<?php echo $username;?>" >MY Channel</a></li>
            <li><a href="subscribtions.php">subscribtions</a></li>
            <li><a href="displayfavourites.php">favourite</a></li>
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
        <h1 class="page-header">Most Viewed</h1>
        <?php
        
          $gid=$_GET['gid'];
          $query="SELECT * FROM groups where gid='$gid'";
          $result = mysql_query($query) or die ("Failed to load group");
          $row = mysql_fetch_assoc($result);
        if($row['username'] == $username)
        { $query="SELECT * 
        FROM  `friendlist` 
        WHERE username =  '$username'
        LIMIT 0 , 30";
        $friends = mysql_query($query) or die ("Failed to load friends");
        echo "<select name='friendlist' id='friends' onChange='addgroupmember(this.value)'>";
        echo "<option value='none'>Add Members</option>";
        
        if(mysql_num_rows($friends))
        {
          while($friend_result=mysql_fetch_assoc($friends))
            {
                echo "<option value=".$friend_result['fusername'].">".$friend_result['fusername']."</option>";

        }
      }
      else
      {
        echo "No friends, to be added in  group";
      }
      echo "</select>";
    }
      
    ?>
        
        <p><span id="friendadded"></span></p>


        <div class="row"> <!--comments-->
            <div class="col-md-12">
              <h4>Group Discussion</h4>
              <hr>
              <div id="comment-container">
            <?php  $query1 = "SELECT * FROM  `groupdiscussion` NATURAL JOIN `account` WHERE gid = '$gid' ORDER BY TIME DESC LIMIT 0 , 30"; 
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

            <div class="well" id="comment-box" > <!-- the comment box -->
              <h4>Leave a Comment on this discussion:</h4>
              <form role="form" id="comment" >
                <div class="form-group">
                  <textarea class="form-control" rows="3" name="comment"></textarea>
                </div>
                <input type="hidden" name="gid" value="<?php echo $gid;?>">
                <button type="submit" class="btn btn-primary" id="Cbutton">Submit</button>
              </form>
            </div>
          </div> <!--comment box-->


      </div> <!--inner container-->

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>
$(document).ready(function(){
$("#comment").submit(function(){
      event.preventDefault();
      var values = $(this).serialize();
      $.ajax({
        url: "groupcomment.php",
        type: "post",
        data: values,
        success: function(data, textStatus, jqXHR){
          $('#comment-container').html(data);
          
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