<!DOCTYPE html>
<html>

<head>

<meta name="google-translate-customization" content="a420b98ebeb45ff-5ad8a028603c954d-g6b96ed87fdce08e3-4a"></meta>
<div id="google_translate_element"></div><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<script src="jquery.js"></script>
	<script>
		$(document).ready(function(){
			// $(":button").addClass("cookie");
		});
	</script>

<link rel = "stylesheet" type = "text/css" href = "style.css"/>
</head>

<body>
<div><h2>Pick 1 of the cookie below to win a free cookie</h2></div>
<div>
	<form method="post" action="http://students.csci.unt.edu/~kc0284/CustomerInterface/WinOrLose.php">
		<?php
			require_once("DatabaseFunctions.php");

			for($i = 0; $i < 5; $i++)
			{	
				$value = $i + 1;
				echo "<input type=\"image\" src=\"cookie.JPG\" width=\"50\" height=\"50\" >" . "<input type=\"radio\" name=\"Card\" value=$value style=\"display:none;\"/>" . "</button>" . " ";
			}
		?>	
		<!-- <p><input type="submit" class=Button value="Confirm" /></p> -->
	</form>
</div>

</body>
</html>

