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
<div><h2>You Have Ordered</h2></div>
<div>
	<div>
		<?php
			require_once("DatabaseFunctions.php");

			$con = ConnectDatabase();

			$tablet_id = getTabletID();
			$table_number = getTableNumber($tablet_id);

			mysql_query("BEGIN");

			// ****************************************
			// Saving_ingredients
			// ****************************************
			Saving_Ingredient();
			$total_amount = Saving_Ingredient_db("$table_number");
			
			// ****************************************
			// Printing ingredients
			// ****************************************
			Printing_Ingredient_With_Calories_Amount();

			// ****************************************
			// Redirect to WinFreeDessert.php
			// ****************************************
		
			updateTotalAmount("$table_number", "$total_amount");
			updateOccupied("$table_number");
		

			if(is_null(getTableNumber(getTabletID())))
			{
				$tablet_id = getTabletID();

				$order_number = get_Max_Order_Num(0);

				$insertWeborder = "INSERT INTO weborder_status VALUES('$tablet_id', '0', '$order_number')";
  				$insertWeborderResult = mysql_query($insertWeborder);

				echo "<script type=\"text/javascript\">";
				echo "var url ='Checkout.php';";
				echo "var delay = 4;";
				echo "var d = delay * 1000;";
				echo "window.setTimeout ('parent.location.replace(url)', d);";
				echo "</script>";
			}

			if(!is_null(getTableNumber(getTabletID())))
			{
				if(getWin("$table_number") == "N")
				{
					if(getGamePlayed("$table_number") < 3)
					{
						echo "<script type=\"text/javascript\">";
						echo "var url ='WinFreeDessert.php';";
						echo "var delay = 4;";
						echo "var d = delay * 1000;";
						echo "window.setTimeout ('parent.location.replace(url)', d);";
						echo "</script>";
					}
					else
					{
						echo "<script type=\"text/javascript\">";
						echo "var url ='Checkout.php';";
						echo "var delay = 4;";
						echo "var d = delay * 1000;";
						echo "window.setTimeout ('parent.location.replace(url)', d);";
						echo "</script>";
					}
				}
				else if(getWin("$table_number") == "Y")
				{
					echo "<script type=\"text/javascript\">";
					echo "var url ='Checkout.php';";
					echo "var delay = 4;";
					echo "var d = delay * 1000;";
					echo "window.setTimeout ('parent.location.replace(url)', d);";
					echo "</script>";
				}
			}

			mysql_query("COMMIT");

		?>

	</div>
</div>

<!--
<script>parent.location='http://students.csci.unt.edu/~kc0284/CustomerInterface/WinFreeDessert.php';</script>
-->



</body>
</html>

