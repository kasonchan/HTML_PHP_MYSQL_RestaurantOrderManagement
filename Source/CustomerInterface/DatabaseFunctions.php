<?php

function getMaxQuantityCount($ingredient_type)
{
	$getMaxQuantityCount = "SELECT COUNT(ingredient_name) FROM ingredient WHERE quantity= ( SELECT MAX(quantity) FROM ingredient WHERE ingredient_type = '$ingredient_type')";
	$getMaxQuantityCountResult = mysql_query($getMaxQuantityCount);

	while($row=mysql_fetch_row($getMaxQuantityCountResult))
	{
      	foreach ($row as $value)
		{
			return $value;
		}
	}
}

function getMaxName($ingredient_type)
{
	$getMaxName = "SELECT ingredient_name FROM ingredient WHERE quantity = (SELECT MAX(quantity) FROM ingredient WHERE ingredient_type = '$ingredient_type')";
	$getMaxNameResult = mysql_query($getMaxName);

		while($row=mysql_fetch_row($getMaxNameResult))
		{
	      	foreach ($row as $value)
			{
				return $value;
			}
		}
}

function getGamePlayed($table_number)
{
	$getGamePlayed = "SELECT gamePlayed FROM table_status WHERE table_number = '$table_number'";
	$getGamePlayedResult = mysql_query($getGamePlayed);

	while($row=mysql_fetch_row($getGamePlayedResult))
	{
      	foreach ($row as $value)
		{
			return $value;
		}
	}
}

function getWin($table_number)
{
	$getWin = "SELECT win FROM table_status WHERE table_number = '$table_number'";
	$getWinResult = mysql_query($getWin);

	while($row=mysql_fetch_row($getWinResult))
	{
      	foreach ($row as $value)
		{
			return $value;
		}
	}
}

function updateWin($table_number)
{
	$updateWin = "UPDATE table_status SET win = 'Y' WHERE table_number = '$table_number'";
	$updateWinResult = mysql_query($updateWin);
}

function updateGamePlayed($table_number)
{
	$gamePlayed = getGamePlayed($table_number) + 1;

	$updateGamePlayed = "UPDATE table_status SET gamePlayed = '$gamePlayed' WHERE table_number = '$table_number'";
	$updateGamePlayed = mysql_query($updateGamePlayed);
}



function ConnectDatabase() 
{
	$con = mysql_connect("student-db.cse.unt.edu","kc0284","WHO55amikason");
	if (!$con)
	{
  		die('Could not connect: ' . mysql_error());
		echo 'Could not connect!\n';
	}
	mysql_select_db("kc0284", $con);
	return $con;
}

function getDrinkQuantity($table_number)
{
	$getDrinkQuantity = "SELECT COUNT(T.ingredient_name) FROM ingredient as S, order_ingredient as T WHERE T.ingredient_name = S.ingredient_name AND T.table_number='$table_number' AND S.ingredient_type = 'Drink' AND NOT (T.ingredient_name = 'water')";
	$getDrinkQuantityResult = mysql_query($getDrinkQuantity);

	while($row=mysql_fetch_row($getDrinkQuantityResult))
	{
      	foreach ($row as $value)
		{
			return $value;
		}
	}
}

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

function get_Max_Order_Num($table_number)
{
	// echo $table_number . " in get_Max_Order_Num" . "<BR>";
	$getMaxOrder = "SELECT MAX(order_number) FROM order_ingredient WHERE table_number = '$table_number'";
	$getMaxOrderResult = mysql_query($getMaxOrder);

	while($row=mysql_fetch_row($getMaxOrderResult))
	{
      	foreach ($row as $value)
		{
 			return $value;
		}
	}
	return 0;
}

function Insert_Ingredient_db($table_number, $order_number, $ingredient_name, $serve, $cook, $hour, $minute, $second)
{
	// echo $table_number . " in Insert_Ingredient_db" . "<BR>";
	// echo $order_number . "<BR>";

	$insertIngredient = "INSERT INTO order_ingredient VALUES('$table_number', '$order_number', '$ingredient_name', '$serve', '$cook', '$hour', '$minute', '$second')";
	$insertIngredientResult = mysql_query($insertIngredient);
}

