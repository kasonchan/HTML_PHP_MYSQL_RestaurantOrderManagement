<!DOCTYPE html>

<?php
function Saving_Ingredient() 
{ 
	$bread = $_POST["Bread"];
	echo "<input type=\"text\" name=\"Bread\" value=\"$bread\" style=\"display:none;\" />";
			
	$meat = $_POST["Meat"];
	echo "<input type=\"text\" name=\"Meat\" value=\"$meat\" style=\"display:none;\" />";
			
	$veggie = $_POST["Veggie"];
	if(!empty($veggie))
	{
		foreach($veggie as $value)
		echo "<input type=\"checkbox\" name=\"Veggie[]\" value=\"$value\" checked=\"checked\" style=\"display:none;\" />";
	}
			
	$dressing = $_POST["Dressing"];
	if(!empty($dressing))
	{			
		foreach($dressing as $value)
			echo "<input type=\"checkbox\" name=\"Dressing[]\" value=\"$value\" checked=\"checked\" style=\"display:none;\" />";
	}
			
	$drink = $_POST["Drink"];
	echo "<input type=\"text\" name=\"Drink\" value=\"$drink\" style=\"display:none;\" />";

	$dessert = $_POST["Dessert"];
	if(!empty($dessert))
	{			
		foreach($dessert as $value)
			echo "<input type=\"checkbox\" name=\"Dessert[]\" value=\"$value\" checked=\"checked\" style=\"display:none;\" />";
	}
}

function Printing_tab()
{
	for($i = 0; $i < 10; $i++)
		echo "&nbsp;";
}

function getCalories($ingredient)
{
	$totalCalories = 0;

	$con = mysql_connect("student-db.cse.unt.edu","kc0284","WHO55amikason");
	if (!$con)
	{
  		die('Could not connect: ' . mysql_error());
		echo 'Could not connect!\n';
	}
	mysql_select_db("kc0284", $con);

	$getIngredientCalories = "SELECT distinct ingredient_calories FROM ingredient WHERE ingredient_name = '$ingredient'";
	$getIngredientCaloriesResult = mysql_query($getIngredientCalories);

	if($getIngredientCaloriesResult)
	{
		while($row=mysql_fetch_row($getIngredientCaloriesResult))
		{
      			foreach ($row as $value)
				$totalCalories = $totalCalories + $value;
		}	
	}
	else
	{
		// echo "Error!" . "<br>";
		return 0;
	}
	mysql_close($con);

	return $totalCalories;
}

function getAmount($ingredient)
{
	$totalAmount = 0;

	$con = mysql_connect("student-db.cse.unt.edu","kc0284","WHO55amikason");
	if (!$con)
	{
  		die('Could not connect: ' . mysql_error());
		echo 'Could not connect!\n';
	}
	mysql_select_db("kc0284", $con);

	$getAmount = "SELECT distinct ingredient_price FROM ingredient WHERE ingredient_name = '$ingredient'";
	$getAmountResult = mysql_query($getAmount);

	if($getAmountResult)
	{
		while($row=mysql_fetch_row($getAmountResult))
		{
      			foreach ($row as $value)
				$totalAmount = $totalAmount + $value;
		}	
	}
	else
	{
		// echo "Error!" . "<br>";
		return 0;
	}
	mysql_close($con);

	return $totalAmount;
}

function Printing_Ingredient()
{
	if(!trim($_POST["Bread"]) == '')
	{
		echo "Bread" . "<br>";
		$bread = $_POST["Bread"];
		echo Printing_tab();
		echo $bread . "<br>";
	}

	if(!trim($_POST["Meat"]) == '')
	{
		echo "Meat" . "<br>";
		$meat = $_POST["Meat"];
		echo Printing_tab();
		echo $meat . "<br>";
	}

	if(!trim($_POST["Veggie"]) == '')
	{
		echo "Veggie" . "<br>";
		$veggie = $_POST["Veggie"];
		if(!empty($veggie))
		{
			foreach($veggie as $value)
			{
				echo Printing_tab();
				echo $value . "<br>";
			}
		}
	}

	if(!trim($_POST["Dressing"]) == '')		
	{
		echo "Dressing" . "<br>";
		$dressing = $_POST["Dressing"];
		if(!empty($dressing))
		{			
			foreach($dressing as $value)
			{
				echo Printing_tab();
				echo $value . "<br>";
			}	
		}
	}
	
	if(!trim($_POST["Drink"]) == '')
	{
		echo "Drink" . "<br>";
		$drink = $_POST["Drink"];
		echo Printing_tab();
		echo $drink . "<br>";
	}

	if(!trim($_POST["Dessert"]) == '')
	{
		echo "Dessert" . "<br>";
		$dessert = $_POST["Dessert"];
		if(!empty($dessert))
		{			
			foreach($dessert as $value)
			{
				echo Printing_tab();
				echo $value . "<br>";
				$totalCalories = $totalCalories + getCalories($value);
				$totalAmount = $totalAmount + getAmount($value);
			}
		}	
	}
}

function Printing_Ingredient_With_Calories_Amount()
{
	$totalCalories = 0;
	$totalAmount = 0;
	
	if(!trim($_POST["Bread"]) == '')
	{
		echo "Bread" . "<br>";
		$bread = $_POST["Bread"];
		echo Printing_tab();
		echo $bread . "<br>";
		$totalCalories = $totalCalories + getCalories($bread);
		$totalAmount = $totalAmount + getAmount($bread);
	}

	if(!trim($_POST["Meat"]) == '')
	{
		echo "Meat" . "<br>";
		$meat = $_POST["Meat"];
		echo Printing_tab();
		echo $meat . "<br>";
		$totalCalories = $totalCalories + getCalories($meat);
		$totalAmount = $totalAmount + getAmount($meat);
	}

	if(!trim($_POST["Veggie"]) == '')
	{	
		echo "Veggie" . "<br>";
		$veggie = $_POST["Veggie"];
		if(!empty($veggie))
		{
			foreach($veggie as $value)
			{
				echo Printing_tab();
				echo $value . "<br>";
				$totalCalories = $totalCalories + getCalories($value);
				$totalAmount = $totalAmount + getAmount($value);
			}
		}
	}
			
	if(!trim($_POST["Dressing"]) == '')
	{
		echo "Dressing" . "<br>";
		$dressing = $_POST["Dressing"];
		if(!empty($dressing))
		{			
			foreach($dressing as $value)
			{
				echo Printing_tab();
				echo $value . "<br>";
				$totalCalories = $totalCalories + getCalories($value);
				$totalAmount = $totalAmount + getAmount($value);
			}	
		}
	}
	
	if(!trim($_POST["Drink"]) == '')
	{
		echo "Drink" . "<br>";
		$drink = $_POST["Drink"];
		echo Printing_tab();
		echo $drink . "<br>";
		$totalCalories = $totalCalories + getCalories($drink);
		$totalAmount = $totalAmount + getAmount($drink);
	}

	if(!trim($_POST["Dessert"]) == '')
	{
		echo "Dessert" . "<br>";
		$dessert = $_POST["Dessert"];
		if(!empty($dessert))
		{			
			foreach($dessert as $value)
			{
				echo Printing_tab();
				echo $value . "<br>";
				$totalCalories = $totalCalories + getCalories($value);
				$totalAmount = $totalAmount + getAmount($value);
			}
		}	
	}

	echo "Total calories" . "<BR>";
	echo Printing_tab();
	echo $totalCalories . "<BR>";

	echo "Total amount" . "<BR>";
	echo Printing_tab();
	echo "$" . $totalAmount . " plus Tax<BR>";
}
?>

