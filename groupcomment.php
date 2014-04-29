
<?php
session_start();
include_once "function.php";
include_once "sql.php";
$username=$_SESSION['username'];
$comment=$_POST['comment'];
$gid=$_POST['gid'];
$query="INSERT into groupdiscussion (gid ,comment,username) values ('$gid','$comment','$username')";

$result=mysql_query($query);


      			$query1 = "SELECT * FROM  `groupdiscussion` NATURAL JOIN `account` WHERE gid = '$gid' ORDER BY time DESC LIMIT 0 , 30"; 
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