function get_quantity($ingredient_name)
{
	$get_quantity = "SELECT quantity FROM ingredient WHERE ingredient_name = '$ingredient_name'";
	$get_quantity_result = mysql_query($get_quantity);

	while($row=mysql_fetch_row($get_quantity_result))
	{
      	foreach ($row as $value)
		{
			return $value;
		}
	}
}

function update_ingredient($ingredient_name)
{
	$get_quantity = get_quantity("$ingredient_name") - 1;

	$update_ingredient = "UPDATE ingredient SET quantity = '$get_quantity' WHERE ingredient_name = '$ingredient_name'";
	$update_ingredient_result = mysql_query($update_ingredient);
}

function Saving_Ingredient_db($table_number) 
{ 
	mysql_query("BEGIN");
	// echo $table_number . " in Saving_Ingredient_db" . "<BR>";
	$order_number = get_Max_Order_Num("$table_number") + 1;
	// echo Insert_Ingredient_db("$table_number", 'White') . "<BR>";

	$hour = date(G);
	$minute = date(i);
	$second = date(s);

	if(!trim($_POST["Bread"]) == '')
	{	
		$bread = $_POST["Bread"];
		if(get_quantity("$bread") > 0)
		{
			Insert_Ingredient_db("$table_number", "$order_number", "$bread", 'N', 'N', $hour, $minute, $second);
			update_ingredient("$bread");
		
			$totalAmount = $totalAmount + getAmount($bread);
		}
		else if(get_quantity("$bread") <= 0)
		{
			echo "<div style=\"color:red;\">" . "Sorry! " . "The " . $bread . " that you ordered is out of stock.</div>";
			echo "<div style=\"color:red;\">" . "You will be redirected to the menu page to reorder.</div>";

			mysql_query("ROLLBACK");

			$url = 'MenuBread.php';
    		echo '<META HTTP-EQUIV=Refresh CONTENT="1; URL='.$url.'">'; 
			
			return;
		}
	}

	if(!trim($_POST["Meat"]) == '')
	{
		$meat = $_POST["Meat"];
		if(get_quantity("$meat") > 0)
		{
			Insert_Ingredient_db("$table_number", "$order_number", "$meat", 'N', 'N', $hour, $minute, $second);
			update_ingredient("$meat");
			
			$totalAmount = $totalAmount + getAmount($meat);
		}
		else if(get_quantity("$meat") <= 0)
		{
			echo "<div style=\"color:red;\">" . "Sorry! " . "The " . $meat . " that you ordered is out of stock.</div>";
			echo "<div style=\"color:red;\">" . "You will be redirected to the menu page to reorder.</div>";

			mysql_query("ROLLBACK");

			$url = 'MenuBread.php';
    		echo '<META HTTP-EQUIV=Refresh CONTENT="1; URL='.$url.'">'; 
			
			return;
		}

	}

	if(!empty($_POST["Veggie"]))
	{
		// echo "Veggie" . "<br>";
		$veggie = $_POST["Veggie"];
		if(!empty($veggie))
		{
			foreach($veggie as $value)
			{
				// echo $value;
				if(get_quantity("$value") > 0)
				{
					Insert_Ingredient_db("$table_number", "$order_number", "$value", 'N', 'N', $hour, $minute, $second);
					update_ingredient("$value");
					
					$totalAmount = $totalAmount + getAmount($value);
				}
				else if(get_quantity("$value") <= 0)
				{
					echo "<div style=\"color:red;\">" . "Sorry! " . "The " . $value . " that you ordered is out of stock.</div>";
					echo "<div style=\"color:red;\">" . "You will be redirected to the menu page to reorder.</div>";

					mysql_query("ROLLBACK");

					$url = 'MenuBread.php';
		    		echo '<META HTTP-EQUIV=Refresh CONTENT="1; URL='.$url.'">'; 
					
					return;
				}

			}
		}
	}
			
	if(!empty($_POST["Dressing"]))
	{
		// echo "Dressing" . "<br>";
		$dressing = $_POST["Dressing"];
		if(!empty($dressing))
		{
			foreach($dressing as $value)
			{
				if(get_quantity("$value") > 0)
				{
					Insert_Ingredient_db("$table_number", "$order_number", "$value", 'N', 'N', $hour, $minute, $second);
					update_ingredient("$value");
					$totalAmount = $totalAmount + getAmount($value);
				}
				else if(get_quantity("$value") <= 0)
				{
					echo "<div style=\"color:red;\">" . "Sorry! " . "The " . $value . " that you ordered is out of stock.</div>";
					echo "<div style=\"color:red;\">" . "You will be redirected to the menu page to reorder.</div>";

					mysql_query("ROLLBACK");

					$url = 'MenuBread.php';
		    		echo '<META HTTP-EQUIV=Refresh CONTENT="1; URL='.$url.'">'; 
					
					return;
				}
			}
		}
	}
			
	if(!trim($_POST["Drink"]) == '')
	{

		$drink = $_POST["Drink"];
		if(get_quantity("$drink") > 0)
		{
			Insert_Ingredient_db("$table_number", "$order_number", "$drink", 'N', 'Y', $hour, $minute, $second);
			update_ingredient("$drink");
			$totalAmount = $totalAmount + getAmount($drink);
		}
		else if(get_quantity("$drink") <= 0)
		{
			echo "<div style=\"color:red;\">" . "Sorry! " . "The " . $drink . " that you ordered is out of stock.</div>";
			echo "<div style=\"color:red;\">" . "You will be redirected to the menu page to reorder.</div>";

			mysql_query("ROLLBACK");

			$url = 'MenuBread.php';
    		echo '<META HTTP-EQUIV=Refresh CONTENT="1; URL='.$url.'">'; 
			
			return;
		}

	}

	if(!empty($_POST["Dessert"]))
	{
		// echo "Dessert" . "<br>";
		$dessert = $_POST["Dessert"];
		if(!empty($dessert))
		{			
			foreach($dessert as $value)
			{
				if(get_quantity("$value") > 0)
				{
					Insert_Ingredient_db("$table_number", "$order_number", "$value", 'N', 'N', $hour, $minute, $second);
					update_ingredient("$value");
					$totalAmount = $totalAmount + getAmount($value);
				}
				else if(get_quantity("$value") <= 0)
				{
					echo "<div style=\"color:red;\">" . "Sorry! " . "The " . $value . " that you ordered is out of stock.</div>";
					echo "<div style=\"color:red;\">" . "You will be redirected to the menu page to reorder.</div>";
					
					mysql_query("ROLLBACK");

					$url = 'MenuBread.php';
		    		echo '<META HTTP-EQUIV=Refresh CONTENT="1; URL='.$url.'">'; 
					
					return;
				}
			}
		}	
	}

	mysql_query("COMMIT");
	return $totalAmount;
}

