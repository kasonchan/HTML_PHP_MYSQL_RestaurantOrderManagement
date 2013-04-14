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

<div><h2>Credit Card</h2></div>
<div>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<?php
	require_once("DatabaseFunctions.php");

	$con = ConnectDatabase();

	$tips = $_POST['tips'];

	$con = ConnectDatabase();

	if(!is_null(getTableNumber(getTabletID())))
	{
		$tablet_id = getTabletID();
		$table_number = getTableNumber("$tablet_id");
		
		$getFinalAmount = getFinalAmount("$table_number");

		$error = false;
		$showLogIn = false;
	}
	else
	{
		$tablet_id = getTabletID();
		$order_number = getOrderNumberWeb("$tablet_id");
		
		$getFinalAmount = getTotalAmountWeb('0', $order_number);
	}

	$tips = $_POST['tips']; // simplification
  	if (!(is_numeric($tips) AND ($tips >= 0) AND ($tips <= 99999))) 
  	{
    	$error = true;
    	echo "<div style=\"color:red;\">Invalid tips.</div>\n";
  	}

if (count($_POST) > 0)
{
  	$creditCardNo = $_POST['creditCardNo']; // simplification
  	if (!(is_numeric($creditCardNo) AND ($creditCardNo >= 1000000000000000) AND ($creditCardNo <= 9999999999999999)) OR trim($creditCardNo) == '') 
  	{
    	$error = true;
    	echo "<div style=\"color:red;\">Invalid credit card number.</div>\n";
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
 	<p>Amount: <input type="text" name="amount" size=5 maxlength=5 value="$getFinalAmount" disabled="disabled" /></p>
	<p>Add Tips (Min value: 0): <input type="text" name="tips" size=5 maxlength=5  value="$tips" /></p>
	<p>*Credit card no. (16 digits): <input type="text" name="creditCardNo" size=16 maxlength=16 value="$creditCardNo" /> </p>
    <i>*Required field</i>
    </td></tr>
  </table>
  <p><input type="submit" name="Submit" class=Button value="Check and Validate Infos" /></p>
</form>
EOT;

?>
</form>

<form method="post" action="EnterCreditCardConfirm.php">
<?php
	if($showLogIn == false)
		echo "<input type=\"submit\" name=\"Submit\" value=\"Confirm payment\"  style=\"display:none;\" />";
	else if($showLogIn == true)
		echo "<input type=\"submit\" name=\"Submit\" value=\"Confirm payment\" class=\"Button\" />";
?>
<p><input type="text" name="amount" size=5 maxlength=5 value="<?=$getFinalAmount; ?>"  style="display:none;" > </p>
<p><input type="text" name="tips" size=5 maxlength=5 value="<?=$_POST['tips']; ?>" style="display:none;" ></p>
<p><input type="text" name="creditCardNo" size=12 maxlength=12 value="<?=$_POST['creditCardNo']; ?>" style="display:none;" ></p>
</form>
</div>


</body>

</html>