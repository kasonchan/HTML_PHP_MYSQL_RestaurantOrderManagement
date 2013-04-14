<!DOCTYPE html>
<html>

<head>
	
<meta name="google-translate-customization" content="a420b98ebeb45ff-5ad8a028603c954d-g6b96ed87fdce08e3-4a"></meta>
<div id="google_translate_element"></div><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<link rel = "stylesheet" type = "text/css" href = "style.css"/>
</head>

<body>
<div><h2>Win Or Lose?<h2></div>
<div>
	<?php
		require_once("DatabaseFunctions.php");

		$randomAnswer = rand(1, 5);
		// echo "RANDOM: ". $randomAnswer . "<BR>";
		// echo $randomAnswer . "<BR>";
		$_POST["Card"] = rand(1, 5);
		// echo "POST: " . $_POST["Card"] . "<BR>";
		
		$con  = ConnectDatabase();

		$tablet_id = getTabletID();
		$table_number = getTableNumber("$tablet_id");

		if($_POST["Card"] == $randomAnswer)
		{
			echo "<div >" . "Congratulations! You won a free cookie!" . "<BR>" . "<div>";

			insertFreeCookie("$table_number");
			$total_amount = getTotalAmount("$table_number");
			updateFreeCookie("$table_number", "$total_amount");

			updateGamePlayed("$table_number");
			updateWin("$table_number");

		}
		else
		{
			echo "<div >" . "Sorry! You did not win a free cookie!" . "<BR>" . "<div>";
			updateGamePlayed("$table_number");
		}

		// if(getWin("$table_number") == 'N' AND getGamePlayed("$table_number") < 3)
		// 	echo getWin("$table_number") . "<BR>" . getGamePlayed("$table_number") . "<BR>";
		
		if(!is_null(getTableNumber(getTabletID())))
		{
			if(getWin("$table_number") == "N")
			{
				if(getGamePlayed("$table_number") < 3)
				{
					echo "<script type=\"text/javascript\">";
					echo "var url ='WinFreeDessert.php';";
					echo "var delay = 4;";
					echo "var d = delay * 1000;";
					echo "window.setTimeout ('parent.location.replace(url)', d);";
					echo "</script>";
				}
				else
				{
					echo "<script type=\"text/javascript\">";
					echo "var url ='Checkout.php';";
					echo "var delay = 4;";
					echo "var d = delay * 1000;";
					echo "window.setTimeout ('parent.location.replace(url)', d);";
					echo "</script>";
				}
			}
			else if(getWin("$table_number") == "Y")
			{
				echo "<script type=\"text/javascript\">";
				echo "var url ='Checkout.php';";
				echo "var delay = 4;";
				echo "var d = delay * 1000;";
				echo "window.setTimeout ('parent.location.replace(url)', d);";
				echo "</script>";
			}
		}
		
	?>
</div>


</body>
</html>