function getTotalAmountWeb($table_number, $order_number)
{
	$totalAmountWeb = 0;

	$getTotalAmountWeb = "SELECT SUM(T.ingredient_price) FROM ingredient as T, order_ingredient as S, weborder_status as W WHERE S.order_number=W.order_number AND S.ingredient_name = T.ingredient_name AND S.table_number = W.table_number";
	$getTotalAmountWebResult = mysql_query($getTotalAmountWeb);

	while($row=mysql_fetch_row($getTotalAmountWebResult))
	{
      	foreach ($row as $value)
		{
 			$totalAmountWeb = $totalAmountWeb + $value;
		}
	}
	
	return $totalAmountWeb;
}

function getOrderNumberWeb($tablet_id)
{
	$getOrderNumberWeb = "SELECT order_number FROM weborder_status WHERE tablet_id='$tablet_id'";
	$getOrderNumberWebResult = mysql_query($getOrderNumberWeb);

	while($row=mysql_fetch_row($getOrderNumberWebResult))
	{
      	foreach ($row as $value)
		{
 			return $value;
		}
	}
	return 0;
}

function Printing_tab()
{
	for($i = 0; $i < 10; $i++)
		echo "&nbsp;";
}

function getCalories($ingredient)
{
	$totalCalories = 0;

	$con = ConnectDatabase();

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
	return $totalCalories;
}

