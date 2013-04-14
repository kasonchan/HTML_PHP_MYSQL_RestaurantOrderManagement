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

	echo "<p>" . "Your refill will arrive shortly." . "</p>";
	echo "<p>" . "Thank you." . "</p>";


	$drink = $_POST["Drink"];
	echo "<input type=\"text\" name=\"Drink\" value=\"$drink\" style=\"display:none;\" />";

	$tablet_id = getTabletID();
	$table_number = getTableNumber($tablet_id);

	$hour = date(G);
	$minute = date(i);
	$second = date(s);

	$getMaxOrder = get_Max_Order_Num($table_number); 

	Insert_Ingredient_db("$table_number", "$getMaxOrder", "$drink", 'N', 'Y', $hour, $minute, $second);
	update_ingredient("$drink");
	updateRefill($table_number);

?>
</div>
<script type="text/javascript">
// Redirect to the menu page
	var url ='Checkout.php';
	var delay = 4;
	var d = delay * 1000;
	window.setTimeout ('parent.location.replace(url)', d);
</script>
</body>
</html>