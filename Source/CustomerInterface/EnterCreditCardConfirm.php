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
<div>
<?php
	require_once("DatabaseFunctions.php");

	$con = ConnectDatabase();

	$tablet_id = getTabletID();
	$table_number = getTableNumber($tablet_id);

	$amount = $_POST['amount'];
	$tips = $_POST['tips'];
	$creditCardNo = $_POST['creditCardNo'];

	echo "<p>" . "Credit card no: " . $creditCardNo . "</p>";
	echo "<p>" . "Amount: " . $amount . "</p>";
	echo "<p>" . "Tips: " . $tips . "</p>";
	$amount = $amount + $tips;
	echo "<p>" . "Total amount: " . $amount . "</p>";
	echo "<p>" . "Thank you!" . "</p>";


	// Delete the database weborder_status
	$removeWeborder = "DELETE FROM weborder_status WHERE tablet_id='$tablet_id'";
	$removeWeborderResult = mysql_query($removeWeborder);

	if(is_null(getTableNumber(getTabletID())))
	{
		echo "<script type=\"text/javascript\">";
		echo "var url ='OnlineKWichCustomerSurvey.php';";
		echo "var delay = 4;";
		echo "var d = delay * 1000;";
		echo "window.setTimeout ('parent.location.replace(url)', d);";
		echo "</script>";
	}
	else
	{
		echo "<script type=\"text/javascript\">";
		echo "var url ='InstoreKWichCustomerSurvey.php';";
		echo "var delay = 4;";
		echo "var d = delay * 1000;";
		echo "window.setTimeout ('parent.location.replace(url)', d);";
		echo "</script>";

	}
?>







</body>
</html>