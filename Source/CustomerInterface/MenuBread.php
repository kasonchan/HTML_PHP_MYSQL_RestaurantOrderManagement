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
	
<div id="google_translate_element"></div><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
	
<div><h2>Bread<h2></div>
<div>
	<form method="post" action="http://students.csci.unt.edu/~kc0284/CustomerInterface/MenuMeat.php">
		<?php
			require_once("DatabaseFunctions.php");
			

			// ****************************************
			// Connect database
			// ****************************************
			$con = ConnectDatabase();

			// ****************************************
			// Saving ingredients
			// ****************************************
			Saving_Ingredient();

			// ****************************************
			// Print ingredients with buttons
			// ****************************************
			$getIngredientName = "SELECT distinct ingredient_name FROM ingredient WHERE ingredient_type = 'Bread' AND quantity > 0";
			$getIngredientNameResult = mysql_query($getIngredientName);
			
			if($getIngredientNameResult)
			{
				while($row=mysql_fetch_row($getIngredientNameResult))
				{
      				foreach ($row as $value)
      				{
						echo "<input type=\"radio\" name=\"Bread\" value=\"$value\" />";
						$symbols = array("_");
  						$value = str_replace($symbols, " ", $value);
						echo $value . "<BR>";
					}	
				}
			}
		?>
		<div>
			<input  class=Button  type="submit" value="Next" />
		</div>
	</form>
</div>

</body>
</html>	

