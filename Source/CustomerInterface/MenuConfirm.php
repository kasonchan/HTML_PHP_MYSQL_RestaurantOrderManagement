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
<div><h2>Confirm Order</h2></div>
<div>
	<form method="post" action="http://students.csci.unt.edu/~kc0284/CustomerInterface/ConfirmConfirmation.php">
		<?php
			include("DatabaseFunctions.php");

			// ****************************************
			// Saving_ingredients
			// ****************************************
			Saving_Ingredient();
			
			// ****************************************
			// Printing ingredients
			// ****************************************
			Printing_Ingredient();
		?>
		<div>
			<input type="button" class=Button  value="Back" onClick="history.go(-1)">
			<input type="submit" class=Button  value="Confirm Order" />
		</div>
	</form>
</div>

</body>
</html>

