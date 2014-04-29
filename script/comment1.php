
<?php
session_start();
include_once "..\\function.php";
include_once "..\sql.php";
echo $_SESSION['accid'];
$accid=$_SESSION['accid'];
$comment=$_POST['com1'];
$mediaid=$_POST['id'];
$query="insert into comments (mediaid,accid,comment) values ('$mediaid','$accid','$comment')";
echo $query;
$result=mysql_query($query);
//header('Location: ..\home.php');
?>
<div class="col-md-12">
      				<h4>Comments</h4>
      				<hr>
      			<?php  $query1 = "SELECT * FROM  `comments` NATURAL JOIN `account` WHERE mediaid = ". $_POST['id'] ." ORDER BY TIME DESC LIMIT 0 , 30"; 
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
