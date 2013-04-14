<!DOCTYPE html>
<html>

<head>
<link rel = "stylesheet" type = "text/css" href = "style.css"/> 
</head>

<body>
<div><h1>Tablet Assignment</h2></div>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<?php
$error = false;
$showLogIn = false;

require_once("DatabaseFunctions.php");

// echo "HTTP_USER_AGENT " . $_SERVER['HTTP_USER_AGENT'] . "<BR>";
// echo "REMOTE_ADDR " . $_SERVER['REMOTE_ADDR'] . "<BR>";
$tablet_id = getTabletID();

// ****************************************
// Connect database
// ****************************************
$con = ConnectDatabase();

$MaxTable = getMaxTable();

// echo $MaxTable . "<BR>";
// ****************************************************************************
// Form Validation
// ****************************************************************************
// Sample Form's Processing Script
if (count($_POST) > 0) 
{ 
	$table_number = $_POST['table_number'];

	if(!(($table_number<="$MaxTable") AND ($table_number>=1)))
	{
		$error = true;
		echo "<div style=\"color:red;\">Invalid table number. </div>\n";
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
 	<p>Tablet ID: $tablet_id</p>
	<p>Assign to Table <input type="text" name="table_number" size=3 maxlength=3 /></p>
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

<form method="post" action="TabletAssignmentsConfirm.php">
<?php
	if($showLogIn == false)
		echo "<input type=\"submit\" name=\"Submit\" value=\"Confirm Update\"  style=\"display:none;\" />";
	else if($showLogIn == true)
	echo "<p>" . "<input type=\"submit\" name=\"Submit\" value=\"Confirm Update\" />";
	echo "<p>" . "<textarea rows=\"3\" cols=\"50\" name=\"tablet_id\" style=\"display:none;\" />" . $tablet_id . "</textarea>" . "</p>";
	echo "<p>" . "<input type=\"text\" name=\"table_number\" size=3 maxlength=3 value=\"$table_number\" style=\"display:none;\" />" . "</p>";
?>
    
</form>







<!-- <div>
	<?php
		require_once("DatabaseFunctions.php");
		
		$con = ConnectDatabase();

		






		echo "<form method=\"post\" action=\"http://students.cse.unt.edu/~kc0284/TabletAssignment/TabletAssignmentsConfirm.php\">";
			echo "<p>" . "<textarea rows=\"3\" cols=\"50\" name=\"tablet_id\" />" . $tablet_id . "</textarea>" . "</p>";
			echo "<p>" . "<input type=\"text\" name=\"table_number\" size=3 maxlength=3 />" . "</p>";
			echo "<p>" . "<input type=\"submit\" name=\"Confirm Update\" value=\"Confirm Update\" />" . "</p>";
		echo "</form>";

	?>
</div> -->
</body>

</html>

