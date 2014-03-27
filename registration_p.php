<?php
$sDatabase = 'db_name';
$sHostname = 'localhost';
$sPort     = 3306;
$sUsername = 'user_name';
$sPassword = 'password';
$sTable    = 'Customers';

$rConn = mysql_connect("$sHostname:$sPort", $sUsername, $sPassword) or die(mysql_error());
mysql_select_db($sDatabase);

define('VDAEMON_PARSE', false);
include('vdaemon.php');

function UserIDCheck($sValue, &$oStatus)
{
    global $sTable;
    $sUserID = addslashes($sValue);
    
    $oStatus->bValid = false;
    $oStatus->sErrMsg = "User ID '$sValue' already exist";
    
    $sQuery = "SELECT UserID FROM $sTable WHERE UserID = '$sUserID'";
    if ($rRecordset = mysql_query($sQuery))
    {
        $oStatus->bValid = mysql_num_rows($rRecordset) == 0;
        mysql_free_result($rRecordset);
    }
}

// VDFormat - VDaemon function for adding or removing slashes
$sUserID = VDFormat($_POST['UserID'], true);
$sQuery = "INSERT INTO $sTable SET UserID = '$sUserID'";
mysql_query($sQuery);
?>
<html>
<head>
<title>Registration Form Sample</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="samples.css" rel="stylesheet" type="text/css">
</head>
<body>
<h1>Registration Form Sample</h1>
<p>Your data has been written to the database</p>
<table cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td width="100">User ID:</td>
    <td width="300"><?php echo $_POST['UserID']; ?></td>
  </tr>
  <tr>
    <td>Password:</td>
    <td><?php echo $_POST['Password']; ?></td>
  </tr>
  <tr>
    <td>Name:</td>
    <td><?php echo $_POST['Name']; ?></td>
  </tr>
  <tr>
    <td>E-mail:</td>
    <td><?php echo $_POST['Email']; ?></td>
  </tr>
</table>
</body>
</html>