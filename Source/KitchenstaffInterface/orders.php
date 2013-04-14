<html>
	<title>Orders</title>
<head>
	<link rel = "stylesheet" type = "text/css" href = "style.css"/> 
	<div style="padding-left: 30%"><h>Customer Orders</h></div>
	<br>
</head>

<body>

  <script type="text/javascript">
// Redirect to the order page
	var url ='orders.php';
	var delay = 30;
	var d = delay * 1000;
	window.setTimeout ('parent.location.replace(url)', d);
</script>



<?php
	require_once("DatabaseFunctions.php");
	$con = ConnectDatabase();
	require_once("time.php");
?>


	<div id="right-sidebar" class = "verticalline"><br><br><br>
	<div style="padding-left: 39px"><center><input type = "button" value="Edit Menu" onclick = "window.location.href='editmenu.php'" class = "button3"></center></div></br></br>
<!--	<div style="padding-left: 39px"><input type = "button" value="Clear" onclick = "confirmclear()" class = "button3" id = "clear"></div><br> -->
	<br><br><br><br><br><br><br><br><br>
	<wrap><h2>Kitchen Staff Interface</h2></wrap>
	</div>

	<script type = "text/Javascript">
		function confirmclear()
		{
		var b;
		var a = confirm("Confirm Clear Order");
		if(a == true)
		  {
			b = document.location.reload(true);
		  }
		else 
		  {
			b = alert('Not Clearing Order Yet');
		  }
		document.getElementById("clear").innerHTML= b;
		}
	</script>
	
	<div class = "dx2" align = "left" padding = "20px" style = "overflow:auto">
	<h><center>Order List</center></h><br><br>

<form method = "post" action = "orders.php">
<?php

	$getOrderTimeList = "SELECT distinct time_ordered_hour, time_ordered_min, time_ordered_sec FROM order_ingredient WHERE cook='N' LIMIT 6";
	$getOrderTimeListResult = mysql_query($getOrderTimeList);

	$array[] = 0;	// declared an array to store the time
	if($getOrderTimeListResult)
		while($row = mysql_fetch_row($getOrderTimeListResult))
		{
			foreach($row as $value)
				{
				array_push($array, $value);		// push the time into array single dimensional array
				}		
		}

 for ($i=1; $i<=6; $i++) 
{   
 	$i1 = ($i-1)*3+1;
 	$i2 = ($i-1)*3+2;
	$i3 = ($i-1)*3+3;
	$hour = $array[$i1];
	$min = $array[$i2];
	$sec = $array[$i3];

	$ordernumber = "SELECT distinct order_number,table_number FROM order_ingredient WHERE time_ordered_hour = '$hour' AND time_ordered_min = '$min' AND time_ordered_sec = '$sec'";
	$tableordernumber = mysql_query($ordernumber);
	if($tableordernumber)
	while($row = mysql_fetch_row($tableordernumber))
				   {
					
					echo "<input type=\"text\" name=\"order_number\" value=\"$row[0]\" style=\"display:none;\" >" . " ";
					echo "<input type = \"radio\" name =\"radio\" value = \"$row[0] $row[1]\" />" ;
				          
                                       
				   }


	$table = "SELECT distinct table_number, order_number FROM order_ingredient WHERE time_ordered_hour = '$hour' AND time_ordered_min = '$min' AND time_ordered_sec = '$sec'";
	$tablenumber = mysql_query($table);
	if($tablenumber)
			{
				while($row = mysql_fetch_row($tablenumber))
				   {
					//foreach($row as $value)
						if($row[0] == 0)
						{
							echo "<indent><input type=\"button\" value=\" Weborder\" class = \"button2\" /><indent></indent>";
						}
						else
						{
							echo "<indent><input type=\"button\" value=\" Table $row[0]\" class = \"button2\" /><indent></indent>";
						}

						echo "<indent> Order: $row[1]<indent></indent>";

                                          displayorder($row[0], $row[1]);
						echo "<br/>";
				   }   
 			  }

echo "<br>";
}

 if($radio = $_POST['radio'])  
 {   
   $ordtab = preg_split('/ /', $radio, -1, PREG_SPLIT_OFFSET_CAPTURE);
   $o1 = $ordtab[0][0];
   $o2 = $ordtab[1][0];

   $a = "UPDATE order_ingredient set cook = 'Y' where order_number = '$o1' AND table_number='$o2'";
   mysql_query($a);
}

?>

<?php
	if($_POST['submit'] == false)
		echo "<div style=\"padding-left: 90%\">" . "<input type=\"submit\" name=\"submit\" value=\"Clear\" class = \"button3\" id = \"clear\" />";
	else if($_POST['submit'] == true)
		echo "<div style= \"padding-left: 90%\">" . "<input type=\"submit\" name=\"Submit\" value=\"Confirm Clear\" class = \"button3\" />";
?>

</form>
	</div>



	</body>
	</html>
