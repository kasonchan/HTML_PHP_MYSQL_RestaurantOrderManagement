<html>

<link rel = "stylesheet" type = "text/css" href = "style.css"/> 

<div style="padding-left: 28%"><h>List of All Changes Made</h></div>

<body><b><font size = "4">
<form method = "post" action = "orders.php">
<br>
<?php
require_once("DatabaseFunctions.php");
		$con = mysql_connect("student-db.cse.unt.edu","kc0284","WHO55amikason");
	if(!$con)
	{
		die('Could not connect: '. mysql_error());
		echo 'Could not connect!\n';
	}
	mysql_select_db("kc0284", $con);
	$getIngredientName = "SELECT distinct ingredient_name FROM ingredient WHERE ingredient_type = 'Dessert'";
	$getIngredientNameResult = mysql_query($getIngredientName);


	if($updatedPreviousPage == false)
	{
    	if($getIngredientNameResult)
	{
		while($row=mysql_fetch_row($getIngredientNameResult))
		{
      		foreach ($row as $value)
			{
				// Testing if the correct value is posted
				// You can comment this line out after testing
//				echo $value . "<input type=\"text\" name=\"$value\" value=\"$_POST[$value]\"/>" . "<BR>";

				$updateIngredientAmount = "UPDATE ingredient SET quantity=$_POST[$value] WHERE ingredient_name= '$value'";
				$updateIngredientAmountResult = mysql_query($updateIngredientAmount);
				if (!$updateIngredientAmountResult) 
				{
					// die('Could not update: '. mysql_error());
					// echo 'Could not update!\n';
				}
				else
					$updatedPreviousPage = true;
			}
		}
	}
	}






	$updatedPreviousPage = false;

	// ****************************************
	// Connect database
	// ****************************************
	$con = mysql_connect("student-db.cse.unt.edu","kc0284","WHO55amikason");
	if(!$con)
	{
		die('Could not connect: '. mysql_error());
		echo 'Could not connect!\n';
	}
	mysql_select_db("kc0284", $con);

	$getIngredientName = "SELECT distinct ingredient_name FROM ingredient WHERE ingredient_type = 'Bread'";
	$getIngredientNameResult = mysql_query($getIngredientName);

    	if($getIngredientNameResult)
	{
		while($row=mysql_fetch_row($getIngredientNameResult))
		{
      		foreach ($row as $value)
			{
				echo "$value = ";
				echo get_quantity($value) . "<br>";
			}
		}
		echo "<br/>";
	}

	$getIngredientName = "SELECT distinct ingredient_name FROM ingredient WHERE ingredient_type = 'Meat'";
	$getIngredientNameResult = mysql_query($getIngredientName);

    	if($getIngredientNameResult)
	{
		while($row=mysql_fetch_row($getIngredientNameResult))
		{
      		foreach ($row as $value)
			{
				echo "$value = ";
				echo get_quantity($value) . "<br>";
			}
		}
		echo "<br/>";
	}

	$getIngredientName = "SELECT distinct ingredient_name FROM ingredient WHERE ingredient_type = 'Veggie'";
	$getIngredientNameResult = mysql_query($getIngredientName);

    	if($getIngredientNameResult)
	{
		while($row=mysql_fetch_row($getIngredientNameResult))
		{
      		foreach ($row as $value)
			{
				echo "$value = ";
				echo get_quantity($value) . "<br>";
			}
		}
		echo "<br/>";
	}

	$getIngredientName = "SELECT distinct ingredient_name FROM ingredient WHERE ingredient_type = 'Drink'";
	$getIngredientNameResult = mysql_query($getIngredientName);

    	if($getIngredientNameResult)
	{
		while($row=mysql_fetch_row($getIngredientNameResult))
		{
      		foreach ($row as $value)
			{
				echo "$value = ";
				echo get_quantity($value) . "<br>";
			}
		}
		echo "<br/>";
	}

	$getIngredientName = "SELECT distinct ingredient_name FROM ingredient WHERE ingredient_type = 'Dessert'";
	$getIngredientNameResult = mysql_query($getIngredientName);

    	if($getIngredientNameResult)
	{
		while($row=mysql_fetch_row($getIngredientNameResult))
		{
      		foreach ($row as $value)
		echo $value . " = ";
		echo get_quantity($value) . "<br>";
		}
	echo "<br/>";
	}


?>

<!-- <div style="padding-left: 30%"><input type = "submit" value = "submit" class = "button3"/>  -->
</div>
</b></font></form>
</body>
<script type="text/javascript">
// Redirect to the menu page
	var url ='orders.php';
	var delay = 4;
	var d = delay * 1000;
	window.setTimeout ('parent.location.replace(url)', d);
</script>

</html>
