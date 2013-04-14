<!DOCTYPE html>

<html>

<head>
<link rel = "stylesheet" type = "text/css" href = "style.css"/>
<meta name="google-translate-customization" content="f0592013df00b7d9-2fc4ab44e39e4013-gfe23f37849572180-37"></meta>
</head>

<body>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<?php
$error = false;
$showLogIn = false;
require_once("DatabaseFunctions.php");

// ****************************************************************************
// Form Validation
// ****************************************************************************
// Sample Form's Processing Script
if (count($_POST) > 0) 
{ 
	// ****************************************
	// Connect database
	// ****************************************
	$con = ConnectDatabase();

	// Process the submitted form
  	// Do some simple field checking first...

	$inputUserIDResult = $_POST['inputUserID'];
	$inputPasswordResult = $_POST['inputPassword'];
	
	$getCustomerName = "SELECT distinct waitstaff_lastname FROM waitstaff WHERE waitstaff_id='$inputUserIDResult' AND password='$inputPasswordResult'";
	$getCustomerNameResult = mysql_query($getCustomerName);

  	if( (trim($UserID=$_POST['inputUserID']) == '') OR (trim($Password=$_POST['inputPassword']) == '') )
  	{
    	echo "<div style=\"color:red;\">Invalid usedID and/or password. </div>\n";
    	$error = true;
	}
	else
	{	
		if(!$getCustomerNameResult)
		{
			echo "<div style=\"color:red;\">Invalid userID and/or password. </div>\n";
			$error = true;
		}
		else if($getCustomerNameResult)
		{
			if (!mysql_fetch_row($getCustomerNameResult))
			{
				$error = true;
				echo "<div style=\"color:red;\">Invalid userID and/or password. </div>\n";
			}
		}
  	}

	if(!$error)
	{
		$showLogIn = true;
	}
}

// ****************************************************************************
// End of form validation
// ****************************************************************************
// If there was an error, or the form wasn't submitted,
// ****************************************************************************
// Form input
// ****************************************************************************
if ($error OR count($_POST) == 0)
  echo <<< EOT
  <table>
    <tr><td>  
 	*UserID: <input type="text" name="inputUserID" size="30" maxlength="30" value="$UserID" /><br />
	*Password: <input type="password" name="inputPassword" size="20" maxlength="20" value="$Password" /><br />
    <i>*Required field</i>
    </td></tr>
  </table>
  <p><input type="submit" name="Submit" value="Check and Validate Infos" /></p>
</form>
EOT;
// ****************************************************************************
// End of form input
// ****************************************************************************
?>
</form>


<form method="post" action="LoginConfirmation.php">
<?php
	if($showLogIn == false)
		echo "<input type=\"submit\" name=\"Submit\" value=\"Log in\"  style=\"display:none;\" />";
	else if($showLogIn == true)
		echo "<input type=\"submit\" name=\"Submit\" value=\"Log In\" />";
?>
      <input type="text" name="inputPassword" value="<?=$Password; ?>" style="display:none;" /> 
      <input type="text" name="inputUserID" value="<?=$UserID; ?>" style="display:none;" />
</form>

<input type="button" value="Back" onClick="history.go(-1)">

</body>
</html>
