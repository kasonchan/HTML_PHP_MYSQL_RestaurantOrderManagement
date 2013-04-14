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
<div><h1>Free K-Wich</h2></div>
<div>
	<?php
			require_once("DatabaseFunctions.php");
			$con = ConnectDatabase();

			if(!is_null(getTableNumber(getTabletID())))
			{
				echo "<form action=\"CallStaff.php\">";
					echo "<input class=Button type=\"submit\" value=\"Call Staff\" />";
				echo "</form>";
				echo "<form action=\"Refill.php\">";
					echo "<input class=Button type=\"submit\" value=\"Refill\" />" . "<BR>";
				echo "</form>";
				echo "<form action=\"Menu.php\">";
					echo "<input class=Button type=\"submit\" value=\"Add Order\" />" . "<BR>";
				echo "</form>";
			}
			echo "<form action=\"KWichClub.php\">";
					echo "<input class=Button type=\"submit\" value=\"K-Wich Club\" />" . "<BR>";
				echo "</form>";
			echo "<form action=\"Checkout.php\">";
					echo "<input class=Button type=\"submit\" value=\"Checkout\" />" . "<BR>";
				echo "</form>";
	?>
	
</div>
<iframe id="myframe" src="http://students.cse.unt.edu/~kc0284/CustomerInterface/KWichMain.php" scrolling="auto"> </iframe>
</body>

</html>

