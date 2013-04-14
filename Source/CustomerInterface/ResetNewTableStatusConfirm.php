<!DOCTYPE html>
<html>

<head>
<link rel = "stylesheet" type = "text/css" href = "style.css"/> 
</head>

<body>
<?php
	// function Redirection()
	// {
	// 	$url = 'http://students.csci.unt.edu/~kc0284/CustomerInterface/.php';
 //    	echo '<META HTTP-EQUIV=Refresh CONTENT="2; URL='.$url.'">';
	// 	mysql_query("SET foreign_key_checks = 1");
	// }
?>

<div><h1>Reset New Table Status Confirmation</h2></div>
<div>
<?php
	$MAX_SIZE = 100;

	$numberOfTables = $_POST['numberOfTables'];
	echo "Reset " . $numberOfTables . " tables.<BR>"; 

	require_once("DatabaseFunctions.php");

	$con = ConnectDatabase();

	mysql_query("SET foreign_key_checks = 0");

	$deleteOrderIngredient = "DELETE FROM order_ingredient";
	$deleteOrderIngredientResult = mysql_query($deleteOrderIngredient);

	$deleteTablesStatus = "DELETE FROM table_status";
	$deleteTablesStatusResult = mysql_query($deleteTablesStatus);


	for($i = 1; $i <= $numberOfTables; $i++)
	{
		$insertNumOfTables = "INSERT INTO table_status VALUES('$i', 'N', 'N', 'N', 'N', 'N', 0, 0, 'N', 0, 0, 0, 'N')";
		$insertNumOfTables = mysql_query($insertNumOfTables);
	}

	// Send free sandwich email to the current birthday month customer
	foreach (getEmailList() as $value)
	{
		// echo $value. "<BR>";
		updateSentCoupon($value);
	}
?>
</div>


</body>

</html>