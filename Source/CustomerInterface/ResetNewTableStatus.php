<!DOCTYPE html>
<html>

<head>
<link rel = "stylesheet" type = "text/css" href = "style.css"/> 
</head>

<body>
<div><h1>Reset New Table Status</h2></div>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<?php
$MAX_SIZE = 100;

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

	$numberOfTables = $_POST['numberOfTables'];

	if(!(($numberOfTables<=$MAX_SIZE) AND ($numberOfTables>=1)))
	{
		$error = true;
		echo "<div style=\"color:red;\">Invalid number of tables. </div>\n";
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
 	<p>How many new tables do you want to reset? <input type="text" name="numberOfTables" size=5 maxlength=5 /></p>
    </td></tr>
  </table>
  <p><input type="submit" name="Confirm Update" value="Check and validate infos" /></p>
</form>
EOT;
// ****************************************************************************
// End of form input
// ****************************************************************************
?>
</form>

<form method="post" action="ResetNewTableStatusConfirm.php">
<?php
	if($showLogIn == false)
		echo "<input type=\"submit\" name=\"Submit\" value=\"Confirm Reset\"  style=\"display:none;\" />";
	else if($showLogIn == true)
	echo "<p>" . "<input type=\"submit\" name=\"Submit\" value=\"Confirm Reset\" />";
	echo "<p>" . "<input type=\"text\" name=\"numberOfTables\" size=5 maxlength=5 value=\"$numberOfTables\" style=\"display:none;\" />" . "</p>";
?>
    
</form>
</body>

</html>

