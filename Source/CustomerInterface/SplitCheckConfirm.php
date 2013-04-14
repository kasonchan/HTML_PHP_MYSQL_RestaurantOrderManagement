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
		$url = 'http://students.csci.unt.edu/~kc0284/CustomerInterface/CheckoutMain.php';
    	echo '<META HTTP-EQUIV=Refresh CONTENT="5; URL='.$url.'">';
	}
?>

<div><h2>Split Check Confirmation</h2></div>
<div>
<?php
	$split_check_num = $_POST['split_check_num'];

	require_once("DatabaseFunctions.php");

	$con = ConnectDatabase();

	$tablet_id = getTabletID();
	$table_number = getTableNumber("$tablet_id");

	// echo getTotalAmount("$table_number") . "<BR>";
	updateSplitCheck("$table_number");
	updateSplitCheckNum("$table_number", "$split_check_num");
	updateSplitCheckAmount("$table_number", "$split_check_num");

	echo "<p>" . "Split check updated." . "</p>";
	// Redirection();
?>
	<!-- <form action="AddTipsMain.php">
		<input type="submit" value="Add Tips" />
	</form> -->
	<form action="Cash.php">
		<input type="submit" class=Button value="Cash" />
	</form>
	<form action="Credit.php">
		<input type="submit" class=Button value="Credit" />
	</form>

</div>


</body>

</html>