function getAmount($ingredient)
{
	$totalAmount = 0;

	$con = ConnectDatabase();

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
	return $totalAmount;
}

function Printing_Ingredient()
{
	$symbols = array("_");

	if(!trim($_POST["Bread"]) == '')
	{
		echo "Bread" . "<br>";
		$bread = $_POST["Bread"];
		echo Printing_tab();
  		$bread = str_replace($symbols, " ", $bread);
		echo $bread . "<br>";
	}

	if(!trim($_POST["Meat"]) == '')
	{
		echo "Meat" . "<br>";
		$meat = $_POST["Meat"];
		echo Printing_tab();
		$meat = str_replace($symbols, " ", $meat);
		echo $meat . "<br>";
	}

	if(!empty($_POST["Veggie"]))
	{
		echo "Veggie" . "<br>";
		$veggie = $_POST["Veggie"];
		if(!empty($veggie))
		{
			foreach($veggie as $value)
			{
				echo Printing_tab();
				$value = str_replace($symbols, " ", $value);
				echo $value . "<br>";
			}
		}
	}

	if(!empty($_POST["Dressing"]))		
	{
		echo "Dressing" . "<br>";
		$dressing = $_POST["Dressing"];
		if(!empty($dressing))
		{			
			foreach($dressing as $value)
			{
				echo Printing_tab();
				$value = str_replace($symbols, " ", $value);
				echo $value . "<br>";
			}	
		}
	}
	
	if(!trim($_POST["Drink"]) == '')
	{
		echo "Drink" . "<br>";
		$drink = $_POST["Drink"];
		echo Printing_tab();
		$drink = str_replace($symbols, " ", $drink);
		echo $drink . "<br>";
	}

	if(!empty($_POST["Dessert"]))
	{
		echo "Dessert" . "<br>";
		$dessert = $_POST["Dessert"];
		if(!empty($dessert))
		{			
			foreach($dessert as $value)
			{
				echo Printing_tab();
				$value = str_replace($symbols, " ", $value);
				echo $value . "<br>";
			}
		}	
	}
}

function Printing_Ingredient_With_Calories_Amount()
{
	$totalCalories = 0;
	$totalAmount = 0;
	
	$symbols = array("_");

	if(!trim($_POST["Bread"]) == '')
	{
		echo "Bread" . "<br>";
		$bread = $_POST["Bread"];

		$totalCalories = $totalCalories + getCalories($bread);
		$totalAmount = $totalAmount + getAmount($bread);

		echo Printing_tab();
		$bread = str_replace($symbols, " ", $bread);
		echo $bread . "<br>";
		
	}

	if(!trim($_POST["Meat"]) == '')
	{
		echo "Meat" . "<br>";
		$meat = $_POST["Meat"];
		
		$totalCalories = $totalCalories + getCalories($meat);
		$totalAmount = $totalAmount + getAmount($meat);

		echo Printing_tab();
		$meat = str_replace($symbols, " ", $meat);
		echo $meat . "<br>";
		
	}

	if(!empty($_POST["Veggie"]))
	{	
		echo "Veggie" . "<br>";
		$veggie = $_POST["Veggie"];
		if(!empty($veggie))
		{
			foreach($veggie as $value)
			{
				$totalCalories = $totalCalories + getCalories($value);
				$totalAmount = $totalAmount + getAmount($value);

				echo Printing_tab();
				$value = str_replace($symbols, " ", $value);
				echo $value . "<br>";
			}
		}
	}
			
	if(!empty($_POST["Dressing"]))
	{
		echo "Dressing" . "<br>";
		$dressing = $_POST["Dressing"];
		if(!empty($dressing))
		{			
			foreach($dressing as $value)
			{
				$totalCalories = $totalCalories + getCalories($value);
				$totalAmount = $totalAmount + getAmount($value);

				echo Printing_tab();
				$value = str_replace($symbols, " ", $value);
				echo $value . "<br>";
			}	
		}
	}
	
	if(!trim($_POST["Drink"]) == '')
	{
		echo "Drink" . "<br>";
		$drink = $_POST["Drink"];
		
		$totalCalories = $totalCalories + getCalories($drink);
		$totalAmount = $totalAmount + getAmount($drink);

		echo Printing_tab();
		$drink = str_replace($symbols, " ", $drink);
		echo $drink . "<br>";
		
	}

	if(!empty($_POST["Dessert"]))
	{
		echo "Dessert" . "<br>";
		$dessert = $_POST["Dessert"];
		if(!empty($dessert))
		{			
			foreach($dessert as $value)
			{
				$totalCalories = $totalCalories + getCalories($value);
				$totalAmount = $totalAmount + getAmount($value);

				echo Printing_tab();
				$value = str_replace($symbols, " ", $value);
				echo $value . "<br>";
			}
		}	
	}

	echo "Total calories" . "<BR>";
	echo Printing_tab();
	echo $totalCalories . "<BR>";

	echo "Amount" . "<BR>";
	echo Printing_tab();
	echo "$" . $totalAmount . "<BR>";
}

