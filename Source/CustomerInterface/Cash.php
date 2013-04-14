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

	// setCheck($table_number);
?>
<!-- <form action="AddTipsMain.php">
		<input type="submit" value="Add Tips" />
</form> -->
<table>
	<tr>
		<td>
			<input type="button" value="Back" class=Button  onClick="history.go(-1)" >
		</td>
		<td>
			<form action="CashConfirm.php">
					<input type="submit" class=Button value="Continue" />
			</form>
		</td>
	</tr>
</table>
</div>
</body>
</html>