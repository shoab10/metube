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

          <form class="navbar-form navbar-left" role="search">
            <div class="form-group" >
              <input type="text" class="form-control" placeholder="Videos,images.." style="width:360px;">
            </div>
            <button type="submit" class="btn btn-default" style="position:relative;left:-8px;border-top-left-radius:0;border-bottom-left-radius:0;"><span class="glyphicon glyphicon-search"></span> Search</button>
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
        <h1 class="page-header">Your Media</h1>
        <div class="row placeholders">
        <?php
        $types = array();

     if (isset($_GET['search']))
     {
          $search=$_GET['search'];
          $search1=$_GET['search1'];
         $s1 = str_replace("'", '', $search);
         $s2 = preg_replace('/[^a-zA-Z0-9" "\']/', '', $s1);
         $s2 = preg_replace( "/\s+/", " ", $s2 );
         $sTerms = strip_tags($s2);
         $searchTermDB = mysql_real_escape_string($sTerms);
          $types=explode(" ", $searchTermDB);

    if($search1 == "keyword")
       {
       foreach ($types as &$value)
        $value = " `keyword` LIKE '%{$value}%' ";
         

        $searchSQL = "SELECT * FROM `media` NATURAL JOIN `keywords` WHERE permission ='public' and ";
        

        $searchSQL .= implode(" OR ", $types) . " limit 0,10";
        $searchResult = mysql_query($searchSQL) or trigger_error("Error!<br/>" . mysql_error() . "<br />SQL Was: {$searchSQL}");
        if (mysql_num_rows($searchResult) < 1) 
             {
                   $error[] = "No Results";
                    die ("Could not find the media in the database: <br />". mysql_error());
             }
        else {

      while ($result_row = mysql_fetch_assoc($searchResult)) 
                {
        $kid = $result_row['kid'];
        $c = $result_row['counter'];
        $c = $c + 1;
        mysql_query("Update `Keywords` set `counter`= '$c'  WHERE `kid`='$kid'");
          ?>
          
            <div class="col-xs-6 col-sm-3 placeholder">
              <img src="\metube\images\metube_logo.jpg" class="img-responsive" alt="Image">
              <h4><a href="media1.php?id=<?php echo $result_row['mediaid'];?>"><?php echo $result_row['filename'];?></a></h4>
              <span class="text-muted"><a href="<?php // echo $result_row[2].$result_row[1];?>" target="_blank" onclick="javascript:saveDownload(<?php echo $result_row['mediaid'];?>);">Download</a></span>
            </div>


  <?php
              }
           }
       }       
           else if($search1 == "title") 
    {
           foreach ($types as &$value)
            $value = " `title` LIKE '%{$value}%' ";
           
           $searchSQL = "SELECT * FROM `media` WHERE permission ='public' and";
        

        $searchSQL .= implode(" OR ", $types) . " limit 0,10";
        $searchResult = mysql_query($searchSQL) or trigger_error("Error!<br/>" . mysql_error() . "<br />SQL Was: {$searchSQL}");
        if (mysql_num_rows($searchResult) < 1) 
          {
           $error[] = "No Results";
           die ("Could not find the media in the database: <br />". mysql_error());
          }
        else 
        {

      while ($result_row = mysql_fetch_assoc($searchResult)) 
           {
          ?>
          
            <div class="col-xs-6 col-sm-3 placeholder">
              <img src="\metube\images\metube_logo.jpg" class="img-responsive" alt="Image">
              <h4><a href="media1.php?id=<?php echo $result_row['mediaid'];?>"><?php echo $result_row['filename'];?></a></h4>
              <span class="text-muted"><a href="<?php // echo $result_row[2].$result_row[1];?>" target="_blank" onclick="javascript:saveDownload(<?php echo $result_row['mediaid'];?>);">Download</a></span>
            </div>
        <?php
        }
    }

   }
     else 

     {
      foreach ($types as &$value)
      $value = " `category` LIKE '%{$value}%' ";
        

        $searchSQL = "SELECT * FROM `media` WHERE permission ='public' and";
        

        $searchSQL .= implode(" OR ", $types) . " limit 0,10";
        $searchResult = mysql_query($searchSQL) or trigger_error("Error!<br/>" . mysql_error() . "<br />SQL Was: {$searchSQL}");
        if (mysql_num_rows($searchResult) < 1) 
        {
                $error[] = "No Results";
              die ("Could not find the media in the database: <br />". mysql_error());
        }
        else {

      while ($result_row = mysql_fetch_assoc($searchResult)) 
                          {
          ?>

          
            <div class="col-xs-6 col-sm-3 placeholder">
              <img src="\metube\images\metube_logo.jpg" class="img-responsive" alt="Image">
              <h4><a href="media1.php?id=<?php echo $result_row['mediaid'];?>"><?php echo $result_row['filename'];?></a></h4>
              <span class="text-muted"><a href="<?php // echo $result_row[2].$result_row[1];?>" target="_blank" onclick="javascript:saveDownload(<?php echo $result_row['mediaid'];?>);">Download</a></span>
            </div>
        <?php
                       }
               }




     }
}

            ?>
      </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>