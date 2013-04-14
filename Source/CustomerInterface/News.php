<!DOCTYPE html>
<html>

<head>
<link rel="shortcut icon" href="sandwich.jpg">
<title>CNN News</title>
<meta name="google-translate-customization" content="a420b98ebeb45ff-5ad8a028603c954d-g6b96ed87fdce08e3-4a"></meta>
<div id="google_translate_element"></div><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>


<link rel = "stylesheet" type = "text/css" href = "style.css"/>
</head>

<body>
<div class=PageContainer>
	<div class=TitleContainer>
		<h1 class=Bold>News</h1>
	<div>
	<div class=FunctionsNavigation>
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
		?>
		<form action="KWichClub.php">
			<input class=Button type="submit" value="K-Wich Club" /><BR>
		</form>
	</div>
	<div class=ContentContainer>
		<iframe class=frame src="http://students.cse.unt.edu/~kc0284/CustomerInterface/NewsMain.php" scrolling="auto"> </iframe>
	</div>
<div>
</body>

</html>