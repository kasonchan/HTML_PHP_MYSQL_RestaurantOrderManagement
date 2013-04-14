<!DOCTYPE html>
<html>

<head>
<link rel = "stylesheet" type = "text/css" href = "style.css"/> 
</head>

<body>
<?php
	
?>

<div><h1>Tablet Assignment Confirmation</h2></div>
<div>
<?php
	$tablet_id = $_POST['tablet_id'];
	// echo $tablet_id . "<BR>";
	$table_number = $_POST['table_number'];
	// echo $table_number . "<BR>";

	require_once("DatabaseFunctions.php");

	$con = ConnectDatabase();

	$tablet_id = getTabletID();

	mysql_query("SET foreign_key_checks = 0");

	$updateIPNumber = "UPDATE kitchenstaff SET kitchenstaff_ip = '$tablet_id' WHERE tablet_id= '$tablet_id'";
	$updateIPResult = mysql_query($updateIPNumber);
	echo "<p>" . "This tablet has assigned to table " . $table_number . "." . "</p>";
	
?>
</div>


</body>

</html>