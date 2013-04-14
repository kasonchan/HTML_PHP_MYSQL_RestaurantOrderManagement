<!DOCTYPE html>
<html>

<head>
<link rel = "stylesheet" type = "text/css" href = "style.css"/> 
</head>

<body>
<?php
	function Redirection()
	{
		$url = 'http://students.csci.unt.edu/~kc0284/CustomerInterface/CustomerHomepage.php';
    	echo '<META HTTP-EQUIV=Refresh CONTENT="2; URL='.$url.'">';
		mysql_query("SET foreign_key_checks = 1");
	}
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

	mysql_query("SET foreign_key_checks = 0");

	$getTableNumber = "SELECT distinct table_number FROM tablet WHERE tablet_id = '$tablet_id'";
	$getTableNumberResult = mysql_query($getTableNumber);

	if ($getTableNumberResult) 
	{
		while($row=mysql_fetch_row($getTableNumberResult))
		{
      		foreach ($row as $value)
			{
				if ($value != $table_number)
				{
					$updateTableNumber = "UPDATE tablet SET table_number = '$table_number' WHERE tablet_id= '$tablet_id'";
					$updateTableNumberResult = mysql_query($updateTableNumber);
					echo "<p>" . "This tablet has assigned to table " . $table_number . "." . "</p>";

					Redirection();
					exit;
				}
				else
				{
					echo "<p>" . "This tablet has assigned to table " . $table_number . "." . "</p>";
					Redirection();
					exit;
				}
			}
		}
		$insertTableNumber = "INSERT INTO tablet VALUES('$tablet_id', '$table_number')";
		$insertTableNumberResult = mysql_query($insertTableNumber);
		echo "<p>" . "This tablet has assigned to table " . $table_number . "." . "</p>";
		Redirection();

	}
	
?>
</div>


</body>

</html>