function getTabletID()
{
	// $tablet_id = $_SERVER['HTTP_USER_AGENT'];
	// echo "HTTP_USER_AGENT " . $_SERVER['HTTP_USER_AGENT'] . "<BR>";
	// $tablet_id = $_SERVER['REMOTE_ADDR'];
	// echo "REMOTE_ADDR " . $_SERVER['REMOTE_ADDR'] . "<BR>";
	$tablet_id = $_SERVER['REMOTE_ADDR'];
	return $tablet_id;
}

function getTableNumber($tablet_id)
{
	$getTableNumber = "SELECT distinct table_number FROM tablet WHERE tablet_id = '$tablet_id'";
	$getTableNumberResult = mysql_query($getTableNumber);

	if ($getTableNumberResult) 
	{
		while($row=mysql_fetch_row($getTableNumberResult))
		{
      		foreach ($row as $value)
			{
				return $value;
			}
		}
	}
}

function getTotalAmount($table_number)
{
	$getTotalAmount = "SELECT distinct total FROM table_status WHERE table_number = '$table_number'";
	$getTotalAmountResult = mysql_query($getTotalAmount);

	if($getTotalAmountResult)
	{
		while($row=mysql_fetch_row($getTotalAmountResult))
		{
      		foreach ($row as $value)
			{
				return $value;
			}
		}
	}
}

function updateTotalAmount($table_number, $total_amount)
{
	$getTotalAmount = "SELECT distinct total FROM table_status WHERE table_number = '$table_number'";
	$getTotalAmountResult = mysql_query($getTotalAmount);

	// echo "Total amount before: " . $total_amount . "<BR>";

	if($getTotalAmountResult)
	{
		while($row=mysql_fetch_row($getTotalAmountResult))
		{
      		foreach ($row as $value)
			{
				$total_amount = $total_amount + $value . "<BR>";
			}
		}
	}

	// echo "Total amount after: " . $total_amount . "<BR>";

	$updateTotalAmount = "UPDATE table_status SET total = '$total_amount' WHERE table_number = '$table_number'";
	$updateTotalAmountResult = mysql_query($updateTotalAmount);
}

function updateFreeWich($table_number, $total_amount)
{
	$total_amount = $total_amount - 5.50;

	$updateFreeWich = "UPDATE table_status SET total = '$total_amount' WHERE table_number = '$table_number'";
	$updateFreeWichResult = mysql_query($updateFreeWich);
}

