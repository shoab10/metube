<?php
session_start();
include_once "function.php";
include_once "sql.php";
$username=$_SESSION['username'];
$groupname=$_GET['gname'];
 ?>

<html lang="en">


       <?php

        $query="SELECT * FROM groups where username = '$username' and groupname='$groupname'";
        $result=mysql_query($query);
        if(mysql_num_rows($result))
        {
          echo "group already exists";
        $query="SELECT * FROM groups where username = '$username'";
        $result=mysql_query($query);
        if(mysql_num_rows($result)>0)
        {
        while($row=mysql_fetch_assoc($result))
        {
          ?>
          <p><a href="groupdiscussion.php?gid=<?php echo $row['gid'];?>"><?php echo $row['groupname'];?></a></p>
          <?php
        }
      }
         

       }

       else
       {  
        $query="INSERT INTO `groups`(`gid`, `groupname`, `username`) VALUES (NULL,'$groupname', '$username')";
        $result=mysql_query($query);
            echo "group added";

            $gid=mysql_insert_id();

    $query1="INSERT into groupmembers (gid,username) values('$gid','$username')";
    mysql_query($query1) or die("cannot create group");

           $query1="SELECT * FROM groups where username = '$username'";
        $result1=mysql_query($query1);
     
        while($row=mysql_fetch_assoc($result1))
        {
          ?>
          <p><a href="groupdiscussion.php?gid=<?php echo $row['gid'];?>"><?php echo $row['groupname'];?></a></p>
          <?php
        }

      }
         
        ?>
        



</html>