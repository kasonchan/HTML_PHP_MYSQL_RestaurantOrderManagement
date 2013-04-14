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
<div><h2>Meat</h2></div>
<div>
	<form method="post" action="http://students.csci.unt.edu/~kc0284/CustomerInterface/MenuVeggie.php">
		<?php 
			include("DatabaseFunctions.php");

			// ****************************************
			// Connect database
			// ****************************************
			$con = ConnectDatabase();

			// ****************************************
			// Saving ingredients
			// ****************************************
			Saving_Ingredient();

			if(!trim($_POST["Bread"]) == '')
			{
				// ****************************************
				// Print ingredients with buttons
				// ****************************************

				$ingredient_type = 'Meat';

				$query = "SELECT distinct ingredient_name FROM ingredient WHERE ingredient_type = 'Meat' AND quantity > 0";
				$r = mysql_query($query);
				if($r)
				{
					while($row=mysql_fetch_row($r))
					{
  						foreach ($row as $value)
      					{
							echo "<input type=\"radio\" name=\"Meat\" value=\"$value\" />";
							$symbols = array("_");

	  						if(getMaxName('Meat') == "$value")
	  						{
	  							$value = str_replace($symbols, " ", $value);
								echo $value . " <<< Daily Special!<BR>";
							}
							else
							{
								$value = str_replace($symbols, " ", $value);
								echo $value . "<BR>";
							}
						}	
					}
				}
			}
			else
			{
				$url = 'http://students.csci.unt.edu/~kc0284/CustomerInterface/MenuDrink.php';
    			echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL='.$url.'">'; 
			}
		?>
		<div>
			<input type="button"  class=Button value="Back" onClick="history.go(-1)" class="MouseOutButton">
			<input type="submit" class=Button  class="MouseOutButton" value="Next" />
		</div>
	</form>
</div>
</body>

</html>

