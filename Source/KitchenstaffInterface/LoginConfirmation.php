<!DOCTYPE html>

<html>

<head>
<img src = "photo/main.JPG">
<link rel = "stylesheet" type = "text/css" href = "style.css"/>
<meta name="google-translate-customization" content="f0592013df00b7d9-2fc4ab44e39e4013-gfe23f37849572180-37"></meta>
</head>

<body>
<div>
<?php
	$UserID = $_POST['inputUserID'];
	
	// Printing
	echo "<p>" . "Welcome back to K-Wich!" . "<p>";
	echo "<p>" . "You are logged in as " . $_POST['inputUserID'] . "<p>";

	require_once("DatabaseFunctions.php");

	$con = ConnectDatabase();

	$tablet_id = getTabletID();

	mysql_query("SET foreign_key_checks = 0");

	$updateIPNumber = "UPDATE kitchenstaff SET kitchenstaff_ip = '$tablet_id' WHERE kitchenstaff_id= '$UserID'";
	$updateIPResult = mysql_query($updateIPNumber);
	echo "<p>" . "This tablet has assigned to UserID " . $UserID . "." . "</p>";

	mysql_query("SET foreign_key_checks = 1");
?>
</div>
<script type="text/javascript">
// Redirect to the menu page
	var url ='editmenu.php';
	var delay = 4;
	var d = delay * 1000;
	window.setTimeout ('parent.location.replace(url)', d);
</script>

</body>
</html>