function updateOccupied($table_number)
{
	$updateOccupied = "UPDATE table_status SET occupied = 'Y' WHERE table_number = '$table_number'";
	$updateOccupiedResult = mysql_query($updateOccupied);
}

function updateRefill($table_number)
{
	$updateOccupied = "UPDATE table_status SET refill = 'Y' WHERE table_number = '$table_number'";
	$updateOccupiedResult = mysql_query($updateOccupied);
}

function getMaxTable()
{
	$getMaxTable = "SELECT MAX(table_number) from table_status";
	$getMaxTableResult = mysql_query($getMaxTable);

	while($row=mysql_fetch_row($getMaxTableResult))
	{
      	foreach ($row as $value)
		{
			// echo $value . "<BR>";
			return $value;
		}
	}
}

function insertFreeCookie($table_number)
{
	$hour = date(G);
	$minute = date(i);
	$second = date(s);

	Insert_Ingredient_db($table_number, '0', 'Cookie', 'N', 'Y', $hour, $minute, $second);
	updateTotalAmount($table_number, 1.5);
}

function updateFreeCookie($table_number, $total_amount)
{
	$total_amount = $total_amount - 1.5;

	$updateFreeWich = "UPDATE table_status SET total = '$total_amount' WHERE table_number = '$table_number'";
	$updateFreeWichResult = mysql_query($updateFreeWich);
}

function updateSplitCheck($table_number)
{
	$updateSplitCheck = "UPDATE table_status SET split_check = 'Y' WHERE table_number = '$table_number'";
	$updateSplitCheckResult = mysql_query($updateSplitCheck);
}

function updateSplitCheckNum($table_number, $split_check_num)
{
	$updateSplitCheckNum = "UPDATE table_status SET split_check_num = '$split_check_num' WHERE table_number = '$table_number'";
	$updateSplitCheckNumResult = mysql_query($updateSplitCheckNum);
}

function updateSplitCheckAmount($table_number, $split_check_num)
{
	$totalAmount = getTotalAmount($table_number);
	 // + getTipsAmount($table_number);
	$split_check_amount = $totalAmount / $split_check_num;

	$updateSplitCheckAmount = "UPDATE table_status SET split_check_amount = '$split_check_amount' WHERE table_number = '$table_number'";
	$updateSplitCheckAmountResult = mysql_query($updateSplitCheckAmount);
}

function getTipsAmount($table_number)
{
	$getTipsAmount = "SELECT distinct tips FROM table_status WHERE table_number = '$table_number'";
	$getTipsAmountResult = mysql_query($getTipsAmount);

	if($getTipsAmountResult)
	{
		while($row=mysql_fetch_row($getTipsAmountResult))
		{
      		foreach ($row as $value)
			{
				return $value;
			}
		}
	}
}

function updateTips($table_number, $tips)
{
	$updateTips = "UPDATE table_status SET tips = '$tips' WHERE table_number = '$table_number'";
	$updateTipsResult = mysql_query($updateTips);
}

function getCouponNum($email)
{
	$getCouponNum = "SELECT coupon FROM customer WHERE email='$email'";
	$getCouponNumResult = mysql_query($getCouponNum);

	if($getCouponNumResult)
	{
		while($row=mysql_fetch_row($getCouponNumResult))
		{
      		foreach ($row as $value)
			{
				return $value;
			}
		}
	}
}

function removeCoupon($email)
{
	$couponNum = getCouponNum($email);
	$couponNum = $couponNum - 1;

	$removeCoupon = "UPDATE customer SET coupon = '$couponNum' WHERE email = '$email'";
	$removeCouponResult = mysql_query($removeCoupon);
}

function getBirthDay($email)
{
	$getBirthDay = "SELECT distinct date_of_birth_day FROM customer WHERE email='$email'";
	$getBirthDayResult = mysql_query($getBirthDay);

	if($getBirthDayResult)
	{
		while($row=mysql_fetch_row($getBirthDayResult))
		{
      		foreach ($row as $value)
			{
				return $value;
			}
		}
	}
}

