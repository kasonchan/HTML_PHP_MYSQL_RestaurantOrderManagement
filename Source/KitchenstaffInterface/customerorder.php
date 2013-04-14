<html>
<title>Orders</title>
<head>
	<link rel = "stylesheet" type = "text/css" href = "style.css"/> 
	<h>Orders</h>
	<br><br>
</head>
<body>
	<?php
	require_once("DatabaseFunctions.php");
	$con = ConnectDatabase();
	require_once("time.php");
	?>

	<div id="right-sidebar" class = "verticalline"> 
	<br><br><br>
	</wrap><div style="padding-left: 39px"><input type = "button" value="Edit Menu" class = "button3"></div></wrap></br></br>
	</wrap><div style="padding-left: 39px"><input type = "button" value="Clear" class = "button3"></wrap></div><br>
	<br><br><br><br><br><br><br><br><br>
	<wrap><h2>Kitchen Staff Interface</h2></wrap>
	</div>

	<?php
	echo "<form><div>";
	for($i = 1; $i <7; $i++)
	  {
		echo"<indent></indent><indent></indent>
		<indent></indent><input type=\"button\" value=\"Table $i\" . \"displaytime()\" class = \"button1\" />";
	  }
	echo "</div></form>";
	?>

	<div class = "colbox">
	<h>Order list</h>

	<?php
	displaytime();
	getOrderTimeList();
	?>

	</div>
	<img src = "photo/logo.JPG">
	</body>
	</html>