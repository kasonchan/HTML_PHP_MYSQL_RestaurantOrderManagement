<!DOCTYPE html>
<html>

<head>
<link rel="shortcut icon" href="sandwich.jpg">
<title>K-Wich Call Staff</title>
<meta name="google-translate-customization" content="a420b98ebeb45ff-5ad8a028603c954d-g6b96ed87fdce08e3-4a"></meta>
<div id="google_translate_element"></div><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<link rel = "stylesheet" type = "text/css" href = "style.css"/> 
<meta name="google-translate-customization" content="f0592013df00b7d9-2fc4ab44e39e4013-gfe23f37849572180-37"></meta>
</head>

<body>
	<div class=PageContainer>
		<div class=TitleContainer>
			<h1 class=Bold>Call Staff</h1>
		</div>
		<div class=FunctionsNavigation>
			<?php
			require_once("DatabaseFunctions.php");
			$con = ConnectDatabase();
			
			if(getDrinkQuantity(getTableNumber(getTabletID())))
			{
				echo "<form action=\"Refill.php\">";
					echo "<input class=Button type=\"submit\" value=\"Refill\" />" . "<BR>";
				echo "</form>";
			}
			?>
			<form action="Menu.php">
				<input class=Button type="submit" value="Add Order" /><BR>
			</form>
			<form action="Checkout.php">
				<input class=Button type="submit" value="Checkout" /><BR>
			</form>
		</div>
		<div class=ContentContainer>
			<iframe class=frame src="http://students.cse.unt.edu/~kc0284/CustomerInterface/CallStaffMain.php" scrolling="no"> </iframe>
		</div>
	</div>


</body>

</html>