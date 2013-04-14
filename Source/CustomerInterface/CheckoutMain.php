<html>

<head>
	
<meta name="google-translate-customization" content="a420b98ebeb45ff-5ad8a028603c954d-g6b96ed87fdce08e3-4a"></meta>
<div id="google_translate_element"></div><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>



<link rel = "stylesheet" type = "text/css" href = "style.css"/>
</head

<body>
<div>
	<table>
		<tr>
			<td>
				<?php
					require_once("DatabaseFunctions.php");
					$con = ConnectDatabase();

				if(!is_null(getTableNumber(getTabletID())))
				{
					echo "<form action=\"SplitCheckMain.php\">";
						echo "<input class=Button  type=\"submit\" value=\"Split Check\" />";
					echo "</form>";
				}
				?>
			</td>
			<td>
				<form action="CustomerLogInMain.php">
					<input class=Button type="submit" value="Free K-Wich" />
				</form>
			</td>
			<td>
				
				<?php
				// echo "Table ID " .  . "<BR>";
				if(!is_null(getTableNumber(getTabletID())))
				{
					echo "<form action=\"Cash.php\">";
						echo "<input class=Button type=\"submit\" value=\"Cash\" />";
					echo "</form>";
				}
				?>
			</td>
			<td>
				<form action="Credit.php">
					<input class=Button type="submit" value="Credit" />
				</form>
			</td>
		</tr>
	</table>
	<table>
		

		<?php
			if(!is_null(getTableNumber(getTabletID())))
			{
				echo "<tr>";
				echo "<td>" . "Order number" . "</td>";
				echo "<td>" . "Price" . "</td>";
				echo "<td>" . "Ingredient name" . "</td>";
				echo "</tr>";

				$table_number = getTableNumber(getTabletID());
				$getFinalAmount = getFinalAmount("$table_number");

				$getOrderIngredientList = "SELECT S.order_number, T.ingredient_price, S.ingredient_name  from order_ingredient as S, ingredient as T WHERE NOT S.order_number='0' AND S.ingredient_name = T.ingredient_name AND NOT T.ingredient_type='drink' AND S.table_number='$table_number'";
				$getOrderIngredientListResult = mysql_query($getOrderIngredientList);

				$i = 0;
				echo "<tr>";
				while($row=mysql_fetch_row($getOrderIngredientListResult))
				{
	      			foreach ($row as $value)
					{
						
	 					echo "<td>" . $value . "</td>";
	 					$i = $i + 1;
	 					if($i == 3)
	 					{
	 						echo "</tr>";
	 						echo "<tr>";
	 						$i = 0;
	 					}
					}
				}
				echo "</tr>";

				$amountWithoutDrink = 0.0;

				echo "</tr>";
				echo "<td>" . "</td>";
				$getOrderIngredientList = "SELECT T.ingredient_price from order_ingredient as S, ingredient as T WHERE S.ingredient_name = T.ingredient_name AND NOT T.ingredient_type='drink' AND S.table_number='$table_number'";
				$getOrderIngredientListResult = mysql_query($getOrderIngredientList);
				while($row=mysql_fetch_row($getOrderIngredientListResult))
				{
	      			foreach ($row as $value)
					{
	 					$amountWithoutDrink = $value + $amountWithoutDrink;
					}
				}

				$drinkAmount = $getFinalAmount - $amountWithoutDrink;
				if($drinkAmount > 0)
					echo "<td>" . $drinkAmount . "</td>";
				else
					echo "<td></td>";

				$getOrderIngredientList = "SELECT distinct S.ingredient_name from order_ingredient as S, ingredient as T WHERE S.ingredient_name = T.ingredient_name AND T.ingredient_type='drink' AND S.table_number='$table_number' AND NOT S.ingredient_name='water'";
				$getOrderIngredientListResult = mysql_query($getOrderIngredientList);

				$i = 0;
				echo "<td>";			
				while($row=mysql_fetch_row($getOrderIngredientListResult))
				{
	      			foreach ($row as $value)
					{
	 					echo $value . " ";
					}
				}

				echo "</td>";
				echo "</tr>";

				echo "<tr>";
				echo "<td>Total Amount:</td>";
				
				echo "<td>";
				echo $getFinalAmount;
				echo "</td>";
				echo "</tr>";
			}
		?>
	</table>

</div>
</body>

</html>