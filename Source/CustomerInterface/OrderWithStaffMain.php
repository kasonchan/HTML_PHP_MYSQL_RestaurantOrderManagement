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
		$table_number = getTableNumber("$tablet_id");

		echo "<p>" . "Welcome to K-Wich!" . "</p>";
		echo "<p>" . "Wait-staff will arrive shortly!" . "</p>";

		callStaff($table_number);

		echo "<script type=\"text/javascript\">";
		echo "var url ='CustomerHomepage.php';";
		echo "var delay = 5;";
		echo "var d = delay * 1000;";
		echo "window.setTimeout ('parent.location.replace(url)', d);";
		echo "</script>";
	?>
</div>

</body>

</html>