function getBirthMonth($email)
{
	$getBirthMonth = "SELECT distinct date_of_birth_month FROM customer WHERE email='$email'";
	$getBirthMonthResult = mysql_query($getBirthMonth);

	if($getBirthMonthResult)
	{
		while($row=mysql_fetch_row($getBirthMonthResult))
		{
      		foreach ($row as $value)
			{
				return $value;
			}
		}
	}
}

function getBirthYear($email)
{
	$getBirthYear = "SELECT distinct date_of_birth_year FROM customer WHERE email='$email'";
	$getBirthYearResult = mysql_query($getBirthYear);

	if($getBirthYearResult)
	{
		while($row=mysql_fetch_row($getBirthYearResult))
		{
      		foreach ($row as $value)
			{
				return $value;
			}
		}
	}
}

function callStaff($table_number)
{
	$callStaff = "UPDATE table_status SET call_staff = 'Y' WHERE table_number = '$table_number'";
	$callStaffResult = mysql_query($callStaff);
}

function setCheck($table_number)
{
	$setCheck = "UPDATE table_status SET checkout = 'Y' WHERE table_number = '$table_number'";
	$setCheckResult = mysql_query($setCheck);
}

function getEmailList()
{
	$getEmailList = "SELECT email FROM customer";
	$getEmailListResult = mysql_query($getEmailList);

	return $row = mysql_fetch_array($getEmailListResult);
}

function getSentCoupon($email)
{
	$getSentCoupon = "SELECT sent_coupon FROM customer WHERE email = '$email'";
	$getSentCouponResult = mysql_query($getSentCoupon);

	if($getSentCouponResult)
	{
		while($row=mysql_fetch_row($getSentCouponResult))
		{
      		foreach ($row as $value)
			{
				return $value;
			}
		}
	}
}

function updateSentCoupon($email)
{	
	$date = date(n);
	
	$getSentCoupon = getSentCoupon("$email");
	$getCouponNum = getCouponNum($email);

	if ((getBirthMonth($email) == $date) and $getSentCoupon == 'N') 
	{
		$getCouponNum = $getCouponNum + 1;

		$updateSentCoupon = "UPDATE customer SET sent_coupon='Y'";
		$updateSentCouponResult = mysql_query($updateSentCoupon);
		
		$updateCoupon = "UPDATE customer SET coupon='$getCouponNum'";
		$updateCouponResult = mysql_query($updateCoupon);

		$to = $email;
    	$subject = "Happy birthday wish from K-Wich";
    	$message = "Hi " . $email . ",\n\n" . "Thank you for signing up to K-Wich Club.\n" . "You can login to Free K-Wich to claim your free sandwich.\n\n" . "Best Wiches,\n" . "K-Wich Club\n";
    	mail($to,$subject,$message);
	}
}

function getSplitCheck($table_number)
{
	$getSplitCheck = "SELECT split_check FROM table_status WHERE table_number = '$table_number'";
	$getSplitCheckResult = mysql_query($getSplitCheck);

	if($getSplitCheckResult)
	{
		while($row=mysql_fetch_row($getSplitCheckResult))
		{
      		foreach ($row as $value)
			{
				return $value;
			}
		}
	}
}

function getFinalAmount($table_number)
{
	if(getSplitCheck($table_number) == 'Y')
	{
		$getFinalAmount = "SELECT split_check_amount FROM table_status WHERE table_number = '$table_number'";
		$getFinalAmountResult = mysql_query($getFinalAmount);

		if($getFinalAmountResult)
		{
			while($row=mysql_fetch_row($getFinalAmountResult))
			{
				foreach($row as $value)
					return $value;
			}
		}
	}
	else if(getSplitCheck($table_number) == 'N')
	{
		$getFinalAmount = "SELECT total FROM table_status WHERE table_number = '$table_number'";
		$getFinalAmountResult = mysql_query($getFinalAmount);

		while($row=mysql_fetch_row($getFinalAmountResult))
		{
			foreach($row as $value)
				return $value;
		}
	}

}
?>

