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
<div>
<form method="post" action="CheckoutMain.php">
<?php
	require_once("DatabaseFunctions.php");

	$con = ConnectDatabase();

	$email = $_POST['inputEmail'];
	$tablet_id = getTabletID();
	$table_number = getTableNumber("$tablet_id");

	echo "<p>" . "Welcome back to K-Wich!" . "</p>";
	echo "<p>" . "You are logged in as " . $email . ".</p>";
	
	// echo "<p>" . "<input type=\"text\" name=\"email\" value=\"$email\" />" . "</p>";
	
	$couponNum = getCouponNum("$email");
	// echo $couponNum . "<BR>";
	

	if ($couponNum > 0)
	{
		$year = getBirthYear("$email");
		$month = getBirthMonth("$email");
		$day = getBirthDay("$email");

		if(date(n) == $month)
		{
			// echo "Equal" . "<BR>";
			$totalAmount = getTotalAmount("$table_number");
			// echo $totalAmount . "<BR>";
			if($totalAmount >= 5.50)
				updateFreeWich($table_number, $totalAmount);
			removeCoupon($email);
			echo "You have gained a free K-Wich." . "<BR>";
		}
		else if($month < date(n))
		{
			removeCoupon ($email);
			echo "Sorry! You don't have valid coupon." . "<BR>";
		}
	}
	else
	{
		echo "Sorry! You don't have any valid coupon." . "<BR>";
	}

	echo "<input type=\"submit\" name=\"Submit\" class=\"Button\" value=\"Close\" />";
?>
</form>
</div>

</body>
</html>