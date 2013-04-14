<!DOCTYPE html>
<html>
<head>
<link rel = "stylesheet" type = "text/css" href = "style.css"/> 
</head>

<body>

<div style="padding-left: 40%"><h>Bread</h><br></div>
<div>


<?php
	
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


?>

<!-- Starting the form here -->
<form method="post" class = "form" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<?php

	$error = false;
	$showLogIn = false;

	// ****************************************************************************
	// Form Validation
	// ****************************************************************************
	// Sample Form's Processing Script
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{ 
		// Process the submitted form
  		// Do some simple field checking first...

		// Change the ingredient_type = "Meat" for meat page and so forth
  		$getIngredientName = "SELECT distinct ingredient_name FROM ingredient WHERE ingredient_type = 'Bread'";
		$getIngredientNameResult = mysql_query($getIngredientName);
			
		if($getIngredientNameResult)
		{
			while($row=mysql_fetch_row($getIngredientNameResult))
			{
      			foreach ($row as $value)
				{
					if(!(is_numeric($_POST[$value]) AND ($_POST[$value] >= 0) AND ($_POST[$value] <= 500)))
					{
						$error = true;
						echo "<div style=\"color:red;\">" . "Invalid " . $value . " amount." . "</div>\n";
					} 
				}
			}
		}

		if(!$error)
		{
			$showLogIn = true;
		}
	}

	// ****************************************************************************
	// End of form validation
	// ****************************************************************************
	// If there was an error, or the form wasn't submitted,
	// ****************************************************************************
	// Form input
	// ****************************************************************************
	// ****************************************
	// Print ingredients name and quantity from database
	// ****************************************
	
	// Change the ingredient_type = "Meat" for meat page and so forth
	$getIngredientName = "SELECT distinct ingredient_name FROM ingredient WHERE ingredient_type = 'Bread'";
	$getIngredientNameResult = mysql_query($getIngredientName);
			
	if($getIngredientNameResult)
	{
		while($row=mysql_fetch_row($getIngredientNameResult))
		{
      		foreach ($row as $value)
			{
	//			echo $value . " ";

				$getIngredientAmount = "SELECT distinct quantity FROM ingredient WHERE ingredient_name = \"$value\"";
				$getIngredientAmountResult = mysql_query($getIngredientAmount);

				if($getIngredientAmountResult)
				{
					while($row2 = mysql_fetch_row($getIngredientAmountResult))
					{
						foreach($row2 as $amount)
						{
							$symbols = array("_");
  							$value = str_replace($symbols, " ", $value);
							
							echo "<div style = \"right\"><h2>" . $value . ':' . " " . $amount . "  ";

							$symbols = array(" ");
  							$value = str_replace($symbols, "_", $value);

							echo "<input type=\"text\" name=\"$value\" value=\"$_POST[$value]\" class = \"Box2\" maxlength=\"3\" />" . "</h2></div>";
						}	
					}
				}
			
			}
		}
	}
	

	echo "<div id=\"right-sidebar1\"><br><br><br><br><br><br>
	<div style = \"padding-left:10%\"><input type=\"submit\" name = \"Submit\" value = \"Update\" class = \"button3\"/></div>
	</div>";
?>
</form>

<!--Change action back to your directory-->
<form method="post" action="meat.php?var=1">
<?php
	if($showLogIn == false)
		echo "<input type=\"submit\" name=\"Confirm Update\" value=\"Confirm Update\"  style=\"display:none;\" />";
	else if($showLogIn == true)
		//echo "<input type=\"submit\" name=\"Confirm Update\" value=\"Confirm Update\" />";

	echo "<div id=\"right-sidebar1\"><br><br><br><br><br><br>
	<div style = \"padding-left:10%\"><input type=\"submit\" name = \"Confirm Update\" value = \"Confirm Update\" class = \"button3\"/></div>
	</div>";
	// Testing if the correct value is posted
	// You can comment this part out after testing
	// You just need change the ingredient_type to access the appropriate table
	$getIngredientName = "SELECT distinct ingredient_name FROM ingredient WHERE ingredient_type = 'Bread'";
	$getIngredientNameResult = mysql_query($getIngredientName);

    if($getIngredientNameResult)
	{
		while($row=mysql_fetch_row($getIngredientNameResult))
		{
      		foreach ($row as $value)
			{
				// Testing if the correct value is posted
				echo "<input type=\"text\" name=\"$value\" value=\"$_POST[$value]\"/ style=\"display:none;\" />" . "<BR>";
			}
		}
	}

	mysql_close($con);
?>
</form>

<!--Leave it as comment-->
<!--<input type="button" value="Back" onClick="history.go(-1)" class="MouseOutButton">-->
</div>

</body>

<input type="hidden" name="var" value="1">
<html>
