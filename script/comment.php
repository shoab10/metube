
<?php
session_start();
include_once "..\\function.php";
include_once "..\sql.php";
$accid=$_SESSION['accid'];
$comment=$_POST['comment'];
$mediaid=$_POST['mediaid'];
$query="insert into comments (mediaid,accid,comment) values ('$mediaid','$accid','$comment')";

$result=mysql_query($query);


      			$query1 = "SELECT * FROM  `comments` NATURAL JOIN `account` WHERE mediaid = ". $_POST['mediaid'] ." ORDER BY TIME DESC LIMIT 0 , 30"; 
                    $result1 = mysql_query( $query1 );
                    if (!$result1)
                        {
                             die ("Could not query the media table in the database: <br />". mysql_error());
                        }
                            while($result_row1 = mysql_fetch_assoc($result1))
                            {
                
                                echo "<h5><b>".$result_row1['firstname']." ".$result_row1["lastname"]."</b>";
                                echo "<small> ".$result_row1['time']."</small></h5>";
                                echo "<p>".$result_row1['comment']."</p>";
               			}  
               	




?>