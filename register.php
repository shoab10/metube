<?php
/*include "funtion.php";

if(isset($_POST['submit']))
{
	register($_POST['username'],$_POST['password'],$_POST['email']);
	//echo $_POST['username'];
	print '<script type="text/javascript">'; 
print 'alert("The email address '. $_POST['email'].' is already registered")'; 
print '</script>';  
	header("Location: index.php"); 
}
*/
?>

<?php
include "function.php";
session_start();
// define variables and set to empty values
$usernameErr = $emailErr = $passwordErr = $repasswordErr = "";
$username = $email = $password = $repassword = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{

   	if (empty($_POST["username"]))
     {$usernameErr = "UserName is required";}
   	else
     {
     	$result=checkUserNameExists($_POST["username"]);
 
     	if($row=mysqli_fetch_array($result))
	    {     	
     		$usernameErr = "UserName already exists";
     	}
     	else
     	{
     		$username = test_input($_POST["username"]);
     	}
     }

  	if (empty($_POST["email"]))
     {$emailErr = "Email is required";}
   	else
     {$email = test_input($_POST["email"]);}

	if (empty($_POST["password"]))
     {$passwordErr = "Password is required";}
 	else
 	{
 		$password=$_POST["password"];
 	}
 	
 	if (empty($_POST["repassword"]))
     {$repasswordErr = "Re-Password is required";}
 	else
 		{$repassword=$_POST["repassword"];}

 	if ($_POST["password"]!=$_POST["repassword"])
 	{
 		$passwordErr="Passwords do not match";
 	}
 	else
 		{$repassword=$_POST["repassword"];}
   
   if($usernameErr == "" && $emailErr == "" && $passwordErr =="" && $repasswordErr == "")
   {
   	//register($_POST['username'],$_POST['password'],$_POST['email']);
   	$to = "shoab10@gmail.com";
	$subject = "My subject";
	$txt = "Hello world!";
	$headers = "From: webmaster@example.com" . "\r\n" .
	"CC: somebodyelse@example.com";

	mail($to,$subject,$txt,$headers);
	$_SESSION['username']=$username;
   	header("Location: home.php"); 

   }
}

function test_input($data)
{
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
}
?>

<html>
<head>
	<title>Metube</title>
	<link rel="stylesheet" type="text/css" href="/metube/css/default.css">
</head>
<body>
	<div class='header'>
		<a id='logo-container' href='/metube/home.php' title='MeTube home'>
		<img id='logo' src="/metube/images/metube_logo.jpg" alt='Metube Home'>
		</a>
		<button onclick="/metube/index.php" class="signinbutton" type="button">
			<span id='buttontext'>Sign in</span>
		</button>
	</div>
	<p class="error">*Required Fields</p>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
		<table>
		<tr>
			<td>User Name</td><td><input type="text" name="username" value="<?php echo $username; ?>">
				<span class="error">* <?php echo $usernameErr;?>
				</span><br>
			</td>
		</tr>
		<tr>
			<td>Password</td><td><input type="text" name="password" value="<?php echo $password; ?>">
				<span class="error" >* <?php echo $passwordErr;?>
				</span><br>
			</td>
		</tr>
		<tr>
			<td>Re-enter Password</td><td><input type="text" name="repassword" value="<?php echo $repassword; ?>">
				<span class="error">* <?php echo $repasswordErr;?>
				</span><br>
			</td>
		</tr>
		<tr>
			<td>Email</td><td><input type="text" name="email" value="<?php echo $email; ?>">
				<span class="error">* <?php echo $emailErr;?>
				</span><br>
			</td>
		</tr>
		<tr><td></td><td><input type="submit" name="submit"></td></tr>
		</table>
	</form>
</body>
<html>