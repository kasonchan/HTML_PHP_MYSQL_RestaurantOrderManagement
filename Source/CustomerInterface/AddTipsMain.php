<!DOCTYPE html>
<html>

<head>
	
<meta name="google-translate-customization" content="a420b98ebeb45ff-5ad8a028603c954d-g6b96ed87fdce08e3-4a"></meta>
<div id="google_translate_element"></div><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<link rel = "stylesheet" type = "text/css" href = "style.css"/> 
</head>

<body>
<div><h2>Add Tips</h2></div>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<?php
$error = false;
$showLogIn = false;

require_once("DatabaseFunctions.php");

// Connect database
$con = ConnectDatabase();

$tablet_id = getTabletID();
$table_number = getTableNumber("$tablet_id");

$totalAmount = getTotalAmount("$table_number");

$maxAmount = 9999;

// ****************************************************************************
// Form Validation
// ****************************************************************************
// Sample Form's Processing Script
if (count($_POST) > 0) 
{ 
	$tips = $_POST['tips'];

	if(!(($tips<="$maxAmount") AND ($tips>=0)))
	{
		$error = true;
		echo "<div style=\"color:red;\">Invalid split number. </div>\n";
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
 	<p>Total amount: $$totalAmount</p>
	<p>Enter tips amount: <input type="text" name="tips" size=5 maxlength=5 /></p>
    </td></tr>
  </table>
  <p><input type="button" value="Back" class=Button  onClick="history.go(-1)" ><input type="submit" name="Confirm Update" class=Button value="Check and validate infos" /></p>
</form>
EOT;
// ****************************************************************************
// End of form input
// ****************************************************************************
?> 
</form>

<form method="post" action="AddTipsConfirm.php">
<?php
	if($showLogIn == false)
		echo "<input type=\"submit\" name=\"Submit\" value=\"Confirm Split\"  style=\"display:none;\" />";
	else if($showLogIn == true)
		echo "<p>" . "<input type=\"submit\" name=\"Submit\" value=\"Confirm Tips\" class=Button />";
	echo "<p>" . "<input type=\"text\" name=\"tips\" size=5 maxlength=5 value=\"$tips\" style=\"display:none;\" />" . "</p>";
?>
    
</form>
</body>

</html>

