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
<?php
	function Redirection()
	{
		$url = 'http://students.csci.unt.edu/~kc0284/CustomerInterface/SplitCheckConfirm.php';
    	echo '<META HTTP-EQUIV=Refresh CONTENT="5; URL='.$url.'">';
	}
?>

<div><h2>Add Tips Confirmation</h2></div>
<div>
<form method="post" action="EnterCreditCard.php">
<?php
	$tips = $_POST['tips'];

	require_once("DatabaseFunctions.php");

	$con = ConnectDatabase();

	$tablet_id = getTabletID();
	$table_number = getTableNumber("$tablet_id");

	// echo getTotalAmount("$table_number") . "<BR>";
	// updateTips("$table_number", "$tips");

	
	echo "<p>" . "Add tips updated." . "</p>";


	echo "<p>" . "<input type=\"text\" name=\"tips\" size=5 maxlength=5 value=\"$tips\" style=\"display:none;\" />" . "</p>";
	echo "<p>" . "<input type=\"submit\" name=\"Submit\" value=\"Continue\" class=\"Button\" />";


?>
</form>
</div>


</body>

</html>