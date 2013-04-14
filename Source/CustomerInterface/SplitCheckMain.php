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
<div><h2>Split Check</h2></div>
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

$maxPeople = 5;

// ****************************************************************************
// Form Validation
// ****************************************************************************
// Sample Form's Processing Script
if (count($_POST) > 0) 
{ 
	$split_check_num = $_POST['split_check_num'];

	if(!(($split_check_num<="$maxPeople") AND ($split_check_num>=2)))
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
	<p>Enter the number of splits (Min splits: 2, Max splits: 5) : <input type="text" name="split_check_num" size=1 maxlength=1 /></p>
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

<form method="post" action="SplitCheckConfirm.php">
<?php
	if($showLogIn == false)
		echo "<input type=\"submit\" name=\"Submit\" value=\"Confirm Split\"  style=\"display:none;\" />";
	else if($showLogIn == true)
		echo "<p>" . "<input type=\"submit\" name=\"Submit\" value=\"Confirm Split\" class=Button />";
	echo "<p>" . "<input class=Button type=\"text\" name=\"split_check_num\" size=1 maxlength=1 value=\"$split_check_num\" style=\"display:none;\" />" . "</p>";
?>
    
</form>
</body>

</html>

